<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Trait\HttpResponses;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authentication extends Controller
{
    use HttpResponses;

    public function register(RegisterRequest $request)
    {
        try{
            $createUser = User::create($request->all());
            // Create User Token
            $response = [
                "token" => $createUser->createToken('ApxNet')->accessToken,
                "userId" => $createUser['id']
            ];
            
            return $this->success($response, "User Created");

        }catch(Exception $e){
            return $this->error([], $e->getMessage(),400);
        }
    }


    public function login(LoginRequest $request)
    {
        try{
            if (!Auth::attempt($request->only('email', 'password')))
            {
                return $this->error([], "Authentication Failed", 400);
            }
            $user = Auth::user();
            $response = [
                "token" => $user->createToken('ApxNet')->accessToken,
                "user" => $user
            ];
            
            return $this->success($response, "Authentication Success");

        }catch(Exception $e){
            return $this->error([], $e->getMessage(),400);
        }
    }

    public function logout(Request $request)
    {
        try{
            $request->user()->token()->revoke();            
            return $this->success([], "Logout Successful");

        }catch(Exception $e){
            return $this->error([], $e->getMessage(),400);
        }
    }
}
