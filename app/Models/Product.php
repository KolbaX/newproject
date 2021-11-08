<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Product extends Model
{
    use Translatable;
    protected  $translatable = ['title', 'deadline', 'service', 'requirements'];

    /**
     * Опции, принадлежащие товару.
     */
    public function options()
    {
        return $this->belongsToMany('App\Models\ProductOption', 'many_product_options');
    }
}
