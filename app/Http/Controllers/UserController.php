<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function login(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);


        if (!Auth::attempt($validator)) {
            return response()->json((['message' => 'Invalid login credentials']), 401);
        }

        $user = User::find(Auth::id());

        $token = $user->createToken('Token Name')->accessToken;

        // Creating a token with scopes...
        // $token = $user->createToken('My Token', ['place-orders'])->accessToken;

        return response()->json((['user' => Auth::user(), 'accessToken' => $token]), 200);
    }

    public function register(Request $request)
    {
        $result = User::where('email', '=', $request->email)->first();

        if ($result) {
            return response()->json((['message' => 'This email already exists']), 401);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json((['userCreated' => $user, 'message' => 'User created successfully']), 200);
    }
}
