<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Utils/connect.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Appartienir.php";

class AppartienirController{
    protected $conn;

    public function __construct(){
        $this->conn = connect();
    }
    
    public function liste($id_offre){
        try{
            $req = "SELECT ID_OFFRE,ID_MAT,prix FROM appartienir WHERE id_offre = ?";
            $stmt = $this->conn->prepare($req);
            $stmt->bind_param("i", $id_offre);
            $stmt->execute();
            $result = $stmt->get_result();
            $matieres = [];
            while ($row = $result->fetch_assoc()) {
                $matiere = array("id_matiere" => $row["ID_MAT"],"prix" => $row["prix"]);
                $matieres[] = $matiere;
            }
            return $matieres;
        } catch(Exception $e){
            return null;
        }
    }

    public function liste_par_matiere($id_matiere){
        try{
            $req = "SELECT ID_OFFRE,ID_MAT,prix FROM appartienir WHERE ID_MAT = ?";
            $stmt = $this->conn->prepare($req);
            $stmt->bind_param("i", $id_matiere);
            $stmt->execute();
            $result = $stmt->get_result();
            $matieres = [];
            while ($row = $result->fetch_assoc()) {
                $matiere = array("id_offre" => $row["ID_OFFRE"],"prix" => $row["prix"]);
                $matieres[] = $matiere;
            }
            return $matieres;
        } catch(Exception $e){
            return null;
        }
    }


    public function ajouter(Appartienir $appartienir) {
        try {
            $offre = $appartienir->getIdOffre();
            $matiere = $appartienir->getIdMatiere();
            $prix = $appartienir->getPrix();
    
            $stmt = $this->conn->prepare("INSERT IGNORE INTO appartienir (ID_OFFRE, ID_MAT,prix) VALUES (?, ?, ?)");
            $stmt->bind_param("iid", $offre, $matiere,$prix);
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
    
    public function supprimer($id_offre) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM appartienir WHERE ID_OFFRE = ?");
            $stmt->bind_param("i",$id_offre);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function recherche_par_id($id_offre) {
        try {
            $stmt = $this->conn->prepare("SELECT ID_OFFRE,ID_MAT,prix FROM appartienir WHERE ID_OFFRE = ?");
            $stmt->bind_param("i", $id_offre);
            $stmt->execute();
            $result = $stmt->get_result();
            $matieres = [];
            while ($row = $result->fetch_assoc()) {
                $matiere = array("id_matiere" => $row["ID_MAT"],"prix" => $row["prix"]);
                $matieres[] = $matiere;
            }
            return $matieres;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    
}

?>