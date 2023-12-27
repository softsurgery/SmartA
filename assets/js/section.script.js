function lister_section(cle) {
    $.ajax({
      type: "POST",
      data:{
          cle:cle
      },
      url: "../Routes/Section/GET_BY_NAME.php",
      success: function (reponse) {
        $("#dataSection").html(reponse);
      },
    });
  }
  
  function supprimer_section(id,nom) {
    var val = confirm("Voulez vous supprimer la section " + nom);
    if (val == true) {
      $.ajax({
        type: "POST",
        url: "../Routes/Section/DELETE.php",
        data: {
          id: id,
        },
        success: function (reponse) {
          lister_section("");
        },
      });
    }
  }
  
  function ajouter_section() {
    var nom = document.getElementById("nom").value;
    //...controle de saisie
    $.ajax({
      type: "POST",
      url: "../Routes/Section/POST.php",
      data: {
        nom: nom,
      },
      success: function (reponse) {
        if (reponse === "200") alert("Section Ajouter avec succee !");
        else alert("Echec lors de l'ajout");
        lister_section("");
      },
    });
  }
  
  function redirection_modification_section(id){
      window.location.href = `../Routes/section/PUT.php?id=${id}`;
      console.log(`../Routes/section/PUT.php?id=${id}`);
  }
  
  lister_section("");
  