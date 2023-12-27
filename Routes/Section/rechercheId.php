<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/SectionController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $controller = new SectionController();
    $section = $controller->recherche_par_id($id);

    if ($section) {
        // Traitement de l'objet Section trouvé
        echo "ID: " . $section->getId() . "<br>";
        echo "Nom: " . $section->getNom();
    } else {
        echo "Aucune Section Trouvée";
    }
} else {
    echo "400";
}

?>