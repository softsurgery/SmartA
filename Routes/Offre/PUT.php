<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/OffreController.php";

$controller = new OffreController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["i"];
    $nom = $_POST["nom"];
    $id_duree = $_POST["duree"];
    $prix = $_POST["prix"];
    $offre = new Offre($id, $id_duree, $nom, $prix);
    echo $controller->modifier($offre) ? "200" : "500";
    header('Location: ../../View/Offre.php');
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];
    $offre = $controller->recherche_par_id($id);
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
    <h2>Modifier Annee</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
        <table>
            <tr>
                <td> <label for="id">ID : </label> </td>
                <td> <input type="text" name="i" id="i" value="<?php echo $offre->getId() ?>" readonly></td>
            </tr>
            <tr>
                <td> <label for="nom">Nom Offre : </label> </td>
                <td> <input type="text" name="nom" id="nom" value="<?php echo $offre->getNom() ?>"></td>
            </tr>
            <tr>
                <td> <label for="duree">Duree : </label> </td>
                <td>
                    <select name="duree" id="duree" onchange="formatDate('date_debut','date_debut_format'); 
                        calculateEndDate(); 
                        formatDate('date_fin','date_fin_format')">
                        <option disabled>Choisir Duree</option>
                        <?php
                        require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/DureeController.php";

                        $dureeController = new DureeController();
                        $durees = $dureeController->liste();

                        if ($durees !== null) {
                            foreach ($durees as $duree) {
                                if ($offre->getIdDuree() == $duree->getId()) $selected = "selected";
                                else $selected = "";
                                echo "<option " . $selected . " count='{$duree->getNbjour()}' value='{$duree->getId()}'>{$duree->getNom()} - {$duree->getNbjour()} jours</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td> <label for="prix">Prix Offre : </label> </td>
                <td> <input type="number" name="prix" id="prix" value="<?php echo $offre->getPrix() ?>"></td>
            </tr>
            <tr>
                <td colspan="3"><input type="submit" value="Modifier Offre"></td>
            </tr>
        </table>
    </form>
    <script src="../../assets/js/plugins/form.js"></script>
</body>

</html>