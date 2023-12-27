<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/DureeController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Duree.php";

$controller = new DureeController();
$liste = $controller->liste();

if ($liste) {
    foreach ($liste as $duree){
        $id = $duree->getId();
        $nom = $duree->getNom();
        $nbjour = $duree->getNbJour();
        echo "<tr id=\"". $id ."\">
        <td>".$nom."</td>
        <td>".$nbjour."</td>
        <td><button onclick='redirection_modification_duree(\"".$id."\")'>Modifier</button></td>
        <td><button onclick='supprimer_duree(\"".$id."\",\"".$nom."\")'>Supprimer</button></td>
      </tr>";
    }
} else echo "<tr>
                <td colspan='4'>Aucune Duree Trouvée </td>
            </tr>"

?>