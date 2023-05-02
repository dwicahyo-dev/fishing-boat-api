<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\StoreLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use PHPOpenSourceSaver\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Token;


class AuthenticatedApiController extends Controller
{
    public function store(StoreLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $sub = json_decode(base64_decode(explode('.', $token)[1]), true)['sub'];
        $keycache = 'sso:' . $sub;

        // Blacklist the old token if exist
        $oldToken = Cache::get($keycache);

        if ($oldToken) {
            try {
                JWTAuth::blacklist()
                    ->add(JWTAuth::manager()
                        ->decode(new Token($oldToken), TRUE));
            } catch (\Throwable $th) {
                return response()->json([
                    'message' => 'The token has been blacklisted',
                ], 433);
            }
        }

        // Save current token to cache
        Cache::put($keycache, $token);

        $user = Auth::user();

        return $this->respondWithToken($token, $user);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'data' => [
                'user' => $user
            ]
        ]);
    }
}
