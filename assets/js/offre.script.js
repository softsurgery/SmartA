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

  var selectedMatieres = [];
  var selectedPrix = [];
  var checkboxes = document.getElementsByName("matiere");
  var prices = document.getElementsByName("prix");
  for (var i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) selectedMatieres.push(checkboxes[i].value);
    selectedPrix.push(prices[i].value);
  }

  var data = {
    nom: nom,
    duree: duree,
  };

  $.ajax({
    type: "POST",
    url: "../Routes/Offre/POST.php",
    data: data,
    traditional: true,
    success: async function (reponse) {
      if (reponse === "200") {
        await new Promise(r => setTimeout(r, 2000));
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
 
  $.ajax({
    type: "GET",
    url: "../Routes/Offre/GET_LAST.php",
    success: function (reponse) {
      if (reponse) {
        let id_offre = reponse;
        for(let i = 0 ; i< selectedMatieres.length;i++){
          $.ajax({
            type: "POST",
            url: "../Routes/Appartienir/POST.php",
            data: {
              id_offre: id_offre,
              id_matiere: selectedMatieres[i],
              prix: selectedPrix[i]
            },
            success: function (response) {
              if (response === "200") {
                console.log("Matière associée avec succès !");
              } else {
                console.log("Échec lors de l'association de la matière");
              }
            },
            error: function () {
              console.log("Une erreur s'est produite lors de la requête AJAX");
            },
          });
        };
      }
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
