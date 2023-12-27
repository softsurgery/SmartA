<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/OffreController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Offre.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/DureeController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Duree.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cle = $_POST["cle"];
    $controller = new OffreController();
    $controllerDuree = new DureeController();
    $liste = $controller->recherche_par_nom($cle);

    if ($liste) {
        foreach ($liste as $offre) {
            $id = $offre->getId();
            $idDuree = $offre->getIdDuree();
            $duree = $controllerDuree->recherche_par_id($idDuree);
            $nomDuree = $duree->getNom();
            $nomOffre = $offre->getNom();
            $prix = $offre->getPrix();

            echo "<tr id=\"" . $id . "\">
                    <td>" . $nomDuree . "</td>
                    <td>" . $nomOffre . "</td>
                    <td>" . $prix . "</td>
                    <td><button onclick='redirection_modification_offre(\"" . $id . "\")'>Modifier</button></td>
                    <td><button onclick='supprimer_offre(\"" . $id . "\",\"" . $nomOffre . "\")'>Supprimer</button></td>
                </tr>";
        }
    } else
        echo "<tr>
                <td colspan='8'>Aucune Offre Trouvée </td>
            </tr>";
}
