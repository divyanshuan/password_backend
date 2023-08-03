<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', "register", 'getalldata']]);
    }

    public function register(Request $req)
    {
        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->profileimageurl = $req->profileimageurl;
        $user->password = Hash::make($req->password);
        $user->save();
        return response()->json([
            'message' => "user registered sucessfully",
            "user" => $user
        ]);
    }

    public function login(Request $req)
    {
        $validator = Validator::make($req->all(), [
            "email" => "required|string|min:2|max:100",
            "password" => "required|max:100",
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        if (!$token = $this->guard()->attempt($validator->validated())) {
            return response()->json([
                'message' => "unauthorized",

            ]);
        }
        return response()->json([
            'access_token' => $token,
            'message' => "authorized",
            'user' => $this->guard()->user(),
        ]);;
    }
    public function me()
    {
        return response()->json($this->guard()->user());
    }
    public function guard()
    {
        return Auth::guard();
    }
}
