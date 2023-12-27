function lister_annee(cle) {
  $.ajax({
    type: "POST",
    data: {
      cle: cle,
    },
    url: "../Routes/Annee/GET_BY_NAME.php",
    success: function (reponse) {
      $("#dataAnnee").html(reponse);
    },
  });
}

function supprimer_annee(id, nom) {
  var val = confirm("Voulez vous supprimer l'annee " + nom);
  if (val == true) {
    $.ajax({
      type: "POST",
      url: "../Routes/Annee/DELETE.php",
      data: {
        id: id,
      },
      success: function (reponse) {
        lister_annee("");
      },
    });
  }
}

function ajouter_annee() {
  var nom = document.getElementById("nom");
  $.ajax({
    type: "POST",
    url: "../Routes/Annee/POST.php",
    data: {
      nom: nom.value + "/" + document.getElementById("anneeproche").innerHTML,
    },
    success: function (reponse) {
      if (reponse === "200") alert("Annee Ajouter avec succee !");
      else alert("Echec lors de l'ajout");
      lister_annee("");
    },
  });
}

function redirection_modification_annee(id) {
  window.location.href = `../Routes/Annee/PUT.php?id=${id}`;
}

function nextYear() {
  document.getElementById("anneeproche").innerHTML =
    Number(document.getElementById("nom").value) + 1;
}

lister_annee("");
