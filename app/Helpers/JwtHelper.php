<?php

declare(strict_types=1);

use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Validation\UnauthorizedException;

if (!function_exists('jwt_build_token')) {
    /**
     * Generate token
     *
     * @param array $data
     * @return string
     */
    function jwt_build_token(array $data): string
    {
        $token = [
            "iss" => ENV('JWT_ISS'),
            "iat" => Carbon::now()->timestamp,
            "exp" => Carbon::now()->addHour()->timestamp,
            "data" => $data
        ];

        return JWT::encode($token, ENV('JWT_SECRET'));
    }
}

if (!function_exists('jwt_decode_token')) {
    /**
     * Decode token
     *
     * @param string $token
     * @return object
     */
    function jwt_decode_token(string $token): object
    {
        try {
            return JWT::decode($token, ENV('JWT_SECRET'), ['HS256']);
        } catch(Exception $e) {
            throw new UnauthorizedException($e->getMessage());
        }
    }
}
