<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/AnneeController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Annee.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nom = $_POST["nom"];
    $controller = new AnneeController();
    $annee = new Annee(null,$nom);
    if ($controller->ajouter($annee)) echo "200";
    else echo "500";
} else echo "400"

?>