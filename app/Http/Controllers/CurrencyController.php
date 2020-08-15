<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Currency;

class CurrencyController extends Controller
{

    public function __construct(Currency $currency) {
        $this->currency = $currency;
    }

    public function getAvailableCurrencies(Request $request) {
        
        $data = $this->currency->get();
        
        return response()->json($data, Response::HTTP_OK);
    }
    
}
