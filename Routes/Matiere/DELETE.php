<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/MatiereController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $controller = new MatiereController();
    echo $controller->supprimer($id) ? "200" : "500";
} else echo "400";
?>