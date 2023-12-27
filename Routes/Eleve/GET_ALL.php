<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/EleveController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Eleve.php";

$controller = new EleveController();
$liste = $controller->liste();

if ($liste) {
  foreach ($liste as $eleve) {
    $id = $eleve->getId();
    $niveau = $eleve->getNiveau();
    $section = $eleve->getSection();
    $annee = $eleve->getAnnee();
    $nom = $eleve->getNom();
    $telephone = $eleve->getTelephone();
    $mail = $eleve->getMail();
    $motDePasse = $eleve->getMotDePasse();
    $reduction = $eleve->getReduction();

    echo "<tr id=\"" . $id . "\">
        <td>" . $niveau . "</td>
        <td>" . $section . "</td>
        <td>" . $annee . "</td>
        <td>" . $nom . "</td>
        <td>" . $telephone . "</td>
        <td>" . $mail . "</td>
        <td>" . $motDePasse . "</td>
        <td>" . $reduction . "</td>
        <td><button onclick='redirection_modification_eleve(\"" . $id . "\")'>Modifier</button></td>
        <td><button onclick='supprimer_eleve(\"" . $id . "\",\"" . $nom . "\")'>Supprimer</button></td>
      </tr>";
  }
} else echo "<tr>
                <td colspan='11'>Aucune Eleve Trouvée </td>
            </tr>";
