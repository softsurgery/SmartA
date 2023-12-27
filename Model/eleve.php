<?php
class Eleve {
    private $id;
    private $niveau;
    private $section;
    private $annee;
    private $nom;
    private $telephone;
    private $mail;
    private $motDePasse;
    private $reduction;

    public function __construct($id, $niveau, $section, $annee, $nom, $telephone, $mail, $motDePasse, $reduction) {
        $this->id = $id;
        $this->niveau = $niveau;
        $this->section = $section;
        $this->annee = $annee;
        $this->nom = $nom;
        $this->telephone = $telephone;
        $this->mail = $mail;
        $this->motDePasse = $motDePasse;
        $this->reduction = $reduction;
    }


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNiveau() {
        return $this->niveau;
    }

    public function setNiveau($niveau) {
        $this->niveau = $niveau;
    }

    public function getSection() {
        return $this->section;
    }

    public function setSection($section) {
        $this->section = $section;
    }

    public function getAnnee() {
        return $this->annee;
    }

    public function setAnnee($annee) {
        $this->annee = $annee;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    public function getMail() {
        return $this->mail;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function getMotDePasse() {
        return $this->motDePasse;
    }

    public function setMotDePasse($motDePasse) {
        $this->motDePasse = $motDePasse;
    }

    public function getReduction() {
        return $this->reduction;
    }

    public function setReduction($reduction) {
        $this->reduction = $reduction;
    }
}

?>