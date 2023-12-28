<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/AcheterController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Acheter.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/OffreController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Offre.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/DureeController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Duree.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new AcheterController();
    $controllerOffer = new OffreController();
    $controllerDuree = new DureeController();

    $id = $_POST["i"];
    $id_offre = $_POST["offre"];
    $offre = $controllerOffer->recherche_par_id($id_offre);
    $duree = $controllerDuree->recherche_par_id($offre->getIdDuree());
    $acheter = new Acheter($id, $id_offre,$duree->getNbJour());
    echo $controller->ajouter($acheter) ? "200" : "500";
    header('Location: ../../View/Eleve.php');
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];
    $nom = $_GET["name"];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
</head>

<body>
    <h2>Acheter pour l'eleve <?php echo $nom ?></h2>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
        <table>
            <tr>
                <td> <label for="nom">ID : </label></td>
                <td>
                    <input type="text" name="i" id="i" value="<?php echo $id ?>" readonly />
                </td>
            </tr>
            <tr>
                <td> <label for="nom">Offre : </label></td>
                <td>
                    <select name="offre" id="offre">
                        <option selected disabled>Choisir Offre</option>
                        <?php
                        require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/OffreController.php";

                        $offreController = new OffreController();
                        $offres = $offreController->liste();

                        if ($offres !== null) {
                            foreach ($offres as $offre) {
                                echo "<option value='{$offre->getId()}'>{$offre->getNom()}</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="3"> <input type="submit" value="Acheter"></td>
            </tr>
        </table>

    </form>
    <br>
</body>

</html>