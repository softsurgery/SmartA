<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Offres</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="../assets/css/styleges.css">
    <link rel="icon" type="image/x-icon" href="../assets/images/sa.ico">

</head>

<body>
    <header>
        <div class="entete" id="entete">
            <div class="logo" id="logo">
                <img src="../assets/images/logo.png" style height="auto" width="70px" />
            </div>
            <h1>Gestion des Offres</h1>
        </div>

    </header>
    <?php include_once "./Sociale.php"?>


    <div id="Sidenav" class="sidenav">

    <?php include_once "./navigation.php"?>

    </div>
    <div class="main" id="main">

        <form id="formOffre">
            <table>
                <tr>
                    <td> <label for="nom">Nom Offre : </label> </td>
                    <td> <input type="text" name="nom" id="nom"></td>
                    <td> <label for="duree">Durée : </label> </td>
                    <td>
                        <select name="duree" id="duree">
                            <option selected disabled>Choisir Duree</option>
                            <?php
                            require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/DureeController.php";

                            $dureeController = new DureeController();
                            $durees = $dureeController->liste();

                            if ($durees !== null) {
                                foreach ($durees as $duree) {
                                    echo "<option count='{$duree->getNbjour()}' value='{$duree->getId()}'>{$duree->getNom()} - {$duree->getNbjour()} jours</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <?php
                        require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/MatiereController.php";

                        $matiereController = new MatiereController();
                        $matieres = $matiereController->liste();

                        if ($matieres !== null) {
                            foreach ($matieres as $matiere) {
                                $id = $matiere->getId();
                                $nom = $matiere->getNom();
                                echo "<input type='checkbox' name='matiere' value='$id'/> $nom
                                <input style='width:200px' type='number' name='prix'/><br>
                                ";
                            }
                        }
                        ?>
                    </td>
                    <td colspan="2"><button type="button" onclick="ajouter_offre()">Ajouter Offre</button></td>

                </tr>
            </table>
        </form>

        <h3>Liste des Offres</h3>
        <input type="text" id="searchOffre" placeholder="Rechercher une offre..." onkeyup="lister_offres(this.value)">
        <h2>Liste des offres</h2>
        <table border="2">
            <thead>
                <tr>
                    <th>Nom Offre</th>
                    <th>Durée</th>
                    <th>Matieres</th>
                    <th>Prix Totale</th>
                    <!-- <th>Modifier</th> -->
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody id="dataOffre">

            </tbody>
        </table>
        <script src="../assets/js/offre.script.js"></script>
        <script src="../assets/js/plugins/form.js"></script>

</body>

</html>