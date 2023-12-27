<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/DureeController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Duree.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nom = $_POST["nom"];
    $nbjour = $_POST["nbjour"];
    $controller = new DureeController();
    $duree = new Duree(null,$nom,$nbjour);
    if ($controller->ajouter($duree)) echo "200";
    else echo "500";
} else echo "400"

?>