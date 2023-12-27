<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/MatiereController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Matiere.php";

$controller = new MatiereController();
$liste = $controller->liste();

if ($liste) {
    foreach ($liste as $matiere){
        $id = $matiere->getId();
        $nom = $matiere->getNom();
        echo "<tr id=\"".$id."\">
        <td>".$nom."</td>
        <td><button onclick='redirection_modification_matiere(\"".$id."\")'>Modifier</button></td>
        <td><button onclick='supprimer_matiere(\"".$id."\",\"".$nom."\")'>Supprimer</button></td>
      </tr>";
    }
} else echo "<tr>
                <td colspan='3'>Aucune Matiere Trouvée </td>
            </tr>"

?>