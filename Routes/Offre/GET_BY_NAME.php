<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/OffreController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Offre.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/DureeController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Duree.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/MatiereController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Matiere.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/AppartienirController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cle = $_POST["cle"];
    $controller = new OffreController();
    $controllerDuree = new DureeController();
    $appController = new AppartienirController();
    $matController = new MatiereController();
    $liste = $controller->recherche_par_nom($cle);

    if ($liste) {
        foreach ($liste as $offre) {
            $id = $offre->getId();
            $idDuree = $offre->getIdDuree();
            $duree = $controllerDuree->recherche_par_id($idDuree);
            $nomDuree = $duree->getNom();
            $nomOffre = $offre->getNom();
            $matieres = $appController->liste($id);
            $nomDesMatieres = "";
            $somme = 0;
            foreach ($matieres as $matiereO) {
                $matiere = $matController->recherche_par_id($matiereO["id_matiere"]);
                $somme+= $matiereO["prix"];
                $nomMatiere = $matiere->getNom();
                $nomDesMatieres = $nomDesMatieres .  $nomMatiere . ", ";
            }
            $nomDesMatieres = substr($nomDesMatieres, 0, -2);
            
            echo "<tr id=\"" . $id . "\">
                    <td>" . $nomOffre . "</td>
                    <td>" . $nomDuree . "</td>
                    <td>" . $nomDesMatieres . "</td>
                    <td>" . $somme . "</td>
              
                    <td><button onclick='supprimer_offre(\"" . $id . "\",\"" . $nomOffre . "\")'>Supprimer</button></td>
                </tr>";
        }
    } else
        echo "<tr>
                <td colspan='8'>Aucune Offre Trouvée </td>
            </tr>";
}
// <td><button onclick='redirection_modification_offre(\"" . $id . "\")'>Modifier</button></td>