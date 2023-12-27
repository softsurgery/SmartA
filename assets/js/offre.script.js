function lister_offres(cle) {
  $.ajax({
    type: "POST",
    data: {
      cle: cle,
    },
    url: "../Routes/Offre/GET_BY_NAME.php",
    success: function (reponse) {
      $("#dataOffre").html(reponse);
    },
  });
}

function supprimer_offre(id, nom) {
  var val = confirm("Voulez-vous supprimer l'offre " + nom + " ?");
  if (val == true) {
    $.ajax({
      type: "POST",
      url: "../Routes/Offre/DELETE.php",
      data: {
        id: id,
      },
      success: function (reponse) {
        lister_offres("");
      },
    });
  }
}
function ajouter_offre() {

  var nom = document.getElementById("nom").value;
  var duree = document.getElementById("duree").value;
  var prix = document.getElementById("prix").value;

  var selectedMatieres = [];
    var checkboxes = document.getElementsByName('matiere');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) selectedMatieres.push(checkboxes[i].value);
    }

  var data = {
    nom: nom,
    duree: duree,
    prix: prix,
  };

  $.ajax({
    type: "POST",
    url: "../Routes/Offre/POST.php",
    data: data,
    traditional: true,
    success: function (reponse) {
      if (reponse === "200") {
        alert("Offre ajoutée avec succès !");
      } else {
        alert("Échec lors de l'ajout de l'offre");
      }
      lister_offres("");
    },
    error: function () {
      alert("Une erreur s'est produite lors de la requête AJAX");
    },
  });

  

}


function redirection_modification_offre(id) {
  window.location.href = `../Routes/Offre/PUT.php?id=${id}`;
}

lister_offres("");
