function lister_duree(cle) {
  $.ajax({
    type: "POST",
    data: {
      cle: cle,
    },
    url: "../Routes/Duree/GET_BY_NAME.php",
    success: function (reponse) {
      $("#dataDuree").html(reponse);
    },
  });
}

function supprimer_duree(id, nom) {
  var val = confirm("Voulez vous supprimer l'duree " + nom);
  if (val == true) {
    $.ajax({
      type: "POST",
      url: "../Routes/Duree/DELETE.php",
      data: {
        id: id,
      },
      success: function (reponse) {
        lister_duree("");
      },
    });
  }
}

function ajouter_duree() {
  var nom = document.getElementById("nom");
  var nbjour = document.getElementById("nbjour");
  $.ajax({
    type: "POST",
    url: "../Routes/Duree/POST.php",
    data: {
      nom: nom.value,
      nbjour : nbjour.value
    },
    success: function (reponse) {
      if (reponse === "200") alert("Duree Ajouter avec succee !");
      else alert("Echec lors de l'ajout");
      lister_duree("");
    },
  });
}

function redirection_modification_duree(id) {
  window.location.href = `../Routes/Duree/PUT.php?id=${id}`;
}

lister_duree("");

