<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/NiveauController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Niveau.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $controller = new NiveauController();
    $niveau = new Niveau(null, $nom);
    if ($controller->ajouter($niveau)) echo "200";
    else echo "500";
} else echo "400";


?>