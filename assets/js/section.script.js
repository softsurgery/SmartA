function lister_section(cle) {
    $.ajax({
      type: "POST",
      data:{
          cle:cle
      },
      url: "../Routes/Section/rechercheNom.php",
      success: function (reponse) {
        $("#data").html(reponse);
      },
    });
  }
  
  function supprimer_section(id,nom) {
    var val = confirm("Voulez vous supprimer la section " + nom);
    if (val == true) {
      $.ajax({
        type: "POST",
        url: "../Routes/Section/supprimer.php",
        data: {
          id: id,
        },
        success: function (reponse) {
          lister("");
        },
      });
    }
  }
  
  function ajouter_section() {
    var nom = document.getElementById("nom").value;
    //...controle de saisie
    $.ajax({
      type: "POST",
      url: "../Routes/Section/ajouter.php",
      data: {
        nom: nom,
      },
      success: function (reponse) {
        if (reponse === "200") alert("Section Ajouter avec succee !");
        else alert("Echec lors de l'ajout");
        lister("");
      },
    });
  }
  
  function redirection_modification_section(id){
      window.location.href = `../Routes/section/modifier.php?id=${id}`;
      console.log(`../Routes/section/modifier.php?id=${id}`);
  }
  
  lister_section("");
  