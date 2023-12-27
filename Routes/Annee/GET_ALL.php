<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/AnneeController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Annee.php";

$controller = new AnneeController();
$liste = $controller->liste();

if ($liste) {
    foreach ($liste as $annee){
        $id = $annee->getId();
        $nom = $annee->getNom();
        echo "<tr id=\"".$id."\">
        <td>".$nom."</td>
        <td><button onclick='redirection_modification_annee(\"".$id."\")'>Modifier</button></td>
        <td><button onclick='supprimer_annee(\"".$id."\",\"".$nom."\")'>Supprimer</button></td>
      </tr>";
    }
} else echo "<tr>
                <td colspan='3'>Aucune Annees Trouvée </td>
            </tr>"

?>