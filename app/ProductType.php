<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
