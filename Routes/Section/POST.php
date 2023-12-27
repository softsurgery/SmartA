<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/SectionController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Section.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $controller = new SectionController();
    $section = new Section(null, $nom);
    if ($controller->ajouter($section)) echo "200";
    else echo "500";
} else echo "400";


?>