<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/ProfController.php";

$controller = new ProfController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["i"];
    $nom = $_POST["nom"];
    $telephone = $_POST["telephone"];
    $email = $_POST["email"];
    $matiere = $_POST["matiere"];
    $part = $_POST["part"];
    $prof = new Prof($id, $matiere, $nom, $telephone, $email, $part);
    echo $controller->modifier($prof) ? "200" : "500";
    header('Location: ../../View/Prof.php');
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];
    $prof = $controller->recherche_par_id($id);
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
    <h2>Modifier Prof</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
        <table>
            <tr>
                <td> <label for="nom">ID : </label></td>
                <td>
                    <input type="text" name="i" id="i" value="<?php echo $prof->getId() ?>" readonly />
                </td>
            </tr>
            <tr>
                <td> <label for="nom">Nom Prof : </label> </td>
                <td> <input type="text" name="nom" id="nom" value="<?php echo $prof->getNom() ?>"></td>
            </tr>
            <tr>
                <td> <label for="telephone">Telephone : </label> </td>
                <td> <input type="tel" name="telephone" id="telephone"  value="<?php echo $prof->getTelephone() ?>"></td>
            </tr>
            <tr>
                <td> <label for="email">Email : </label> </td>
                <td> <input type="email" name="email" id="email" value="<?php echo $prof->getEmail() ?>"></td>
            </tr>
            <tr>
                <td> <label for="matiere">Matiere : </label> </td>
                <td>
                    <select name="matiere" id="matiere">
                        <option selected disabled>Choisir Matiere</option>
                        <?php
                        require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/MatiereController.php";

                        $matiereController = new MatiereController();
                        $matieres = $matiereController->liste();

                        if ($matieres !== null) {
                            foreach ($matieres as $matiere) {
                                if ($prof->getMatiere() == $matiere->getId()) $selected = "selected";
                                else $selected = "";
                                echo  "<option " . $selected . " value='{$matiere->getId()}'>{$matiere->getNom()}</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td> <label for="part">Part : </label> </td>
                <td> <input type="number" name="part" id="part" min="0" max="100" value="<?php echo $prof->getPart() ?>"></td>
            </tr>
            <tr>
                <td colspan="3"><input type="submit" value="Modifier Prof"></td>
            </tr>
        </table>
    </form>
</body>

</html>