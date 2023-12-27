<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Section</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Gestion Section</h2>
    <form>
        <label for="nomSection">Section : </label>
        <input type="text" name="nomSection" id="nomSection">
        <button type="button" onclick="ajouter_section()">Ajouter Section</button>
    </form>
    <input type="text" id="searchSection" placeholder="Rechercher une section..." onkeyup="lister_section(this.value)">
    <h2>Sections</h2>
    <table border="2">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody id="dataSection">

        </tbody>
    </table>
    <script src="../assets/js/section.script.js"></script>
</body>
</html>
