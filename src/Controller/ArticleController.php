<?php
namespace App\Controller;

use App\Model\ArticleModel;
use Core\Controller\DefaultController;


class ArticleController extends DefaultController {

    public function __construct(
        private ArticleModel $model = new ArticleModel
    ){}

    /**
     * Undocumented function
     *
     * @return never
     */
    public function index (): never
    {
        self::jsonResponse($this->model->findAll(), 200);
    }

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return never
     */
    public function single (int $id): never
    {
        self::jsonResponse($this->model->find($id), 200);
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @return never
     */
    public function save (array $data): never
    {
        $lastId = $this->model->save($data);
        self::jsonResponse($this->model->find($lastId), 201);
    }

    /**
     * Undocumented function
     *
     * @param integer $id
     * @param array $data
     * @return never
     */
    public function update (int $id, array $data): never
    {
        if($this->model->update($id, $data)) {
            self::jsonResponse($this->model->find($id), 201);
        }
    }

    /**
     * Supprime un article en BDD
     *
     * @param integer $id
     * @return never
     */
    public function delete (int $id): never
    {
        $this->model->delete($id);
        self::jsonResponse("Article supprimé", 200);
    }


}