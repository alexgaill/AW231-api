<?php
namespace App\Security;

use App\Entity\User;
use DateInterval;
use DateTime;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTSecurity {

    private string $key = "ipssi";

    private array $payload;

    public function sendToken (User $user): string
    {
        $date = new DateTime();
        $exp = $date->add(new DateInterval("PT3H"));
        $this->payload = [
            "iss" => "blogApi",
            "exp" => $exp,
            "role" => "admin"
        ];

        return JWT::encode($this->payload, $this->key, 'HS256');
    }

    public function verifyToken(string $token): bool
    {
        $decode = JWT::decode($token, new Key($this->key, 'HS256'));
        var_dump($decode);
        die();
    }

}