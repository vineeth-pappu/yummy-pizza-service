<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';
    protected $primaryKey = 'id';
    
    public function productType() {
        return $this->belongsTo('App\ProductType');
    }
    
    public function currency() {
        return $this->belongsTo('App\Currency');
    }

}
