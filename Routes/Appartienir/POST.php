<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/AppartienirController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Appartienir.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $id_offre = $_POST["id_offre"];
    $id_matiere = $_POST["id_matiere"];
    $prix = $_POST["prix"];
    $controller = new AppartienirController();
    $appartienir = new Appartienir($id_offre,$id_matiere,$prix);
    if ($controller->ajouter($appartienir)) echo "200";
    else echo "500";
} else echo "400"

?>