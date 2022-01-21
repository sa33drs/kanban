<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'email|required|string|unique:users,email',
            'password'  => 'required|string',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'  => bcrypt($request->password),
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user'  => $user,
            'token' => $token
        ];
        return response($response,201);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return [
            'message'   => 'Logged out'
        ];
    }

    public  function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('myapptoken')->plainTextToken;
                $response = [
                    'user'  => $user,
                    'token' => $token
                ];
                return response($response, 201);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }
    }
}
