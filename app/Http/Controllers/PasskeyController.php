<?php

namespace App\Http\Controllers;

use App\Models\Passkey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasskeyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['getallbyuser', "create", 'update', 'detete', "getbyid"]]);
    }
    public function create(Request $req)
    {
        $passkey = new Passkey();
        $passkey->name = $req->name;
        $passkey->email = $req->email;
        $passkey->username = $req->username;
        $passkey->password = $req->password;
        $passkey->pin = $req->pin;
        $passkey->userid = $req->userid;
        $var = $passkey->save();
        if ($var) {
            return response()->json([
                "message" => "Your data has been added",

            ]);
        } else {
            return response()->json([
                "message" => "Error",

            ]);
        }
    }
    public function getallbyuser($id)
    {
        $data = Passkey::where('userid', '=', $id)->get();
        if (count($data) == 0) {
            return response()->json([
                "data" => null,
                "message" => "No data"
            ]);
        } else {
            return response()->json([
                "data" => $data,
                "message" => "data"
            ]);
        }
    }
    public function getbyid($id)
    {
        $data = Passkey::where('id', '=', $id)->get();
        if (count($data) == 0) {
            return response()->json([
                "data" => null,
                "message" => "No data"
            ]);
        } else {
            return response()->json([
                "data" => $data,
                "message" => "data"
            ]);
        }
    }

    public function update(Request $req, int $id)
    {

        $passkey =  Passkey::where('id', '=', $id)->first();
        $passkey->name = $req->name;
        $passkey->email = $req->email;
        $passkey->username = $req->username;
        $passkey->password = $req->password;
        $passkey->pin = $req->pin;
        $passkey->userid = $req->userid;
        $var = $passkey->update();
        if ($var) {
            return response()->json([
                "message" => "Your data has been updated",
                'data' => $passkey
            ]);
        } else {
            return response()->json([
                "message" => "Error",
            ]);
        }
    }
    public function detete($id)
    {
        $passkey = Passkey::where('id', '=', $id)->first();
        $var = $passkey->delete();
        if ($var) {
            return response()->json([
                "message" => "Your data has been deleted",

            ]);
        } else {
            return response()->json([
                "message" => "Error",
            ]);
        }
    }

    public function guard()
    {
        return Auth::guard();
    }
}
