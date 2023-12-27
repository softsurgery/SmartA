<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/EleveController.php";

$controller = new EleveController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["i"];
    $niveau = $_POST["niveau"];
    $section = $_POST["section"];
    $annee = $_POST["annee"];
    $nom = $_POST["nom"];
    $telephone = $_POST["telephone"];
    $mail = $_POST["email"];
    $motDePasse = $_POST["motDePasse"];
    $reduction = $_POST["reduction"];
    $controller = new EleveController();
    $eleve = new Eleve($id, $niveau, $section, $annee, $nom, $telephone, $mail, $motDePasse, $reduction);
    echo $controller->modifier($eleve) ? "200" : "500";
    header('Location: ../../View/Eleve.php');
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];
    $eleve = $controller->recherche_par_id($id);
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
    <h2>Modifier Eleve</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
        <table>
            <tr>
                <td> <label for="id">ID : </label> </td>
                <td> <input type="text" name="i" id="i" value="<?php echo $id ?>" readonly></td>
            </tr>
            <tr>
                <td> <label for="nom">Nom Eleve : </label> </td>
                <td> <input type="text" name="nom" id="nom" value="<?php echo $eleve->getNom() ?>"></td>
            </tr>
            <tr>
                <td> <label for="nom">Telephone : </label> </td>
                <td> <input type="tel" name="telephone" id="telephone" value="<?php echo $eleve->getTelephone() ?>"></td>
            </tr>
            <tr>
                <td> <label for="email">Email : </label> </td>
                <td> <input type="email" name="email" id="email" value="<?php echo $eleve->getMail() ?>"></td>
            </tr>
            <tr>
                <td> <label for="motDePasse">Mot de passe : </label> </td>
                <td> <input type="password" name="motDePasse" id="motDePasse" value="<?php echo $eleve->getMotDePasse() ?>"></td>
            </tr>
            <tr>
                <td> <label for="annee">Annee : </label> </td>
                <td>
                    <select name="annee" id="annee">
                        <option selected disabled>Choisir Annee</option>
                        <?php
                        require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/AnneeController.php";

                        $anneeController = new AnneeController();
                        $annees = $anneeController->liste();

                        if ($annees !== null) {
                            foreach ($annees as $annee) {
                                if ($eleve->getAnnee() == $annee->getId()) $selected = "selected";
                                else $selected = "";
                                echo "<option " . $selected . " value='{$annee->getId()}'>{$annee->getNom()}</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td> <label for="niveau">Niveau : </label> </td>
                <td>
                    <select name="niveau" id="niveau">
                        <option selected disabled>Choisir Niveau</option>
                        <?php
                        require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/NiveauController.php";

                        $niveauController = new NiveauController();
                        $niveaux = $niveauController->liste();

                        if ($niveaux !== null) {
                            foreach ($niveaux as $niveau) {
                                if ($eleve->getNiveau() == $niveau->getId()) $selected = "selected";
                                else $selected = "";
                                echo "<option " . $selected . " value='{$niveau->getId()}'>{$niveau->getNom()}</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td> <label for="section">Section : </label> </td>
                <td>
                    <select name="section" id="section">
                        <option selected disabled>Choisir Section</option>
                        <?php
                        require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/SectionController.php";

                        $sectionController = new SectionController();
                        $sections = $sectionController->liste();

                        if ($sections !== null) {
                            foreach ($sections as $section) {
                                if ($eleve->getSection() == $section->getId()) $selected = "selected";
                                else $selected = "";
                                echo "<option " . $selected . " value='{$section->getId()}'>{$section->getNom()}</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td> <label for="reduction">Reduction : </label> </td>
                <td> <input type="number" name="reduction" min="0" max="100" id="reduction" value="<?php echo $eleve->getReduction()?>"/> </td>
            </tr>
            <tr>
                <td colspan="3"><input type="submit" value="Modifier Eleve"></td>
            </tr>
        </table>
    </form>
</body>

</html>