<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Transformers\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;

class AuthController extends Controller
{
   public function register(Request $request)
   {
      $validator = Validator::make($request->all(), [
         'name' => 'required|string|max:255',
         'email' => 'required|string|email|max:255|unique:users',
         'password' => 'required|string|min:8'
      ]);

      if ($validator->fails()) {
         return response()->json($validator->errors());
      }

      $user = User::create([
         'name' => $request->name,
         'email' => $request->email,
         'password' => Hash::make($request->password)
      ]);

      $token = $user->createToken('auth_token')->plainTextToken;
      $data = ['user' => $user, 'access_token' => $token, 'token_type' => 'Bearer'];
      return Result::response($data, 'Berhasil register');
   }

   public function login(Request $request)
   {
      if (!Auth::attempt($request->only('email', 'password'))) {
         return Result::error([], 'Unauthorized');
      }

      $user = User::where('email', $request['email'])->firstOrFail();

      $token = $user->createToken('auth_token')->plainTextToken;

      $data = ['access_token' => $token, 'token_type' => 'Bearer'];
      return Result::response($data, 'Hi ' . $user->name . ', welcome to home');
   }

   public function logout()
   {
      auth()->user()->tokens()->delete();
      return Result::error([], 'You have successfully logged out and the token was successfully deleted');
   }
}
