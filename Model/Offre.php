<?php
class Offre {
    private $id;
    private $idDuree;
    private $nom;
    private $prix;

    public function __construct($id, $idDuree, $nom, $prix) {
        $this->id = $id;
        $this->idDuree = $idDuree;
        $this->nom = $nom;
        $this->prix = $prix;
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
    public function getPrix() {
        return $this->prix;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
    }
}
?>