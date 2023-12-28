<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Utils/connect.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Acheter.php";

class AcheterController{
    protected $conn;

    public function __construct(){
        $this->conn = connect();
    }
    
    public function liste($id_el){	
        try{
            $req = "SELECT ID_EL,ID_OFFRE,DATE_DEBUT,DATE_FIN FROM acheter WHERE ID_EL = ?";
            $stmt = $this->conn->prepare($req);
            $stmt->bind_param("i", $id_el);
            $stmt->execute();
            $result = $stmt->get_result();
            $achats = [];
            while ($row = $result->fetch_assoc()) {
                $achat = $row["ID_OFFRE"];
                $achats[] = $achat;
            }
            return $achats;
        } catch(Exception $e){
            return null;
        }
    }

    public function ajouter(Acheter $acheter) {
        try {
            $id_el = $acheter->getIdEl();
            $id_offre = $acheter->getIdOffre();
            $dd = $acheter->getDateDebut();
            $df = $acheter->getDateFin();
            $stmt = $this->conn->prepare("INSERT INTO acheter (ID_EL, ID_OFFRE,DATE_DEBUT,DATE_FIN) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiss", $id_el, $id_offre,$dd,$df);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function recherche_par_id($id_offre) {
        try {
            $stmt = $this->conn->prepare("SELECT ID_EL FROM acheter WHERE ID_OFFRE = ?");
            $stmt->bind_param("i", $id_offre);
            $stmt->execute();
            $result = $stmt->get_result();
            $eleves = [];
            while ($row = $result->fetch_assoc()) {
                $eleve = $row["ID_EL"];
                $eleves[] = $eleve;
            }
            return $eleves;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    
}

?>