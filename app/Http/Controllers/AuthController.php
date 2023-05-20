<?php

namespace App\Http\Controllers;

use App\Enums\Gender;
use App\Models\User;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8']
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'The provided credentials are incorrect.'], 401);
        }

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('api_auth')->plainTextToken
        ]);
    }

    public function clientRegistration(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'surname' => 'string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'gender' => ['string', new EnumValue(Gender::class)],
            'agree_to_receive_information' => ['required', 'bool']
        ]);

        $user = User::create([
            'name' => $validatedData['name'] ?? null,
            'surname' => $validatedData['name'] ?? null,
            'email' => $validatedData['email'],
            'gender' => $validatedData['gender'] ?? null,
            'password' => Hash::make($validatedData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
