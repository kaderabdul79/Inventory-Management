<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function login(Request $request)
     {
         $request->validate([
             'email' => 'required|email',
             'password' => 'required',
         ]);
 
         if (Auth::attempt($request->only('email', 'password'))) {
             $user = Auth::user();
             $token = $user->createToken('app-login-token')->plainTextToken;
 
             return response()->json(['token' => $token, 'data' => $user], 200);
         }
        return response()->json("Invalid credentials.", 401);
     }

    //  register
     public function register(Request $request)
     {
         $request->validate([
             'name' => 'required|string',
             'email' => 'required|email|unique:users,email',
             'password' => 'required|min:8|confirmed',
         ]);
     
         try {
             $user = User::create([
                 'name' => $request->input('name'),
                 'email' => $request->input('email'),
                 'password' => Hash::make($request->input('password')),
             ]);
     
             $token = $user->createToken('auth_token')->plainTextToken;
     
             return response()->json(['token' => $token, 'data' => $user]);
         } catch (\Exception $e) {
             return response()->json("Registration failed.", 500);
         }
     }
    // logout
     public function logout(Request $request)
     {
         try {
             $request->user()->tokens()->delete();
             return response()->json("Logout successful.", 200);
         } catch (\Exception $e) {
             return response()->json("Failed to logout.", 401);
         }
    }
    
    // get user details
    public function getUser(Request $request)
    {
        try {
            $user = $request->user();

            if ($user) {
                $response = [
                    'message' => 'User details',
                    'data' => $user,
                    'status' => 'success',
                ];
                return response()->json($response);
            } else {
                $response = [
                    'message' => 'User not authenticated.',
                    'status' => 'error',
                ];
                return response()->json($response, 401);
            }
        } catch (\Exception $e) {
            $response = [
                'message' => 'Unable to fetch user data.',
                'status' => 'error',
            ];
            return response()->json($response, 500);
        }
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
