<?php
class Offre {
    private $id;
    private $idDuree;
    private $nom;

    public function __construct($id, $idDuree, $nom) {
        $this->id = $id;
        $this->idDuree = $idDuree;
        $this->nom = $nom;
    }


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdDuree() {
        return $this->idDuree;
    }

    public function setIdDuree($idDuree) {
        $this->idDuree = $idDuree;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }
}
?>