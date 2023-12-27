<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/SectionController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Section.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cle = $_POST["cle"];
    $controller = new SectionController();
    $listeSections = $controller->recherche_par_nom($cle);

    if ($listeSections) {
        foreach ($listeSections as $section) {
            $id = $section->getId();
            $nom = $section->getNom();
            echo "<tr id=\"" . $id . "\">
            <td>" . $nom . "</td>
            <td><button onclick='redirection_modification_section(\"" . $id . "\")'>Modifier</button></td>
            <td><button onclick='supprimer_section(\"" . $id . "\",\"" . $nom . "\")'>Supprimer</button></td>
          </tr>";
        }
    } else {
        echo "<tr>
            <td colspan='3'>Aucune Section Trouvée </td>
          </tr>";
    }
}

?>