<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Niveau</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- <link rel="stylesheet" href="../assets/css/style.css"> -->
</head>

<body>
    <h2>Gestion Niveau</h2>
    <form>
        <table>
            <tr>
                <td> <label for="nom">Niveau : </label> </td>
                <td> <input type="text" name="nom" id="nom"></td>
            </tr>
            <tr>
                <td colspan="3"><button type="button" onclick="ajouter_niveau()">Ajouter Niveau</button></td>
            </tr>
        </table>
    </form>

    <br>
    <input type="text" id="searchNiveau" placeholder="Rechercher une niveau..." onkeyup="lister_niveau(this.value)">

    <h2>Niveaux</h2>
    <table border="2">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody id="data">

        </tbody>
    </table>
    <script src="../assets/js/niveau.script.js"></script>
</body>

</html>