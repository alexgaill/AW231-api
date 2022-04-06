<?php
namespace App\Controller;

use App\Model\CategorieModel;
use App\Security\JWTSecurity;
use Core\Controller\DefaultController;
use OpenApi\Annotations as OA;


/**
 * @OA\Info(title="Apiblog", version="v1")
 * @OA\Server(url="localhost:8000")
 * @OA\Tag(
 *  name="Categorie",
 *  description="Routes liées aux catégories"
 * )
 */
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
     * @OA\Get(
     *  path="/categorie",
     *  tags={"Categorie"},
     *  @OA\Response(
     *      response=200,
     *      description="Retourne l'ensemble des catégories",
     *      @OA\JsonContent(
     *          description="Contenu de notre catégorie",
     *          type="array",
     *          @OA\Items(
     *              ref="#/components/schemas/Categorie"
     *          )
     *      )
     *  ),
     *  @OA\Response(
     *      response=404,
     *      description="Erreur de récupération",
     *      @OA\JsonContent(
     *          description="Message d'erreur",
     *          type="string",
     *          example="Une erreur s'est produite"
     *      )
     *  )
     * )
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
     * 
     * @OA\Get(
     *  path="/categorie/{id}",
     *  tags={"Categorie"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Id de la catégorie",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Retourne une catégorie en fonction de son id",
     *      @OA\JsonContent(
     *          type="Categorie",
     *          ref="#/components/schemas/Categorie"
     *      )
     *  )
     * )
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
     * 
     * @OA\Post(
     *  path="/categorie",
     *  tags={"Categorie"},
     *  @OA\RequestBody(
     *      @OA\JsonContent(
     *          required={"name"},
     *          @OA\Property(
     *              property="name",
     *              type="string",
     *              example="nom de la catégorie"
     *          )
     *      ),
     *      required=true
     *  ),
     *  @OA\Response(
     *      response=201,
     *      description="Retourne la catégorie nouvellement crée",
     *      @OA\JsonContent(
     *          type="Categorie",
     *          ref="#/components/schemas/Categorie"
     *      )
     *  )
     * )
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
     * 
     * @OA\Put(
     *  path="/categorie/{id}",
     *  tags={"Categorie"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="id de la catégorie à modifier",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *  ),
     *  @OA\RequestBody(
     *       @OA\JsonContent(
     *          required={"name"},
     *          @OA\Property(
     *              property="name",
     *              type="string",
     *              example="nom de la catégorie"
     *          )
     *      ),
     *      required=true
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Suppression réussie",
     *      @OA\JsonContent(
     *          type="string"
     *      )
     *  )
     * )
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
     * @OA\Delete(
     *  path="/categorie/{id}",
     *  tags={"Categorie"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Id de la catégorie",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Suppression réussie",
     *      @OA\JsonContent(
     *          type="string"
     *      )
     *  )
     * )
     */
    public function delete (int $id)
    {
        var_dump($this->model->delete($id));
        self::jsonResponse("Catégorie supprimée", 200);
    }
}