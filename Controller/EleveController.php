<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Utils/connect.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Eleve.php";

class EleveController {
    protected $conn;

    public function __construct() {
        $this->conn = connect();
    }

    public function liste() {
        try {
            $req = "SELECT ID_EL, ID_NIVEAUX, ID_SEC, ID_ANNEE, NOM__EL, NUM_TELE_EL, MAIL_EL, MDP_EL, REDUCTION_EL FROM eleve";
            $list = $this->conn->query($req);
            $eleves = [];
            while ($row = $list->fetch_assoc()) {
                $eleve = new Eleve(
                    $row["ID_EL"],
                    $row["ID_NIVEAUX"],
                    $row["ID_SEC"],
                    $row["ID_ANNEE"],
                    $row["NOM__EL"],
                    $row["NUM_TELE_EL"],
                    $row["MAIL_EL"],
                    $row["MDP_EL"],
                    $row["REDUCTION_EL"]
                );
                $eleves[] = $eleve;
            }
            return $eleves;
        } catch (Exception $e) {
            return null;
        }
    }

    public function ajouter(Eleve $eleve) {
        try {
            $idNiveaux = $eleve->getNiveau();
            $idSec = $eleve->getSection();
            $idAnnee = $eleve->getAnnee();
            $nomEl = $eleve->getNom();
            $numTeleEl = $eleve->getTelephone();
            $mailEl = $eleve->getMail();
            $mdpEl = $eleve->getMotDePasse();
            $reductionEl = $eleve->getReduction();

            $stmt = $this->conn->prepare("INSERT INTO eleve (ID_NIVEAUX, ID_SEC, ID_ANNEE, NOM__EL, NUM_TELE_EL, MAIL_EL, MDP_EL, REDUCTION_EL) 
                                          VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iiisssss", $idNiveaux, $idSec, $idAnnee, $nomEl, $numTeleEl, $mailEl, $mdpEl, $reductionEl);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function supprimer($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM eleve WHERE ID_EL = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function modifier(Eleve $eleve) {
        try {
            $id = $eleve->getId();
            $idNiveaux = $eleve->getNiveau();
            $idSec = $eleve->getSection();
            $idAnnee = $eleve->getAnnee();
            $nomEl = $eleve->getNom();
            $numTeleEl = $eleve->getTelephone();
            $mailEl = $eleve->getMail();
            $mdpEl = $eleve->getMotDePasse();
            $reductionEl = $eleve->getReduction();

            $stmt = $this->conn->prepare("UPDATE eleve SET ID_NIVEAUX = ?, ID_SEC = ?, ID_ANNEE = ?, NOM__EL = ?, 
                                          NUM_TELE_EL = ?, MAIL_EL = ?, MDP_EL = ?, REDUCTION_EL = ? WHERE ID_EL = ?");
            $stmt->bind_param("iiisssssi", $idNiveaux, $idSec, $idAnnee, $nomEl, $numTeleEl, $mailEl, $mdpEl, $reductionEl, $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function recherche_par_id($id) {
        try {
            $stmt = $this->conn->prepare("SELECT ID_EL, ID_NIVEAUX, ID_SEC, ID_ANNEE, NOM__EL, NUM_TELE_EL, MAIL_EL, MDP_EL, REDUCTION_EL 
                                          FROM eleve WHERE ID_EL = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $eleve = new Eleve(
                    $row["ID_EL"],
                    $row["ID_NIVEAUX"],
                    $row["ID_SEC"],
                    $row["ID_ANNEE"],
                    $row["NOM__EL"],
                    $row["NUM_TELE_EL"],
                    $row["MAIL_EL"],
                    $row["MDP_EL"],
                    $row["REDUCTION_EL"]
                );
                return $eleve;
            } else {
                return null;
            }
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function recherche_par_nom($nom) {
        try {
            $nom = '%' . $nom . '%';
            $stmt = $this->conn->prepare("SELECT ID_EL, ID_NIVEAUX, ID_SEC, ID_ANNEE, NOM__EL, NUM_TELE_EL, MAIL_EL, MDP_EL, REDUCTION_EL 
                                          FROM eleve WHERE NOM__EL LIKE ?");
            $stmt->bind_param("s", $nom);
            $stmt->execute();
            $result = $stmt->get_result();
            $eleves = [];
            while ($row = $result->fetch_assoc()) {
                $eleve = new Eleve(
                    $row["ID_EL"],
                    $row["ID_NIVEAUX"],
                    $row["ID_SEC"],
                    $row["ID_ANNEE"],
                    $row["NOM__EL"],
                    $row["NUM_TELE_EL"],
                    $row["MAIL_EL"],
                    $row["MDP_EL"],
                    $row["REDUCTION_EL"]
                );
                $eleves[] = $eleve;
            }
            return $eleves;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
}

?>
