function lister_prof(cle) {
    $.ajax({
      type: "POST",
      data:{
          cle: cle
      },
      url: "../Routes/Prof/GET_BY_NAME.php",
      success: function (reponse) {
        $("#dataProf").html(reponse);
      },
    });
  }
  
  function supprimer_prof(id, nom) {
    var val = confirm("Voulez-vous supprimer l'prof'" + nom + " ?");
    if (val == true) {
      $.ajax({
        type: "POST",
        url: "../Routes/Prof/DELETE.php",
        data: {
          id: id,
        },
        success: function (reponse) {
          lister_prof("");
        },
      });
    }
  }
  
  function ajouter_prof() {
    var nom = document.getElementById("nom").value;
    var telephone = document.getElementById("telephone").value;
    var email = document.getElementById("email").value;
    var matiere = document.getElementById("matiere").value;
    var part = document.getElementById("part").value;
    $.ajax({
      type: "POST",
      url: "../Routes/Prof/POST.php",
      data: {
        nom: nom,
        telephone : telephone,
        email : email,
        matiere:matiere,
        part : part
      },
      success: function (reponse) {
        if (reponse === "200") {
          alert("Prof ajoutée avec succès !");
        } else {
          alert("Échec lors de l'ajout de l'prof'.");
        }
        lister_prof("");
      },
    });
  }
  
  function redirection_modification_prof(id) {
    window.location.href = `../Routes/Prof/PUT.php?id=${id}`;
  }
  
  lister_prof("");
  