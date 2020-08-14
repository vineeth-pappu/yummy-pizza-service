<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Order;
use App\OrderItem;

class OrderController extends Controller
{

    public function __construct(User $user, Order $order, OrderItem $orderItem) {
        $this->user = $user;
        $this->order = $order;
        $this->orderItem = $orderItem;
    }

    public function create(Request $request) {
        
        # Validate request
        $validation = Validator::make(
            $request->all(), [
                'items' => 'required|array',
                'deliveryCharge' => 'required',
                'subTotal' => 'required',
                'grandTotal' => 'required',
                'name' => 'required',
                'email' => 'required',
                'address' => 'required',
                'currencyId' => 'required',
            ]);

        if ($validation->fails()) 
        {
            $message = $validation->errors()->all();
            $data = ['error' => true, 'msg' => $message[0]];
            return response()->json($data, Response::HTTP_BAD_REQUEST);
        }
        
        $user = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
        ]);
        
        // return response()->json($user, Response::HTTP_OK);
        

        $result = $this->order->create([
            'user_id' => $user->id,
            'sub_total' => $request->subTotal,
            'delivery_charge' => $request->deliveryCharge,
            'grand_total' => $request->grandTotal,
            'currency_id' => $request->currencyId,
            'delivery_address' => $request->address
        ]);

        if ($result) 
        {
            $data = [
                'status' => true,
                'msg' => 'Order created successfully',
                'data' => $result,
            ]; // success
        } 
        else 
        {
            $data = [
                'status' => false,
                'msg' => 'Order not created',
                'data' => $result,
            ]; // success
        }

        return response()->json($data, Response::HTTP_OK);
    }
    
}
