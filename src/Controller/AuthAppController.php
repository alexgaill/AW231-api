<?php
namespace App\Controller;

use App\Model\AuthAppModel;
use Core\Controller\DefaultController;

class AuthAppController extends DefaultController {

    public function __construct(
        private AuthAppModel $model = new AuthAppModel
    ){}

    /**
     * Undocumented function
     *
     * @param array $data
     * @return never
     */
    public function save (array $data): never
    {
        $data['apikey'] = md5(uniqid());
        $lastId = $this->model->save($data);

        self::jsonResponse($this->model->find($lastId), 201);
    }
}