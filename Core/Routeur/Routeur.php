<?php
namespace Core\Routeur;

use Core\Trait\JsonTrait;

final class Routeur {

    use JsonTrait;

    public static function Routes (){
        try {
            // On casse le path info pour récupérer le nom du controller à instancier
            // ainsi que l'id de l'élément à récupérer ou la méthode à exécuter.
            $path = explode("/", $_SERVER['PATH_INFO']);
            
            // On génère le nom du controller
            // $controllerName = ucfirst($_GET['controller']). "Controller";
            $controllerName = "App\Controller\\". ucfirst($path[3]). "Controller";
            // On instancie le controller
            $controller = new $controllerName();
            
            // Vérification du paramètre suivant de l'url
            $param = null;
            if (isset($path[4])) {
                if (is_numeric($path[4])) {
                    $method = "single";
                    $param = $path[4];
                } elseif (method_exists($controller, $path[4])) {
                    $method = $path[4];
                } else {
                    throw new \Exception("Méthode inexistante", 404);
                }
            } else {
                $method = "index";
            }

            $controller->$method($param);

        } catch (\Exception $e) {
            self::jsonResponse($e->getMessage(), $e->getCode());
        }
    }
}