<?php
namespace App\Security;

use App\Entity\User;
use DateInterval;
use DateTime;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTSecurity {

    private string $key = "ipssi";

    private $algo = 'HS256';

    private array $payload;

    public function sendToken (User $user): string
    {
        $date = new DateTime();
        $exp = $date->modify("+ 1 day");
        $key = md5(uniqid()); // On l'enregistre en BDD sur l'utilisateur
        // $userModel->saveKey($key);
        $this->payload = [
            "iss" => "blogApi",
            // "exp" => $exp,
            "role" => "user",
            "key" => $key
        ];

        return JWT::encode($this->payload, $this->key, $this->algo);
    }

    /**
     * Undocumented function
     *
     * @return array|boolean
     */
    public function verifyToken(): array|bool
    {
        if (isset($_COOKIE['token']) && !empty($_COOKIE['token'])) {
            $token = $_COOKIE['token'];
            JWT::$leeway = 60;
            $decode = JWT::decode($token, new Key($this->key, $this->algo));
            if ($decode) {
                // $keys = $usermodel->getKeys();
                // Vérification de la key de l'utilisateur générée avec le token
                // if (in_array($decode['key'], $keys)){
                    return (array) $decode;
                // }
            }
        } else {
            throw new \Exception("Wrong token", 1);
        }
    }

}