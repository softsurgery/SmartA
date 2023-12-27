<?php

class Prof {

    private $id;
    private $matiere;
    private $nom;
    private $telephone;
    private $email;
    private $part;

    public function __construct($id, $matiere, $nom, $telephone, $email, $part) {
        $this->id = $id;
        $this->matiere = $matiere;
        $this->nom = $nom;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->part = $part;
    }

    public function getId() {
        return $this->id;
    }

    public function getMatiere() {
        return $this->matiere;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPart() {
        return $this->part;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setMatiere($matiere) {
        $this->matiere = $matiere;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPart($part) {
        $this->part = $part;
    }
}
?>