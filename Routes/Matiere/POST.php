<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/MatiereController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Matiere.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nom = $_POST["nom"];
    $controller = new MatiereController();
    $matiere = new Matiere(null,$nom);
    if ($controller->ajouter($matiere)) echo "200";
    else echo "500";
} else echo "400"

?>