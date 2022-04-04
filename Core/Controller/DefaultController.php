<?php
namespace Core\Controller;

use Core\Interface\CrudControllerInterface;

/**
 * Une class abstract est une class parent qui ne peut être instanciée.
 * Elle contient obligatoirement des méthodes abstract.
 * 
 * Ces méthodes abstract sont des méthodes que l'on doit obligatoirement définir dans les class enfant
 */
abstract class DefaultController implements CrudControllerInterface{

    public function render (string $view, array $params = []): void
    {
        ob_start();
            extract($params);
            if (file_exists(ROOT . "/templates/$view.phtml")) {
                require ROOT . "/templates/$view.phtml";
            } else {
                throw new \Exception("Le template demandé n'existe pas", 1);
            }
        $content = ob_get_clean();
        require ROOT . "/templates/base.phtml";
    }

    public abstract function index();

    public abstract function single(int $id);

    public abstract function save(array $data);

    public abstract function update (int $id, array $data);

    public abstract function delete (int $id);

    public abstract function test ();

}