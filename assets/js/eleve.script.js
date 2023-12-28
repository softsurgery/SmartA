function lister_eleve(cle) {
    $.ajax({
      type: "POST",
      data:{
          cle: cle
      },
      url: "../Routes/ELEVE/GET_BY_NAME.php",
      success: function (reponse) {
        $("#dataEleve").html(reponse);
      },
    });
  }
  
  function supprimer_eleve(id, nom) {
    var val = confirm("Voulez-vous supprimer l'eleve'" + nom + " ?");
    if (val == true) {
      $.ajax({
        type: "POST",
        url: "../Routes/Eleve/DELETE.php",
        data: {
          id: id,
        },
        success: function (reponse) {
          lister_eleve("");
        },
      });
    }
  }
  
  function ajouter_eleve() {
    var nom = document.getElementById("nom").value;
    var niveau = document.getElementById("niveau").value;
    var annee = document.getElementById("annee").value;
    var section = document.getElementById("section").value;
    var telephone = document.getElementById("telephone").value;
    var email = document.getElementById("email").value;
    var motDePasse = document.getElementById("motDePasse").value;
    var reduction = document.getElementById("reduction").value;
    $.ajax({
      type: "POST",
      url: "../Routes/Eleve/POST.php",
      data: {
        nom: nom,
        telephone : telephone,
        email : email,
        niveau : niveau,
        annee : annee,
        section : section,
        motDePasse : motDePasse,
        reduction : reduction
      },
      success: function (reponse) {
        if (reponse === "200") {
          alert("Eleve ajoutée avec succès !");
        } else {
          alert("Échec lors de l'ajout de l'eleve'.");
        }
        lister_eleve("");
      },
    });
  }
  
  function redirection_modification_eleve(id) {
    window.location.href = `../Routes/Eleve/PUT.php?id=${id}`;
  }

  function redirection_ajouter_offre_eleve(id,name) {
    window.location.href = `../Routes/Acheter/POST.php?id=${id}&name=${name}`;
  }
  
  lister_eleve("");
  