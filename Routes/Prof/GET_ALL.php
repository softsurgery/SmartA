<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/ProfController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Prof.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/MatiereController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Matiere.php";

$controller = new ProfController();
$liste = $controller->liste();

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
        <td>" . $mail . "</td>
        <td>" . $part . "</td>
        <td>" . $matiere . "</td>
        <td><button onclick='redirection_modification_prof(\"" . $id . "\")'>Modifier</button></td>
        <td><button onclick='supprimer_prof(\"" . $id . "\",\"" . $nom . "\")'>Supprimer</button></td>
      </tr>";
  }
} else echo "<tr>
                <td colspan='11'>Aucune Prof Trouvée </td>
            </tr>";
