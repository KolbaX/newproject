<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;


class Cart extends Model
{
    public static function firstGameItem ()
    {
        $result = Self::where('user', $_COOKIE['user']??'none-user')->select('product_id')->first();
        if(!$result) return '';
        $gameID = Product::find($result->product_id);
        return $gameID->game_id??'';
    }
}
