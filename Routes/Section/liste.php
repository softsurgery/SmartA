<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/SectionController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Section.php";

$controller = new SectionController();
$listeSections = $controller->liste();

if ($listeSections) {
    foreach ($listeSections as $section){
        $id = $section->getId();
        $nom = $section->getNom();
        echo "<tr>
                <td>".$nom."</td>
                <td><button onclick='modifierSection({$id})'>Modifier</button></td>
                <td><button onclick='supprimerSection({$id})'>Supprimer</button></td>
              </tr>";
    }
} else {
    echo "<tr>
            <td>Aucune Section Trouvée </td>
          </tr>";
}


?>