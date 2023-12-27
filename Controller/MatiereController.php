<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Utils/connect.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Matiere.php";

class MatiereController {
    protected $conn;

    public function __construct() {
        $this->conn = connect();
    }

    public function liste() {
        try {
            $req = "SELECT ID_MAT, NOM_MAT FROM matiere";
            $list = $this->conn->query($req);
            $Matieres = [];
            while ($row = $list->fetch_assoc()) {
                $matiere = new Matiere($row["ID_MAT"], $row["NOM_MAT"]);
                $Matieres[] = $matiere;
            }
            return $Matieres;
        } catch (Exception $e) {
            return null;
        }
    }

    public function ajouter(Matiere $matiere) {
        try {
            $nom = $matiere->getNom();
            $stmt = $this->conn->prepare("INSERT INTO matiere (NOM_MAT) VALUES (?)");
            $stmt->bind_param("s", $nom);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function supprimer($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM matiere WHERE ID_MAT = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function modifier(Matiere $matiere) {
        try {
            $stmt = $this->conn->prepare("UPDATE Matiere SET NOM_MAT = ? WHERE ID_Mat = ?");
            $stmt->bind_param("si", $matiere->getNom(), $matiere->getId());
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function recherche_par_id($id) {
        try {
            $stmt = $this->conn->prepare("SELECT ID_Mat, NOM_MAT FROM Matiere WHERE ID_Mat = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $Matiere = new Matiere($row["ID_Mat"], $row["NOM_MAT"]);
                return $Matiere;
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
            $stmt = $this->conn->prepare("SELECT ID_MAT, NOM_MAT FROM matiere WHERE NOM_MAT LIKE ?");
            $stmt->bind_param("s", $nom);
            $stmt->execute();
            $result = $stmt->get_result();
            $matieres = [];
            while ($row = $result->fetch_assoc()) {
                $matiere = new Matiere($row["ID_MAT"], $row["NOM_MAT"]);
                $matieres[] = $matiere;
            }
            return $matieres;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    }
    
?>