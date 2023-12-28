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
        <h1>Gestion des prof</h1>
        </div>
        
    </header>
    <?php include_once "./Sociale.php"?>


    <div id="Sidenav" class="sidenav">
     
    <?php include_once "./navigation.php"?>
       
    </div>
    <div class="main" id="main">
  
    <form>
        <table>
            <tr>
                <td> <label for="nom">Nom Prof : </label> </td>
                <td> <input type="text" name="nom" id="nom"></td>
            
                <td> <label for="telephone">Telephone : </label> </td>
                <td> <input type="tel" name="telephone" id="telephone"></td>
            </tr>
            <tr>
                <td> <label for="email">Email : </label> </td>
                <td> <input type="email" name="email" id="email"></td>
            
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
                                echo "<option value='{$matiere->getId()}'>{$matiere->getNom()}</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td> <label for="part">Part : </label> </td>
                <td> <input type="number" name="part" id="part"></td>
           
                <td colspan="2"><button type="button" onclick="ajouter_prof()">Ajouter Prof</button></td>
            </tr>
        </table>
    </form>

    <h3>Liste des prof</h3>
    <input type="text" id="searchProf" placeholder="Rechercher une prof..." onkeyup="lister_prof(this.value)">
    
    <table border="2">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Telephone</th>
                <th>Email</th>
                <th>Matiere</th>
                <th>Part</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody id="dataProf">

        </tbody>
    </table>
    </div>
    <script src="../assets/js/prof.script.js"></script>
    <script src="../assets/js/plugins/form.js"></script>
</body>

</html>