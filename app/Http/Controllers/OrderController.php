<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderCreateRequest;
use App\Exceptions\RunTimeException;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\Order;
use App\OrderItem;
use DB;

class OrderController extends Controller
{

    public function __construct(User $user, Order $order, OrderItem $orderItem) {
        $this->user = $user;
        $this->order = $order;
        $this->orderItem = $orderItem;
    }

    public function create(OrderCreateRequest $request) {
        
        $payload = $request->validated();
        
        DB::beginTransaction();
        
        if (!$user = $this->user->createUser($payload)) {
            DB::rollBack();
            throw RunTimeException::badRequest();
        }

        if (!$order = $this->order->createOrder($payload, $user)) {
            DB::rollBack();
            throw RunTimeException::badRequest();
        }
        
        foreach ($payload['items'] as $key => $value) 
        {
            if (!$result = $this->orderItem->createOrderItem($value, $order)) {
                DB::rollBack();
                throw RunTimeException::badRequest();
            }
        }
        
        DB::commit();

        return response()->json($order, Response::HTTP_OK);
    }
    
}
