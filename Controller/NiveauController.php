<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Utils/connect.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Niveau.php";

class NiveauController {
    protected $conn;

    public function __construct() {
        $this->conn = connect();
    }

    public function liste() {
        try {
            $req = "SELECT ID_NIVEAUX, NIVEAUX FROM niveaux";
            $list = $this->conn->query($req);
            $niveaux = [];
            while ($row = $list->fetch_assoc()) {
                $niveau = new Niveau($row["ID_NIVEAUX"], $row["NIVEAUX"]);
                $niveaux[] = $niveau;
            }
            return $niveaux;
        } catch (Exception $e) {
            return null;
        }
    }

    public function ajouter(Niveau $niveau) {
        try {
            $nom = $niveau->getNom();
            $stmt = $this->conn->prepare("INSERT INTO niveaux (NIVEAUX) VALUES (?)");
            $stmt->bind_param("s",$nom);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function supprimer($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM niveaux WHERE ID_NIVEAUX = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function modifier(Niveau $niveau) {
        try {
            $id = $niveau->getId();
            $nom = $niveau->getNom();
            $stmt = $this->conn->prepare("UPDATE niveaux SET NIVEAUX = ? WHERE ID_NIVEAUX = ?");
            $stmt->bind_param("si", $nom, $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function recherche_par_id($id) {
        try {
            $stmt = $this->conn->prepare("SELECT ID_NIVEAUX, NIVEAUX FROM niveaux WHERE ID_NIVEAUX = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $niveau = new Niveau($row["ID_NIVEAUX"], $row["NIVEAUX"]);
                return $niveau;
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
            $stmt = $this->conn->prepare("SELECT ID_NIVEAUX, NIVEAUX FROM niveaux WHERE NIVEAUX LIKE ?");
            $stmt->bind_param("s", $nom);
            $stmt->execute();
            $result = $stmt->get_result();
            $niveaux = [];
            while ($row = $result->fetch_assoc()) {
                $niveau = new Niveau($row["ID_NIVEAUX"], $row["NIVEAUX"]);
                $niveaux[] = $niveau;
            }
            return $niveaux;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    
}
?>
