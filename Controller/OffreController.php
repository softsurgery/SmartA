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
            $req = "SELECT ID_OFFRE, ID_DUREE, NOM_OFFRE, PRIX_OFFRE FROM OFFRE";
            $list = $this->conn->query($req);
            $offres = [];
            while ($row = $list->fetch_assoc()) {
                $offre = new Offre($row["ID_OFFRE"], $row["ID_DUREE"], $row["NOM_OFFRE"], $row["PRIX_OFFRE"]);
                $offres[] = $offre;
            }
            return $offres;
        } catch (Exception $e) {
            return null;
        }
    }

    public function ajouter(Offre $offre) {
        try {
            $idDuree = $offre->getIdDuree();
            $nom = $offre->getNom();
            $prix = $offre->getPrix();
            $stmt = $this->conn->prepare("INSERT INTO OFFRE (ID_DUREE, NOM_OFFRE, PRIX_OFFRE) VALUES (?, ?, ?)");
            $stmt->bind_param("isd", $idDuree, $nom, $prix);
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
            $prix = $offre->getPrix();
            $stmt = $this->conn->prepare("UPDATE OFFRE SET ID_DUREE = ?, NOM_OFFRE = ?, PRIX_OFFRE = ? WHERE ID_OFFRE = ?");
            $stmt->bind_param("isdi", $idDuree, $nom, $prix,$id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function recherche_par_id($id) {
        try {
            $stmt = $this->conn->prepare("SELECT ID_OFFRE, ID_DUREE, NOM_OFFRE, PRIX_OFFRE FROM OFFRE WHERE ID_OFFRE = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $offre = new Offre($row["ID_OFFRE"], $row["ID_DUREE"], $row["NOM_OFFRE"], $row["PRIX_OFFRE"]);
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
            $stmt = $this->conn->prepare("SELECT ID_OFFRE, ID_DUREE, NOM_OFFRE, PRIX_OFFRE FROM OFFRE WHERE NOM_OFFRE LIKE ?");
            $stmt->bind_param("s", $nom);
            $stmt->execute();
            $result = $stmt->get_result();
            $offres = [];
            while ($row = $result->fetch_assoc()) {
                $offre = new Offre($row["ID_OFFRE"], $row["ID_DUREE"], $row["NOM_OFFRE"], $row["PRIX_OFFRE"]);
                $offres[] = $offre;
            }
            return $offres;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    
}
?>