<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/AnneeController.php";

$controller = new AnneeController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["i"];
    $nom = $_POST["nom"];
    $annee = new Annee($id, $nom);
    echo $controller->modifier($annee) ? "200" : "500";
    header('Location: ../../View/Annee.php');
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];
    $annee = $controller->recherche_par_id($id);
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
                    <input type="text" name="i" id="i" value="<?php echo $annee->getId() ?>" readonly/>
                </td>
            </tr>
            <tr>
                <td> <label for="nom">Nom : </label></td>
                <td><input type="text" name="nom" id="nom" value="<?php echo $annee->getNom() ?>" /></td>
            </tr>
            <tr>
                <td colspan="3"> <input type="submit" value="Modifier Annee"></td>
            </tr>
        </table>

    </form>
    <br>
</body>

</html>