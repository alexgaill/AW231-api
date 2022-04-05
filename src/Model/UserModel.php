<?php
namespace App\Model;

use Core\Model\DefaultModel;

class UserModel extends DefaultModel {
    protected string $table = "user";
    protected string $entity = "User";
}