<?php
namespace Core\Routeur;

use App\Security\ApiSecurity;
use App\Security\JWTSecurity;
use Core\Trait\JsonTrait;

final class Routeur {

    use JsonTrait;

    public static function Routes (){
        try {
            if (isset($_GET['apikey']) && !empty($_GET['apikey'])) {
                if( !(new ApiSecurity)->verifyApikey(htmlspecialchars($_GET["apikey"])))
                {
                    throw new \Exception("Vous n'avez pas les droits pour utiliser cette api", 404);
                }
            } else {
                throw new \Exception("Vous n'avez pas les droits pour utiliser cette api", 404);
                
            }

            // On casse le path info pour récupérer le nom du controller à instancier
            // ainsi que l'id de l'élément à récupérer ou la méthode à exécuter.
            $path = explode("/", $_SERVER['PATH_INFO']);
            
            // On génère le nom du controller
            // $controllerName = ucfirst($_GET['controller']). "Controller";
            $controllerName = "App\Controller\\". ucfirst($path[3]). "Controller";
            // On instancie le controller
            if (class_exists($controllerName)) {
                $controller = new $controllerName();
            } else {
                throw new \Exception("Classe inexistante", 404);
            }
            
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if (isset($path[4]) && is_numeric($path[4])) {
                        $controller->single($path[4]);
                    } elseif (isset($path[4])) {
                        if (method_exists($controller, $path[4])) {
                            $method = $path[4];
                            $controller->$method();
                        } else {
                            throw new \Exception("Méthode inexistante en GET", 404);
                        }
                    } else {
                        $controller->index();
                    }
                    break;
                
                case 'POST':
                    if (!empty($_POST)) {
                        if (isset($path[4])) {
                            if (method_exists($controller, $path[4])) {
                                $method = $path[4];
                                $controller->$method($_POST);
                            } else {
                                throw new \Exception("Méthode inexistante en POST", 404);
                            }
                        } else {
                            $controller->save($_POST);
                        }
                    } else {
                        throw new \Exception("Method not found", 404);
                    }
                    break;

                case 'PUT':
                    if (isset($path[4]) && is_numeric($path[4])) {
                        parse_str(file_get_contents("php://input"), $_PUT);
                        $controller->update($path[4], $_PUT);
                    } elseif (isset($path[4])) {
                        if (method_exists($controller, $path[4])) {
                            $method = $path[4];
                            $controller->$method();
                        } else {
                            throw new \Exception("Méthode inexistante en PUT", 404);
                        }
                    } else {
                        throw new \Exception("Method not found", 404);
                    }
                    break;
                
                case 'DELETE':
                    if (isset($path[4]) && is_numeric($path[4])) {
                        $controller->delete($path[4]);
                    }
                    break;
                default:
                    throw new \Exception("Request non autorisée", 403);
                    break;
            }
        } catch (\Exception $e) {
            self::jsonResponse($e->getMessage(), 404);
        }
    }
}