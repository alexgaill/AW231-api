<?php
namespace App\Controller;

use App\Model\UserModel;
use App\Security\JWTSecurity;
use Core\Controller\DefaultController;

class UserController extends DefaultController {

    public function __construct(
        private UserModel $model = new UserModel
    ){}

    public function save (array $data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->model->save($data);
        self::jsonResponse("User créé", 201);
    }

    public function login (array $data)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user = $this->model->findOneBy(["email" => $data['email']]);
            if ($user && password_verify($data['password'], $user->getPassword())) {
                $token = (new JWTSecurity)->sendToken($user);
                self::jsonResponse($token, 200);
            }
        } else {
            throw new \Exception("Invalid request method", 404);
            
        }
    }
}