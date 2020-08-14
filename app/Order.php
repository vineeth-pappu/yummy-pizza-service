<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'sub_total', 'delivery_charge', 'grand_total', 'currency_id', 'delivery_address', 'status'
    ];
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'updated_at'
    ];

    public function orderItems()
    {
        return $this->hasMany('App\OrderItem')->with('item');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function createOrder($request, $user)
    {
        return $this->create([
            'user_id' => $user['id'],
            'sub_total' => $request['subTotal'],
            'delivery_charge' => $request['deliveryCharge'],
            'grand_total' => $request['grandTotal'],
            'currency_id' => $request['currencyId'],
            'delivery_address' => $request['address']
        ]);
    }

}
