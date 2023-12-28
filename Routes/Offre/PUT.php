<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/OffreController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/AppartienirController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Offre.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Appartienir.php";


$controller = new OffreController();
$appController = new AppartienirController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["i"];
    $nom = $_POST["nom"];
    $id_duree = $_POST["duree"];
    $matieres = isset($_POST["matiere"]) ? $_POST["matiere"] : array();
    $listeDesprix = $matieres = isset($_POST["prix"]) ? $_POST["prix"] : array();
    $offre = new Offre($id, $id_duree, $nom);
    $resp = $controller->ajouter($offre); 
    sleep(2);
    $appController->supprimer($id);
    for($i= 0 ; $i < count($matieres);$i++) {
            $appartienir = new Appartienir($id,$matieres[$i],$listeDesprix[$i]);
            $appController->ajouter($appartienir);    
    }
    //header('Location: ../../View/Offre.php');
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];
    $offre = $controller->recherche_par_id($id);
    $matieres = $appController->recherche_par_id($id);
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
            <tr>
                <td colspan="4">
                    <?php
                    require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/MatiereController.php";

                    $matiereController = new MatiereController();
                    $allMatieres = $matiereController->liste();

                    if ($allMatieres !== null) {
                        foreach ($allMatieres as $matiere) {
                            $id = $matiere->getId();
                            $nom = $matiere->getNom();
                            $checked = in_array($id, $matieres) ? 'checked' : ''; // Check if the matière ID is in the $matieres array
                            echo "<input type='checkbox' name='matiere[]' value='$id' $checked/> $nom 
                            <input type='number' name='prix[]' value='0'/><br>";
                        }
                    }
                    ?>
                </td>
            </tr>


            </tr>
            <tr>
                <td colspan="3"><input type="submit" value="Modifier Offre"></td>
            </tr>


        </table>
    </form>
    <script src="../../assets/js/plugins/form.js"></script>
</body>

</html>