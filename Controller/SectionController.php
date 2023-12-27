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
            $req = "SELECT ID_SECTION, NOM FROM sections";
            $list = $this->conn->query($req);
            $sections = [];
            while ($row = $list->fetch_assoc()) {
                $section = new Section($row["ID_SECTION"], $row["NOM"]);
                $sections[] = $section;
            }
            return $sections;
        } catch (Exception $e) {
            return null;
        }
    }

    public function ajouter(Section $section) {
        try {
            $id = $section->getId();
            $nom = $section->getNom();
            $stmt = $this->conn->prepare("INSERT INTO sections (ID_SECTION, NOM) VALUES (?, ?)");
            $stmt->bind_param("is", $id, $nom);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function supprimer($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM sections WHERE ID_SECTION = ?");
            $stmt->bind_param("i", $id);
            return $stmt->execute() ? true : false;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function modifier(Section $section) {
        try {
            $stmt = $this->conn->prepare("UPDATE sections SET NOM = ? WHERE ID_SECTION = ?");
            $stmt->bind_param("si", $section->getNom(), $section->getId());
            return $stmt->execute() ? true : false;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function recherche_par_id($id) {
        try {
            $stmt = $this->conn->prepare("SELECT ID_SECTION, NOM FROM sections WHERE ID_SECTION = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $section = new Section($row["ID_SECTION"], $row["NOM"]);
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
            $stmt = $this->conn->prepare("SELECT ID_SECTION, NOM FROM sections WHERE NOM = ?");
            $stmt->bind_param("s", $nom);
            $stmt->execute();
            $result = $stmt->get_result();
    
            $sections = [];
            while ($row = $result->fetch_assoc()) {
                $section = new Section($row["ID_SECTION"], $row["NOM"]);
                $sections[] = $section;
            }
    
            return $sections;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    
    }
    
?>