<?php
namespace App\Controller;

use App\Model\CategorieModel;
use App\Security\JWTSecurity;
use Core\Controller\DefaultController;

final class CategorieController extends DefaultController{

    private CategorieModel $model;
    private array $security;

    public function __construct()
    {
        $this->model = new CategorieModel;
        $this->security = (new JWTSecurity)->verifyToken();
    }

    /**
     * Renvoie toutes les catégories
     *

     */
    public function index () :never
    {
        $categories = $this->model->findAll();
        self::jsonResponse($categories, 200);
    }

    /**
     * Renvoie une catégorie en fonction de son id
     *
     * @param integer $id
     * @return void
     */
    public function single (int $id)
    {
        $categorie = $this->model->find($id);
        self::jsonResponse($categorie, 200);
    }

    /**
     * Enregistre une catégorie en BDD
     *
     * @param array $data
     * @return void
     */
    public function save (array $data)
    {
        if ($this->security["role"] === "admin") {
            $lastId = $this->model->save($data);
            $categorie = $this->model->find($lastId);
            self::jsonResponse($categorie, 201);
        } else {
            throw new \Exception("Vous n'avez pas les droits", 1);
            
        }
    }

    /**
     * Modifie une catégorie en BDD
     *
     * @param integer $id
     * @param array $data
     * @return void
     */
    public function update (int $id, array $data)
    {
        if($this->model->update($id, $data)) {
            $categorie = $this->model->find($id);
            self::jsonResponse($categorie, 201);
        }
    }

    /**
     * Supprime une catégorie en BDD
     *
     * @param integer $id
     * @return void
     */
    public function delete (int $id)
    {
        var_dump($this->model->delete($id));
        self::jsonResponse("Catégorie supprimée", 200);
    }
}