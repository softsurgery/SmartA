<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Utils/connect.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Offre.php";

class OffreController {
    protected $conn;
    public function __construct() {
        $this->conn = connect();
    }

    public function liste() {
        try {
            $req = "SELECT ID_OFFRE, ID_DUREE, NOM_OFFRE FROM OFFRE";
            $list = $this->conn->query($req);
            $offres = [];
            while ($row = $list->fetch_assoc()) {
                $offre = new Offre($row["ID_OFFRE"], $row["ID_DUREE"], $row["NOM_OFFRE"]);
                $offres[] = $offre;
            }
            return $offres;
        } catch (Exception $e) {
            return null;
        }
    }

    public function ajouter(Offre $offre) {
        try {
            $id = $offre->getId();
            $idDuree = $offre->getIdDuree();
            $nom = $offre->getNom();
    
            if ($id !== null) {
                $stmt = $this->conn->prepare("UPDATE OFFRE SET ID_DUREE = ?, NOM_OFFRE = ? WHERE ID_OFFRE = ?");
                $stmt->bind_param("isi", $idDuree, $nom, $id);
            } else {
                $stmt = $this->conn->prepare("INSERT INTO OFFRE (ID_DUREE, NOM_OFFRE) VALUES (?, ?)");
                $stmt->bind_param("is", $idDuree, $nom);
            }
    
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    

    public function supprimer($idOffre) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM OFFRE WHERE ID_OFFRE = ?");
            $stmt->bind_param("s", $idOffre);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function modifier(Offre $offre) {
        try {
            $id = $offre->getId();
            $idDuree = $offre->getIdDuree();
            $nom = $offre->getNom();
            $stmt = $this->conn->prepare("UPDATE OFFRE SET ID_DUREE = ?, NOM_OFFRE = ? WHERE ID_OFFRE = ?");
            $stmt->bind_param("isi", $idDuree, $nom,$id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function recherche_par_id($id) {
        try {
            $stmt = $this->conn->prepare("SELECT ID_OFFRE, ID_DUREE, NOM_OFFRE FROM OFFRE WHERE ID_OFFRE = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $offre = new Offre($row["ID_OFFRE"], $row["ID_DUREE"], $row["NOM_OFFRE"]);
                return $offre;
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
            $stmt = $this->conn->prepare("SELECT ID_OFFRE, ID_DUREE, NOM_OFFRE FROM OFFRE WHERE NOM_OFFRE LIKE ?");
            $stmt->bind_param("s", $nom);
            $stmt->execute();
            $result = $stmt->get_result();
            $offres = [];
            while ($row = $result->fetch_assoc()) {
                $offre = new Offre($row["ID_OFFRE"], $row["ID_DUREE"], $row["NOM_OFFRE"]);
                $offres[] = $offre;
            }
            return $offres;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function dernier_offre(){
        try {
            $result = $this->conn->query("SELECT MAX(ID_OFFRE) AS did FROM OFFRE;");
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row["did"];
            } else {
                return null;
            }
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    
}
?>