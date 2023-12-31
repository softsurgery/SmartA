<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Utils/connect.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Section.php";

class SectionController {
    protected $conn;

    public function __construct() {
        $this->conn = connect();
    }

    public function liste() {
        try {
            $req = "SELECT ID_SEC,NOM_SEC FROM section";
            $list = $this->conn->query($req);
            $sections = [];
            while ($row = $list->fetch_assoc()) {
                $section = new Section($row["ID_SEC"], $row["NOM_SEC"]);
                $sections[] = $section;
            }
            return $sections;
        } catch (Exception $e) {
            return null;
        }
    }

    public function ajouter(Section $section) {
        try {
            $nom = $section->getNom();
            $stmt = $this->conn->prepare("INSERT INTO section (NOM_SEC) VALUES (?)");
            $stmt->bind_param("s", $nom);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function supprimer($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM section WHERE ID_SEC = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function modifier(Section $section) {
        try {
            $id = $section->getId();
            $nom = $section->getNom();
            $stmt = $this->conn->prepare("UPDATE section SET NOM_SEC = ? WHERE ID_SEC = ?");
            $stmt->bind_param("si", $nom, $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function recherche_par_id($id) {
        try {
            $stmt = $this->conn->prepare("SELECT ID_SEC, NOM_SEC FROM section WHERE ID_SEC = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $section = new Section($row["ID_SEC"], $row["NOM_SEC"]);
                return $section;
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
            $stmt = $this->conn->prepare("SELECT ID_SEC, NOM_SEC FROM section WHERE NOM_SEC LIKE ?");
            $stmt->bind_param("s", $nom);
            $stmt->execute();
            $result = $stmt->get_result();
            $sections = [];
            while ($row = $result->fetch_assoc()) {
                $section = new Section($row["ID_SEC"], $row["NOM_SEC"]);
                $sections[] = $section;
            }
    
            return $sections;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    
    }
    
?>