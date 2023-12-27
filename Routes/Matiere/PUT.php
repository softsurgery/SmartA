<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/MatiereController.php";

$controller = new MatiereController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["i"];
    $nom = $_POST["nom"];
    $matiere = new Matiere($id, $nom);
    echo $controller->modifier($matiere) ? "200" : "500";
    header('Location: ../../View/Matiere.php');
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];
    $matiere = $controller->recherche_par_id($id);
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
                    <input type="text" name="i" id="i" value="<?php echo $matiere->getId() ?>" readonly/>
                </td>
            </tr>
            <tr>
                <td> <label for="nom">Nom : </label></td>
                <td><input type="text" name="nom" id="nom" value="<?php echo $matiere->getNom() ?>" /></td>
            </tr>
            <tr>
                <td colspan="3"> <input type="submit" value="Modifier Matiere"></td>
            </tr>
        </table>

    </form>
    <br>
</body>

</html>