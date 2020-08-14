<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Product;

class ProductController extends Controller
{

    public function __construct(Product $product) {
        $this->product = $product;
    }

    public function getProducts(Request $request) {
        
        $data = $this->product->with(['productType', 'currency'])->get();
        
        return response()->json($data, Response::HTTP_OK);
    }
    
}
