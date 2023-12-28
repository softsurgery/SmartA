<?php
class Acheter {
    private $id_el;
    private $idOffre;
    private $dateDebut;
    private $dateFin;

    public function __construct($id_el, $idOffre, $jours) {
        $this->id_el = $id_el;
        $this->idOffre = $idOffre;
        $this->dateDebut = date('Y-m-d');
        $this->dateFin = date('Y-m-d', strtotime($this->dateDebut . ' + ' . $jours . ' days'));
    }

    public function getIdEl() {
        return $this->id_el;
    }

    public function setIdEl($id_el) {
        $this->id_el = $id_el;
    }

    public function getIdOffre() {
        return $this->idOffre;
    }

    public function setIdOffre($idOffre) {
        $this->idOffre = $idOffre;
    }

    public function getDateDebut() {
        return $this->dateDebut;
    }

    public function setDateDebut($dateDebut) {
        $this->dateDebut = $dateDebut;
    }

    public function getDateFin() {
        return $this->dateFin;
    }

    public function setDateFin($dateFin) {
        $this->dateFin = $dateFin;
    }
}

?>