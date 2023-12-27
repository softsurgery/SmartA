<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Utils/connect.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Duree.php";

class DureeController{
    protected $conn;

    public function __construct(){
        $this->conn = connect();
    }
    
    public function liste(){
        try{
            $req = "SELECT ID_DUREE,DUREE,NB_JOUR FROM duree";
            $list = $this->conn->query($req);
            $durees = [];
            while($row = $list->fetch_assoc()){
                $duree = new Duree($row["ID_DUREE"],$row["DUREE"],$row["NB_JOUR"]);
                $durees[] = $duree;
            }
            return $durees;
        } catch(Exception $e){
            return null;
        }
    }

    public function ajouter(Duree $duree) {
        try {
            $nom = $duree->getNom();
            $nbjour = $duree->getNbJour();
            $stmt = $this->conn->prepare("INSERT INTO duree (DUREE,NB_JOUR) VALUES (?,?)");
            $stmt->bind_param("si",$nom,$nbjour);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function supprimer($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM duree WHERE ID_DUREE = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function modifier(Duree $duree) {
        try {
            $id = $duree->getId();
            $nom = $duree->getNom();
            $nbjour = $duree->getNbJour();
            $stmt = $this->conn->prepare("UPDATE duree SET DUREE = ? , NB_JOUR = ? WHERE ID_DUREE = ?");
            $stmt->bind_param("sii",$nom,$nbjour,$id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function recherche_par_id($id) {
        try {
            $stmt = $this->conn->prepare("SELECT ID_DUREE,DUREE,NB_JOUR FROM duree WHERE ID_DUREE = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $duree = new Duree($row["ID_DUREE"], $row["DUREE"], $row["NB_JOUR"]);
                return $duree;
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
        $stmt = $this->conn->prepare("SELECT ID_DUREE, DUREE, NB_JOUR FROM duree WHERE DUREE LIKE ?");
        $stmt->bind_param("s", $nom);
        $stmt->execute();
        $result = $stmt->get_result();
        $durees = [];
        while ($row = $result->fetch_assoc()) {
            $duree = new Duree($row["ID_DUREE"], $row["DUREE"], $row["NB_JOUR"]);
            $durees[] = $duree;
        }
        return $durees;
    } catch (Exception $e) {
        die("Erreur : " . $e->getMessage());
    }
}

    
}

?>