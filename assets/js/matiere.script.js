function lister_matiere(cle) {
    $.ajax({
      type: "POST",
      data:{
          cle: cle
      },
      url: "../Routes/Matiere/rechercheNom.php",
      success: function (reponse) {
        $("#data").html(reponse);
      },
    });
  }
  
  function supprimer_matiere(id, nom) {
    var val = confirm("Voulez-vous supprimer la matière " + nom + " ?");
    if (val == true) {
      $.ajax({
        type: "POST",
        url: "../Routes/Matiere/supprimer.php",
        data: {
          id: id,
        },
        success: function (reponse) {
          lister_matiere("");
        },
      });
    }
  }
  
  function ajouter_matiere() {
    var nom = document.getElementById("nom_matiere").value;
    // Validation des données
    $.ajax({
      type: "POST",
      url: "../Routes/Matiere/ajouter.php",
      data: {
        nom: nom,
      },
      success: function (reponse) {
        if (reponse === "200") {
          alert("Matière ajoutée avec succès !");
        } else {
          alert("Échec lors de l'ajout de la matière.");
        }
        lister_matiere("");
      },
    });
  }
  
  function redirection_modification_matiere(id) {
    window.location.href = `../Routes/Matiere/modifier.php?id=${id}`;
  }
  
  lister_matiere("");
  