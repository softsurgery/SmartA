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
        <h1>calculateur</h1>
        </div>
        
    </header>
    <?php include_once "./Sociale.php"?>
   

    <div id="Sidenav" class="sidenav">
     
    <?php include_once "./navigation.php"?>
       
    </div>
    <div class="main" id="main">
  
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
        <table>
            <tr>
                <td> <label for="nom">Nom Prof : </label> </td>
                <td>  <select name="prof" id="prof">
                        <option selected disabled>Choisir Prof</option>
                        <?php
                        require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/ProfController.php";

                        $profController = new ProfController();
                        $profs = $profController->liste();

                        if ( $profs != null) {
                            foreach ( $profs as  $profs) {
                                $id =  $profs->getId();
                                $nom = $profs->getNom();
                                echo "<option value='$id'>$nom</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
                <td> <label for="part">Durées : </label> </td>
                <td> <input type="date" name="date_debut_cal" id="date_debut_cal"placeholder="date début calcul"></td>
                <td> <input type="date" name="date_fin_cal" id="date_fin_cal"placeholder="date fin calcul"></td>
                <td ><input type="submit" value="calculer"></td>
            </tr>

        </table>
    </form>

    <h3>Liste des eleve </h3>
    <input type="text" id="searchProf" placeholder="Rechercher une prof..." onkeyup="lister_prof(this.value)">
     <!-- le recherche ysir ya bil  date walla bil matiere_prof -->
    <table border="2">
        <thead>
            <tr>
                <th>Nom eleve</th>
                <th>niveau et section</th>
                <th>durée</th>
                <th>date inscription</th>
                <th>date expiration</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/ProfController.php";
            require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Prof.php";

            require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/AppartienirController.php";
            require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Appartienir.php";

            require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/AcheterController.php";
            require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Acheter.php";

            require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/EleveController.php";
            require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Eleve.php";

            // Check if form is submitted
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $somme = 0;
                $profId = $_POST["prof"];
                $profController = new ProfController();
                $prof = $profController->recherche_par_id($profId);
                $id_matiere = $prof->getMatiere();
                $appartienirController = new AppartienirController();
                $offres = $appartienirController->liste_par_matiere($id_matiere);
                $acheterController = new AcheterController();
                $eleves = [];
                foreach ($offres as $offre){
                    $feleves = $acheterController->recherche_par_id($offre["id_offre"]);
                    $somme += count($feleves)*$offre["prix"];
                    $eleves = array_merge($eleves,$feleves);
                }
                $eleveController = new EleveController();
                foreach($eleves as $eleveId){
                    $eleve = $eleveController->recherche_par_id($eleveId);
                    $nom = $eleve->getNom();
                    echo "<tr>
                    <td>$nom</td>
                    </tr>";
                }

            }
            ?>
        </tbody>
    </table>
    </div>
    <script src="../assets/js/prof.script.js"></script>
    <script src="../assets/js/plugins/form.js"></script>
</body>

</html>