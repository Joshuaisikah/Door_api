<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request -> validate([
          'name' => 'required|string',
         'email' => 'required|string|unique:Users,email',
         'password' => 'required|string|confirmed',
        ]);

     $user = User::create([
        'name' => $fields['name'],
        'email' => $fields['email'],
        'password' => bcrypt($fields['password'])
    ]);

    $token = $user->createToken('fisrtone')->plainTextToken;
    $response = [
        'user' => $user,
        'token'=> $token

    ];

    return response($response,201);
        }

        public function login(Request $request){
            $fields = $request -> validate([
             'email' => 'required|string',
             'password' => 'required|string',
            ]);
//check the email
            $user = User::where('email', $fields['email'])->first();
            //check the password
            if(!$user|| !Hash::check($fields['password'], $user->password)){
                return response(['message' => 'bad creds'],401);
                }

                $token = $user->createToken('fisrtone')->plainTextToken;
                $response = [
                    'user' => $user,
                    'token'=> $token

                ];

                return response($response,201);
        }

     public function logout(Request $request ){
        auth()->user()-> tokens()->delete();
        return [
            'message' => 'logged out '
        ];
    }

}
