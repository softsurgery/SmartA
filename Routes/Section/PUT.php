<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/SectionController.php";

$controller = new SectionController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["i"];
    $nom = $_POST["nom"];
    $section = new Section($id, $nom);
    echo $controller->modifier($section) ? "200" : "500";
    header('Location: ../../View/Section.php');
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];
    $section = $controller->recherche_par_id($id);
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
    <h2>Modifier Section</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
        <table>
            <tr>
                <td> <label for="nom">ID : </label></td>
                <td>
                    <input type="text" name="i" id="i" value="<?php echo $section->getId() ?>" readonly/>
                </td>
            </tr>
            <tr>
                <td> <label for="nom">Nom : </label></td>
                <td><input type="text" name="nom" id="nom" value="<?php echo $section->getNom() ?>" /></td>
            </tr>
            <tr>
                <td colspan="3"> <input type="submit" value="Modifier Section"></td>
            </tr>
        </table>

    </form>
    <br>
</body>

</html>