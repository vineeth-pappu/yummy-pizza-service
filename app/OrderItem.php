<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_items';
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'price_per_quantity'
    ];
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function item()
    {
        return $this->belongsTo('App\Product');
    }
    
    public function createOrderItem($request, $order)
    {
        return $this->create([
                'order_id' => $order->id,
                'product_id' => $request['id'],
                'quantity' => $request['quantity'],
                'price_per_quantity' => $request['price']
            ]);
    }
}
