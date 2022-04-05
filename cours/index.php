<?php

$pdo = new PDO("mysql:host=localhost:8889;dbname=blog", "root", "root"); // MAMP
$pdo->exec("SET NAMES UTF8");
// $pdo = new PDO("mysql:host=localhost:3306;dbname=blog", "root", ""); // WAMP

// $id = '';
// if (isset($_GET["id"]) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
//     $id = "WHERE id=". $_GET['id'];;
// }
// $query = $pdo->query("SELECT * FROM categorie $id");
// $result = $query->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST["name"]) && !empty($_POST['name'])) {
    $prepare = $pdo->prepare("INSERT INTO categorie (name) VALUES (:name)");
    if($prepare->execute($_POST)){
        $id = $pdo->lastInsertId();
        $query = $pdo->query("SELECT * FROM categorie WHERE id = $id");

        header("Content-type: application/json");
        echo json_encode($query->fetch(PDO::FETCH_OBJ));
        
    }
}