<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate input data with detailed error messages
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);
    
        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }
    
        $user = User::where('email', $request->email)->first();
        // Check if user exists and password is valid
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }
        $user->tokens()->delete();
        $token = $user->createToken('myApp', ['*'], now()->addHours(10));
    
        // Prepare success response data
        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'data' => [
                'name' => $user->name,
                'token' => $token->plainTextToken,
            ]
        ], 200);
    }    
}
