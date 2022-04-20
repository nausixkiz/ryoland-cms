<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Common\CommonApiController;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Fortify\Rules\Password;
use Laravel\Jetstream\Jetstream;


class AuthController extends CommonApiController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', new Password],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ]);

        if ($validator->fails()) {
            return $this->respondFailedValidation($validator);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken(Str::lower(Config::get('app.name')) . '_token')->plainTextToken;

        return $this->respondWithSuccess([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function login(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return $this->respondError($validator->errors()->toArray());
            }

            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return $this->respondUnAuthenticated('Invalid credentials');
            }

            $user = User::where('email', $request['email'])->firstOrFail();

            $token = $user->createToken(Str::lower(Config::get('app.name')) . '_token')->plainTextToken;

            return $this->respondWithSuccess([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        } catch (Exception $exception) {
            return $this->respondError($exception->getMessage());
        }
    }

    public function me(): JsonResponse
    {
        return $this->respondWithSuccess(Auth::guard('sanctum')->user());
    }
}
