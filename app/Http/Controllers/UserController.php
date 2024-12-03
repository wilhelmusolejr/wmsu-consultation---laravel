<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'type' => $request->type,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Automatically log in the user by issuing a Sanctum token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return the user data and token
        return response()->json(
            [
                'user' => $user,
                'token' => $token,
                'message' => 'Registration successful and user logged in.',
            ],
            201,
        );
    }

    public function login(Request $request)
    {
        // Validate the login data
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in with the provided credentials
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            /** @var \App\Models\MyUserModel $user **/
            $user = Auth::user();

            // Generate an API token for the user
            $token = $user->createToken('auth_token')->plainTextToken;

            // Return the user data along with the token
            return response()->json(
                [
                    'user' => $user,
                    'token' => $token,
                    'message' => 'Login successful.',
                ],
                200,
            );
        } else {
            return response()->json(['message' => 'Invalid credentials.'], 401);
        }
    }

    public function index(Request $request)
    {
        // Access the authenticated user
        $user = Auth::user();

        // Return the user data as JSON response
        return response()->json($user, 200);
    }

    public function logout(Request $request)
    {
        // Revoke the user's token (if using Sanctum)
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });

        // Return a response indicating the user has been logged out
        return response()->json(['message' => 'Logged out successfully.'], 200);
    }

    public function all_diatitian()
    {
        $diatians = UserController::getAllDietitian();
        return view('instructor', ['diatians' => $diatians]);
    }

    public function home() {
        $all_diatians = UserController::getAllDietitian();
        $diatians = array_slice($all_diatians, 0, 6);
        return view('welcome', ['diatians' => $diatians]);
    }

    function getAllDietitian() {
        $diatians = User::where("type", 'instructor')->get()->toArray();
        return $diatians;
    }
}