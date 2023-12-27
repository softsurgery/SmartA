<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/NiveauController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Niveau.php";

$controller = new NiveauController();
$liste = $controller->liste();

if ($liste) {
  foreach ($liste as $niveau) {
    $id = $niveau->getId();
    $nom = $niveau->getNom();
    echo "<tr id=\"" . $id . "\">
                <td>" . $nom . "</td>
                <td><button onclick='redirection_modification_niveau(\"" . $id . "\")'>Modifier</button></td>
                <td><button onclick='supprimer_niveau(\"" . $id . "\",\"" . $nom . "\")'>Supprimer</button></td>
          </tr>";
  }
} else {
  echo "<tr>
            <td colspan='3'>Aucun Niveau Trouvé </td>
          </tr>";
}

?>