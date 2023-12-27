<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Utils/connect.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Annee.php";

class AnneeController{
    protected $conn;

    public function __construct(){
        $this->conn = connect();
    }
    
    public function liste(){
        try{
            $req = "SELECT ID_ANNEE,ANNEE FROM annee_scolaire";
            $list = $this->conn->query($req);
            $annees = [];
            while($row = $list->fetch_assoc()){
                $annee = new Annee($row["ID_ANNEE"],$row["ANNEE"]);
                $annees[] = $annee;
            }
            return $annees;
        } catch(Exception $e){
            return null;
        }
    }

    public function ajouter(Annee $annee) {
        try {
            $nom = $annee->getNom();
            $stmt = $this->conn->prepare("INSERT INTO annee_scolaire (ANNEE) VALUES (?)");
            $stmt->bind_param("s",$nom);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function supprimer($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM annee_scolaire WHERE ID_ANNEE = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function modifier(Annee $annee) {
        try {
            $id = $annee->getId();
            $nom = $annee->getNom();
            $stmt = $this->conn->prepare("UPDATE annee_scolaire SET ANNEE = ? WHERE ID_ANNEE = ?");
            $stmt->bind_param("si",$nom,$id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function recherche_par_id($id) {
        try {
            $stmt = $this->conn->prepare("SELECT ID_ANNEE, ANNEE FROM annee_scolaire WHERE ID_ANNEE = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $annee = new Annee($row["ID_ANNEE"], $row["ANNEE"]);
                return $annee;
            } else {
                return null;
            }
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
public function recherche_par_nom($nom) {
    try {
        $nom =  '%' . $nom . '%';
        $stmt = $this->conn->prepare("SELECT ID_ANNEE, ANNEE FROM annee_scolaire WHERE ANNEE LIKE ?");
        $stmt->bind_param("s", $nom);
        $stmt->execute();
        $result = $stmt->get_result();
        $annees = [];
        while ($row = $result->fetch_assoc()) {
            $annee = new Annee($row["ID_ANNEE"], $row["ANNEE"]);
            $annees[] = $annee;
        }
        return $annees;
    } catch (Exception $e) {
        die("Erreur : " . $e->getMessage());
    }
}

    
}

?>