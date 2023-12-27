<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/NiveauController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Niveau.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cle = $_POST["cle"];
    $controller = new NiveauController();
    $liste = $controller->recherche_par_nom($cle);

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
    } else
        echo "<tr>
                <td colspan='3'>Aucune Niveaux Trouvée </td>
            </tr>";
}
?>