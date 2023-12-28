<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Durées</title>
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
            <h1>Gestion des Durées</h1>
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
                <td> <label for="nom">Nom durée : </label></td>
                <td>
                    <input type="text" name="nom" id="nom">
                </td>
                <td> <label for="nom">Nombre de Jour : </label></td>
                <td> <input type="text" name="nbjour" id="nbjour" /></td>
                <td >
                    <button type="button" onclick="ajouter_duree()">Ajouter Durée</button>
                </td>
            </tr>
         
        </table>

    </form>
   

    <h3>Liste des Durées</h3>
    <input type="text" id="searchDuree" placeholder="Rechercher une durée..." onkeyup="lister_duree(this.value)">

    <table border="2">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Nombre de Jour</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody id="dataDuree">

        </tbody>
    </table>
   
    </div>
    <script src="../assets/js/duree.script.js"></script>

</body>

</html>