<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/EleveController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Eleve.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/NiveauController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Niveau.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/SectionController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Section.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/AnneeController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Annee.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cle = $_POST["cle"];
    $controller = new EleveController();
    $liste = $controller->recherche_par_nom($cle);

    if ($liste) {
        foreach ($liste as $eleve) {
            $id = $eleve->getId();
            
            $controllerNiveau = new NiveauController();
            $niveau = $controllerNiveau->recherche_par_id($eleve->getNiveau());

            $controllerSection = new SectionController();
            $section = $controllerSection->recherche_par_id($eleve->getSection());

            $controllerAnnee = new AnneeController();
            $annee = $controllerAnnee->recherche_par_id($eleve->getAnnee());

            $nom = $eleve->getNom();
            $telephone = $eleve->getTelephone();
            $mail = $eleve->getMail();
            $motDePasse = $eleve->getMotDePasse();
            $reduction = $eleve->getReduction();

        echo "<tr id=\"" . $id . "\">
        <td>" . $nom . "</td>
        <td>" . $telephone . "</td>
        <td>" . $mail . "</td>
        <td>" . $motDePasse . "</td>
        <td>" . $annee->getNom() . "</td>
        <td>" . $niveau->getNom() . "</td>
        <td>" . $section->getNom() . "</td>
        <td>" . $reduction . "</td>
        <td><button onclick='redirection_modification_eleve(\"" . $id . "\")'>Modifier</button></td>
        <td><button onclick='supprimer_eleve(\"" . $id . "\",\"" . $nom . "\")'>Supprimer</button></td>
      </tr>";
        }
    } else echo "<tr>
                <td colspan='11'>Aucune Eleve Trouvée </td>
            </tr>";
}
