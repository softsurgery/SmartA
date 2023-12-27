<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/SectionController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Section.php";

$controller = new SectionController();
$listeSections = $controller->liste();

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
            <td>Aucune Section Trouvée </td>
          </tr>";
}


?>