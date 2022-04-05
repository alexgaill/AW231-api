<?php
namespace App\Controller;

use App\Model\CategorieModel;
use Core\Controller\DefaultController;

final class CategorieController extends DefaultController{

    private $model;

    public function __construct()
    {
        $this->model = new CategorieModel;
    }

    /**
     * Renvoie toutes les catégories
     *

     */
    public function index () :never
    {
        $categories = $this->model->findAll();
        $this->jsonResponse($categories, 200);
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
        $this->jsonResponse($categorie, 200);
    }

    /**
     * Enregistre une catégorie en BDD
     *
     * @param array $data
     * @return void
     */
    public function save (array $data)
    {
        $lastId = $this->model->save($data);
        $categorie = $this->model->find($lastId);
        $this->jsonResponse($categorie, 201);
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
        $this->model->update($id, $data);
        $this->jsonResponse("Categorie modifiée", 201);
    }

    /**
     * Supprime une catégorie en BDD
     *
     * @param integer $id
     * @return void
     */
    public function delete (int $id)
    {
        $this->model->delete($id);
        $this->jsonResponse("Catégorie supprimée", 200);
    }
}