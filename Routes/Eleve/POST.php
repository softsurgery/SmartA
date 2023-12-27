<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/EleveController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Eleve.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $niveau = $_POST["niveau"];
    $section = $_POST["section"];
    $annee = $_POST["annee"];
    $nom = $_POST["nom"];
    $telephone = $_POST["telephone"];
    $mail = $_POST["email"];
    $motDePasse = $_POST["motDePasse"];
    $reduction = $_POST["reduction"];
    $controller = new EleveController();
    $eleve = new Eleve(null, $niveau, $section, $annee,$nom, $telephone, $mail, $motDePasse,$reduction);
    if ($controller->ajouter($eleve)) echo "200";
    else echo "500";
} else echo "400"

?>