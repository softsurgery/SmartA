<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/OffreController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Offre.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_duree = $_POST["duree"];
    $nom = $_POST["nom"];
    $prix_offre = $_POST["prix"];

    $offre = new Offre(null, $id_duree, $nom, $prix_offre);
    $controller = new OffreController();

    if ($controller->ajouter($offre)) {
        echo "200";
    } else {
        echo "500";
    }
} else {
    echo "400";
}
?>
