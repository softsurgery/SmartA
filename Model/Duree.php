<?php

class Duree{
    private $id;
    
    private $nom;

    private $nbjour;

    public function __construct($id, $nom,$nbjour){
        $this->id = $id;
        $this->nom = $nom;
        $this->nbjour = $nbjour;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getNbJour() {
        return $this->nbjour;
    }

    public function setNbJour($nbjour) {
        $this->nbjour = $nbjour;
    }

}

?>