<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/ProfController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Prof.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nom = $_POST["nom"];
    $telephone = $_POST["telephone"];
    $email = $_POST["email"];
    $matiere = $_POST["matiere"];
    $part = $_POST["part"];
    $controller = new ProfController();
    $prof = new Prof(null,$matiere,$nom,$telephone,$email,$part);
    if ($controller->ajouter($prof)) echo "200";
    else echo "500";
} else echo "400"

?>