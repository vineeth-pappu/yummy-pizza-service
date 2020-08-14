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


    public function addOrder($request)
    {
        if ($request->customerId) {
            return $this->create([
                'crm_id' => $request->user()->crm_info->crm_id,
                'group_id' => $request->groupId,
                'service_id' => $request->service_id,
                'customer_id' => $request->customerId,
                'order_status_id' => $request->order_status_id,
                'order_type_id' => $request->order_type_id,
                'order_table' => $request->table,
                'payment_type' => $request->payment_type,
                'amount' => $request->amount,
                'order_from' => $request->order_from,
                'order_date' => $request->time,
                'created_by' => $request->user()->user_id,
                'updated_by' => $request->user()->user_id,
                'status' => 1,
            ]);
        } else {
            //dd($request->transaction_id);
            return $this->create([
                'crm_id' => $request->crm_id,
                'service_id' => $request->service_id,
                'group_id' => $request->group_id,
                'transaction_id' =>$request->transaction_id,
                'customer_id' => $request->authCustomer->customer_id,
                'order_status_id' => $request->order_status_id,
                'order_type_id' => $request->order_type_id,
                'order_table' => 'NULL', //$request->order_table,
                'amount' => $request->amount,
                'order_from' => $request->order_from,
                'order_date' => $request->order_date,
                'created_by' => $request->authCustomer->customer_id,
                'updated_by' => $request->authCustomer->customer_id,
                'status' => 1,
            ]);
        }
    }

}
