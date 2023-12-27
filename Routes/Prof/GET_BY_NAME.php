<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/ProfController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Prof.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/MatiereController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Matiere.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cle = $_POST["cle"];
    $controller = new ProfController();
    $liste = $controller->recherche_par_nom($cle);

    if ($liste) {
        foreach ($liste as $prof) {
            $id = $prof->getId();
            $controllerMatiere = new MatiereController();
            $matiere = $controllerMatiere->recherche_par_id($prof->getMatiere());
            $nom = $prof->getNom();
            $telephone = $prof->getTelephone();
            $email = $prof->getEmail();
            $part = $prof->getPart();

            echo "<tr id=\"" . $id . "\">
        <td>" . $nom . "</td>
        <td>" . $telephone . "</td>
        <td>" . $email . "</td>
        <td>" . $matiere->getNom() . "</td>
        <td>" . $part . "</td>
        <td><button onclick='redirection_modification_prof(\"" . $id . "\")'>Modifier</button></td>
        <td><button onclick='supprimer_prof(\"" . $id . "\",\"" . $nom . "\")'>Supprimer</button></td>
      </tr>";
        }
    } else echo "<tr>
                <td colspan='11'>Aucune Prof Trouvée </td>
            </tr>";
}
