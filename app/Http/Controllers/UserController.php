<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\User;

class UserController extends Controller
{

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function getUsers(Request $request) {
        
        $data = $this->user->get();
        
        return response()->json($data, Response::HTTP_OK);
    }
    
}
