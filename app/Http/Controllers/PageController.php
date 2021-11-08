<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Product;
use App\Models\TagGroup;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Models\Cart;
use App\Models\PayMethod;
use App\Models\Order;
use Auth;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Subscribe;
use UnitPay;
use App\Models\ProductOption;
use App\Http\Controllers\BotController;
use App\Models\Promocode;
use App\GameTag;

class PageController extends Controller
{
    public function index ()
    {
        $games = Game::get();
        $gameTops = Game::get();
        $firstGame = Game::orderBy('id', 'asc')->first();
        $products = Product::where('game_id', $firstGame->id)->where('is_top', 1)->get();
        // $products = Product::get();
        $productTop = Product::where('game_id', 1)->get();
        return view('index', compact('games', 'products', 'productTop', 'gameTops'));
    }

    public function shop (Request $request)
    {
        $game = null;
        $tagGroups = new TagGroup();

        $games = Game::get();

        if($request->q)
            $products = Product::where('title', 'like', '%'.$request->q.'%')->paginate(20);
        elseif ($request->game) {
            $selectGame = Game::find($request->game);
            $tagGroups = $tagGroups->whereIn('id', $selectGame->tags->pluck('id')->toArray());
            $game = Game::find($request->game);
            $products = Product::where('game_id', $request->game)->paginate(20);
        }
        else $products = Product::paginate(20);

        $tagGroups = $tagGroups->get();

        return view('site.shop', compact('products', 'tagGroups', 'request', 'game', 'games'));
    }

    public function product (Product $product)
    {
        $title = $product->getTranslatedAttribute('title', app()->getLocale(), 'fallbackLocale');
        $_tags = ProductTag::where('product_id', $product->id)->pluck('tag_id')->toArray();
        $tags = Tag::whereIn('id', $_tags)->get();
        $cart = Cart::where('user', $_COOKIE['user'])->where('product_id', $product->id)->first();

        $product->view += 1;
        $product->save();

        $products = Product::where('game_id', $product->game_id)->get();

        if(!isset($_COOKIE['product-'.$product->id])){
            setcookie('product-'.$product->id, $product->id, time()+360000, '/');
        }

        return view('site.product.index', compact('title', 'product', 'tags', 'cart', 'products'));
    }

    public function addCart (Request $request, Product $product)
    {
        $cartCheck = Cart::where('user', $_COOKIE['user'])->where('product_id', $product->id)->first();
        if($cartCheck){
            $cartCheck->delete();
            $html = view('site.product.cart')->render();
            $cartCount = Cart::where('user', $_COOKIE['user']??0)->count();
            return response()->json(['html' => $html, 'count' => $cartCount]);

            // return redirect()->back();
        }

        $challenges = [];
        $optionsAmount = 0;
        if($request->challenge){
            foreach ($request->challenge as $keyC => $c){
                $challenges[] = $c;
            }
        }

        $cart = new Cart();
        $cart->user = $_COOKIE['user'];
        $cart->product_id = $product->id;
        $cart->amount = ($product->new_amount)?$product->new_amount:$product->amount;
        $cart->platform = $request->platform;

        $cart->challenge = json_encode($challenges);
        $cart->save();

        $html = view('site.product.cart')->render();
        $cartCount = Cart::where('user', $_COOKIE['user']??0)->count();
        return response()->json(['html' => $html, 'count' => $cartCount]);

        // return redirect()->back();
    }

    public function cartDelete (Cart $cart)
    {
        $cart->delete();
        return redirect()->back();
    }

    public function filter (Request $request)
    {
        $tagIDs = [];
        if($request->tags) {
            foreach ($request->tags as $tagKey => $tagVal) {
                $tagIDs[] = $tagVal;
            }

            $resultTag = ProductTag::whereIn('tag_id', $tagIDs)->pluck('product_id')->toArray();
            $products = Product::whereIn('id', $resultTag);
        }else{
            $products = new Product();
        }

        if($request->game != 'none')
            $products = $products->where('game_id', $request->game);

        if($request->q)
            $products = $products->where('title', 'like', '%'.$request->q.'%');

        $productsCount = $products->count();
        $products = $products->paginate(20);

        $tags = Tag::whereIn('id', $tagIDs)->get();

        $html = view('site.shop-list', compact('products', 'productsCount', 'tags'))->render();

        return response()->json(['html' => $html]);
    }

    public function checkout ()
    {
        $payMethods = PayMethod::get();
        return view('site.checkout.index', compact('payMethods'));
    }

    public function order (Request $request)
    {
        $cartProducts = Cart::where('user', $_COOKIE['user'])->get();
        $orderTotalAmount = 0;
        $productIDs = [];

        foreach ($cartProducts as $cartProduct){
            $product = Product::find($cartProduct->product_id);
            if($product->new_amount)
                $orderTotalAmount += $product->new_amount;
            else $orderTotalAmount += $product->amount;

            $productAmount = ($product->new_amount)?$product->new_amount:$product->amount;

            $challenge = json_decode($cartProduct->challenge);

            foreach ($challenge as $ch) {
                $option = ProductOption::find((int)substr($ch, 6));
                $orderTotalAmount += $option->amount;
                $productAmount += $option->amount;
            }

            $productIDs[] = [
                'title' => $product->title.' ('.$cartProduct->platform.')',
                'id' => $product->id,
                'amount' => $productAmount,
                'challenge' => $cartProduct->challenge,
                'image' => $product->image,
            ];
        }

        Cart::where('user', $_COOKIE['user'])->delete();

        $order = new Order();

        if($request->promocode){
            $code = Promocode::where('code', $request->promocode)->where('activate', '>', 0)->first();
            if($code){
                $order->promocode = $request->promocode;
                $newAmount = $orderTotalAmount - ($orderTotalAmount * ($code->percent / 100));
            }
        }

        $order->user = (Auth::check())?Auth::user()->id:0;
        $order->products = json_encode($productIDs);
        $order->contact_method = $request->contact_method;
        $order->contact_data = $request->contact_data;
        $order->email = $request->email;
        $order->pay_method = $request->pay_method;
        $order->status = 0;
        $order->sum = $newAmount??$orderTotalAmount;
        $order->save();

        $botController = new BotController();
        $botController->sendMessageOrder($order);

        if($request->subscribe){
            $subscribe = Subscribe::where('email', $request->email)->first();
            if(!$subscribe) {
                $subscribe = new Subscribe();
                $subscribe->email = $request->email;
                $subscribe->save();
            }
        }

        if($request->pay_method == 1)
            return redirect(self::pay($order));
        else return redirect()->route('order.account.info', $order);
        // return redirect(self::pay($order));

    }

    public function orderAccountInfo (Order  $order)
    {
        return view('site.account-info', compact('order'));
    }

    public function orderAccountInfoStore (Request $request, Order $order)
    {
        $order->account_login = $request->login;
        $order->account_password = $request->password;
        $order->account_character_class = $request->character_class;
        $order->account_info = $request->info;
        $order->save();

        return redirect()->route('thank.order');
    }

    public function thankOrder ()
    {
        return view('site.thank.order');
    }

    public function thankOrderContact ()
    {
        return view('site.thank.operator');
    }

    public function page ($page)
    {
        $page = Page::where('slug', $page)->first();
        if(!$page) return abort(404);

        return view('site.page', compact('page'));
    }

    public function contactForm (Request $request)
    {
        $contact = new Contact();

        $contact->method = $request->methodData;
        $contact->login = $request->login;
        $contact->description = $request->description;
        $contact->save();

        return redirect()->back();
    }

    public function subscribe (Request $request)
    {
        $subscribe = new Subscribe();

        $subscribe->email = $request->email;
        $subscribe->save();

        return response()->json(['status' => true]);
        // return redirect()->back()->with('success', 'success');
    }

    public function loadGame (Request $request)
    {
        $products = Product::where('game_id', $request->game)->where('is_top', 1)->get();
        $html = '';

        foreach ($products as $product){
            $html .= view('site.product.card', compact('product'))->render();
        }

        return response()->json(['html' => $html]);
    }

    public function pay (Order $order)
    {
        \Cloudipsp\Configuration::setMerchantId(1397120);
        \Cloudipsp\Configuration::setSecretKey('test');

        $data = [
            'order_desc' => 'Order ID: '.$order->id,
            'currency' => 'USD',
            'amount' => $order->sum * 100,
            'response_url' => 'http://site.com/responseurl',
            'server_callback_url' => 'http://'.$_SERVER['SERVER_NAME'].'/order/'.$order->id.'/account/info',
            'sender_email' => $order->email,
            'lang' => app()->getLocale(),
            'product_id' => 'some_product_id',
            'lifetime' => 36000,
        ];
        $url = \Cloudipsp\Checkout::url($data);
        $data = $url->getData();

        return $data['checkout_url'];
    }

    function getFormSignature($account, $currency, $desc, $sum, $secretKey) {
        $hashStr = $account.'{up}'.$currency.'{up}'.$desc.'{up}'.$sum.'{up}'.$secretKey;
        return hash('sha256', $hashStr);
    }

    public function searchProductAjax (Request $request)
    {
        $products = Product::where('title', 'like', '%'.$request->q.'%')->get();
        if(count($products) > 0)
            $html = view('site.product.search', compact('products'))->render();
        else $html = 'Not found';
        return response()->json(['html' => $html]);
    }
}
