<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/SectionController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $controller = new SectionController();
    $listeSections = $controller->recherche_par_nom($nom);

    if ($listeSections) {
        foreach ($listeSections as $section) {
            // Afficher les détails de chaque section trouvée
            echo "ID: " . $section->getId() . "<br>";
            echo "Nom: " . $section->getNom() . "<br>";
            echo "-------------------<br>";
        }
    } else {
        echo "Aucune Section Trouvée";
    }
} else {
    echo "400";
}

?>