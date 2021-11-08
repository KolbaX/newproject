<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Game extends Model
{
    use Translatable;
    protected  $translatable = ['title', 'shop_title', 'shop_sub_title'];

    /**
     * Группы тегов
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\TagGroup', 'game_tags');
    }
}
