<?php
namespace Core\Routeur;

use Core\Request\Request;

final class Routeur {

    public static function Routes (){
        try {
            Request::createFromGlobals();   
        } catch (\Exception $e) {

        }
    }
}