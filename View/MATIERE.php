<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Matières</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../assets/js/matiere.script.js"></script>
</head>
<body>
    <h2>Gestion des Matières</h2>
    <form>
        <table>
            <tr>
                <td> <label for="nom_matiere">Nom de la matière : </label></td>
                <td><input type="text" name="nom_matiere" id="nom_matiere"></td>
            </tr>
            <tr>
                <td colspan="2"> <button type="button" onclick="ajouter_matiere()">Ajouter Matière</button></td>
            </tr>
        </table>
    </form>

    <br>
    <input type="text" id="searchMatiere" placeholder="Rechercher une matière..." onkeyup="lister_matiere(this.value)">

    <h2>Matières</h2>
    <table border="2">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody id="dataMatiere">
            
        </tbody>
    </table>
    <script src="../assets/js/Matiere.script.js"></script>
</body>
</html>
