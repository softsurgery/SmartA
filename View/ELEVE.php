<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Eléves</title>
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
        <h1>Gestion des Eléves</h1>
        </div>
        
    </header>
    <?php include_once "./Sociale.php"?>


   
    <div class="main" id="main">
    <?php include_once "./navigation.php"?>
    <form>
    <table>
            <tr>
                <td> <label for="nom">Nom Eleve : </label> </td>
                <td> <input type="text" name="nom" id="nom"></td>
                <td> <label for="telephone">Telephone : </label> </td>
                <td> <input type="tel" name="telephone" id="telephone"></td>
            </tr>
            <tr>
                <td> <label for="email">Email : </label> </td>
                <td> <input type="email" name="email" id="email"></td>
                <td> <label for="motDePasse">Mot de passe : </label> </td>
                <td> <input type="password" name="motDePasse" id="motDePasse"></td>
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
                                echo "<option value='{$annee->getId()}'>{$annee->getNom()}</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
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
                                echo "<option value='{$niveau->getId()}'>{$niveau->getNom()}</option>";
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
                                echo "<option value='{$section->getId()}'>{$section->getNom()}</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
          
                <td> <label for="reduction">Reduction : </label> </td>
                <td> <input type="number" name="reduction" id="reduction"></td>
            </tr>
            <tr>
                <td colspan="3"><button type="button" onclick="ajouter_eleve()">Ajouter Eleve</button></td>
            </tr>
        </table>
    </form>

    <h3>Liste des Eléves</h3>
    <input type="text" id="searchEleve" placeholder="Rechercher une eleve..." onkeyup="lister_eleve(this.value)">
    <h2>Liste des Eléves</h2>
    <table border="2">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Telephone</th>
                <th>Email</th>
                <th>Mot de Passe</th>
                <th>Annee</th>
                <th>Niveau</th>
                <th>Section</th>
                <th>Reduction</th>
                <th>Offres</th>
                <th>Ajouter Offre</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody id="dataEleve">

        </tbody>
    </table>
    </div>
    <script src="../assets/js/eleve.script.js"></script>
    <script src="../assets/js/plugins/form.js"></script>
</body>

</html>