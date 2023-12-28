<?php

class Appartienir{
    private $id_matiere;
    
    private $id_offre;

    private $prix;

    public function __construct($id_offre,$id_matiere,$prix){
        $this->id_matiere = $id_matiere;
        $this->id_offre = $id_offre;
        $this->prix = $prix;
    }

    public function getIdMatiere() {
        return $this->id_matiere;
    }

    public function setIdMatiere($id_matiere) {
        $this->id_matiere = $id_matiere;
    }

    public function getIdOffre() {
        return $this->id_offre;
    }

    public function setIdOffre($id_offre) {
        $this->id_offre = $id_offre;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
    }



}

?>