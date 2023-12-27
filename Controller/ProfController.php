<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Utils/connect.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Prof.php";

class ProfController {
    protected $conn;

    public function __construct() {
        $this->conn = connect();
    }

    public function liste() {
        try {
            $req = "SELECT ID_PRO, ID_MAT, NOM_PRO, NUM_TELE_PRO, MAIL_PRO, PART_PRO FROM PROF";
            $list = $this->conn->query($req);
            $professors = [];
            while ($row = $list->fetch_assoc()) {
                $prof = new Prof($row["ID_PRO"], $row["ID_MAT"], $row["NOM_PRO"], $row["NUM_TELE_PRO"], $row["MAIL_PRO"], $row["PART_PRO"]);
                $professors[] = $prof;
            }
            return $professors;
        } catch (Exception $e) {
            return null;
        }
    }

    public function ajouter(Prof $prof) {
        try {
            $matiere = $prof->getMatiere();
            $nom = $prof->getNom();
            $telephone = $prof->getTelephone();
            $email = $prof->getEmail();
            $part = $prof->getPart();
            $stmt = $this->conn->prepare("INSERT INTO PROF (ID_MAT, NOM_PRO, NUM_TELE_PRO, MAIL_PRO, PART_PRO) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $matiere, $nom, $telephone, $email, $part);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function supprimer($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM PROF WHERE ID_PRO = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function modifier(Prof $prof) {
        try {
            $id = $prof->getId();
            $matiere = $prof->getMatiere();
            $nom = $prof->getNom();
            $telephone = $prof->getTelephone();
            $email = $prof->getEmail();
            $part = $prof->getPart();
            $stmt = $this->conn->prepare("UPDATE PROF SET ID_MAT = ?, NOM_PRO = ?, NUM_TELE_PRO = ?, MAIL_PRO = ?, PART_PRO = ? WHERE ID_PRO = ?");
            $stmt->bind_param("issssi", $matiere, $nom, $telephone, $email, $part, $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function recherche_par_id($id) {
        try {
            $stmt = $this->conn->prepare("SELECT ID_PRO, ID_MAT, NOM_PRO, NUM_TELE_PRO, MAIL_PRO, PART_PRO FROM PROF WHERE ID_PRO = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $prof = new Prof($row["ID_PRO"], $row["ID_MAT"], $row["NOM_PRO"], $row["NUM_TELE_PRO"], $row["MAIL_PRO"], $row["PART_PRO"]);
                return $prof;
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
            $stmt = $this->conn->prepare("SELECT ID_PRO, ID_MAT, NOM_PRO, NUM_TELE_PRO, MAIL_PRO, PART_PRO FROM PROF WHERE NOM_PRO LIKE ?");
            $stmt->bind_param("s", $nom);
            $stmt->execute();
            $result = $stmt->get_result();
            $professors = [];
            while ($row = $result->fetch_assoc()) {
                $prof = new Prof($row["ID_PRO"], $row["ID_MAT"], $row["NOM_PRO"], $row["NUM_TELE_PRO"], $row["MAIL_PRO"], $row["PART_PRO"]);
                $professors[] = $prof;
            }
            return $professors;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
}
?>
