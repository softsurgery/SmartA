<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/NiveauController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Niveau.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $controller = new NiveauController();
    $niveau = new Niveau(null, $nom);
    if ($controller->ajouter($niveau)) "200";
    else "500";
} else "400";


?>