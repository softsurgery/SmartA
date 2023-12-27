<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/DureeController.php";

$controller = new DureeController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["i"];
    $nom = $_POST["nom"];
    $nbjour = $_POST["nbjour"];
    $duree = new Duree($id, $nom,$nbjour);
    echo $controller->modifier($duree) ? "200" : "500";
    header('Location: ../../View/Duree.php');
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];
    $duree = $controller->recherche_par_id($id);
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
                <td> <label for="nom">ID : </label></td>
                <td>
                    <input type="text" name="i" id="i" value="<?php echo $duree->getId() ?>" readonly/>
                </td>
            </tr>
            <tr>
                <td> <label for="nom">Nom : </label></td>
                <td><input type="text" name="nom" id="nom" value="<?php echo $duree->getNom() ?>" /></td>
            </tr>
            <tr>
                <td> <label for="nom">Nombre Jour : </label></td>
                <td><input type="text" name="nbjour" id="nbjour" value="<?php echo $duree->getNbJour() ?>" /></td>
            </tr>
            <tr>
                <td colspan="4"> <input type="submit" value="Modifier Duree"></td>
            </tr>
        </table>

    </form>
    <br>
</body>

</html>