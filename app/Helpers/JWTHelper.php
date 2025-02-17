<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTHelper
{
//    private static $secretKey = env('JWT_SECRET'); // Thay bằng secret key thực tế
    private static $algorithm = 'HS256'; // Thuật toán mã hóa

    // Tạo JWT Token
    public static function createToken($payload, $expireMinutes = 60)
    {
        $payload['iat'] = time(); // Thời gian tạo
        $payload['exp'] = time() + ($expireMinutes * 60); // Hết hạn

        return JWT::encode($payload, env('JWT_SECRET'), self::$algorithm);
    }

    // Giải mã token
    public static function verifyToken($token)
    {
        try {
            return (array) JWT::decode($token, new Key(env('JWT_SECRET'), self::$algorithm));
        } catch (\Exception $e) {
            return null; // Trả về null nếu token không hợp lệ
        }
    }
}
