<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Annee</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- <link rel="stylesheet" href="../assets/css/style.css"> -->
</head>

<body>
    <h2>Gestion Annee</h2>
    <form>
        <table>
            <tr>
                <td> <label for="nom">Aneee : </label></td>
                <td>
                    <input type="number" name="nom" id="nom" min="2020" max="2100" onkeyup="nextYear()">
                   <strong>/</strong><span id="anneeproche"></span>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <button type="button" onclick="ajouter_annee()">Ajouter Annee</button>
                </td>
            </tr>
        </table>

    </form>
    <br>
    <input type="text" id="searchAnnee" placeholder="Rechercher une annee..." onkeyup="lister_annee(this.value)">

    <h2>Annees</h2>
    <table border="2">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody id="dataAnnee">

        </tbody>
    </table>
    <!-- <script src="../assets/js/plugins/form.js"></script> -->
    <script src="../assets/js/annee.script.js"></script>
</body>

</html>