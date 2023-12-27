function lister_niveau(cle) {
    $.ajax({
      type: "POST",
      data:{
          cle:cle
      },
      url: "../Routes/Niveau/GET_BY_NAME.php",
      success: function (reponse) {
        $("#dataNiveaux").html(reponse);
      },
    });
  }
  
  function supprimer_niveau(id, nom) {
    var val = confirm("Voulez-vous supprimer le niveau " + nom + " ?");
    if (val == true) {
      $.ajax({
        type: "POST",
        url: "../Routes/Niveau/DELETE.php",
        data: {
          id: id,
        },
        success: function (reponse) {
          lister_niveau("");
        },
      });
    }
  }
  
  function ajouter_niveau() {
    var nom = document.getElementById("nom");
    $.ajax({
      type: "POST",
      url: "../Routes/Niveau/POST.php",
      data: {
        nom: nom.value,
      },
      success: function (reponse) {
        if (reponse == "200") {
          alert("Niveau ajouté avec succès !");
        } else {
          alert("Échec lors de l'ajout du niveau.");
        }
        lister_niveau("");
      },
    });
  }
  
  function redirection_modification_niveau(id) {
    window.location.href = `../Routes/Niveau/PUT.php?id=${id}`;
  }
  
  lister_niveau("");
  