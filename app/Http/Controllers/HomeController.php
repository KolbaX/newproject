<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::where('user', Auth::user()->id)->get();
        $productsIDs = [];

        foreach ($orders as $order){
            $arrProducts = json_decode($order->products);
            $productsIDs[] = $arrProducts;
        }

        return view('home', compact('productsIDs'));
    }

    public function updateName (Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->save();

        return redirect()->back();
    }

    public function newsLatter ()
    {
        $user = User::find(Auth::user()->id);
        if($user->news_latter === 0)
            $user->news_latter = 1;
        else $user->news_latter = 0;

        $user->save();

        return response()->json(['status' => true]);
    }

    public function changePassword ()
    {
        return view('site.change-password');
    }

    public function changePasswordSet (Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('home');
    }

    public function updateAvatar (Request $request)
    {
        $user = User::find(Auth::user()->id);
        if($request->avatar) {
            $path = $request->file('avatar')->store('avatar', 'public');
            $user->avatar = $path;
        }

        $user->save();
        return redirect()->back();
    }
}
