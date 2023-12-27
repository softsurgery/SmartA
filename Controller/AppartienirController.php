<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Utils/connect.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Appartienir.php";

class AppartienirController{
    protected $conn;

    public function __construct(){
        $this->conn = connect();
    }
    
    public function liste(){
        try{
            $req = "SELECT ID_OFFRE,ID_MAT FROM appartienir";
            $list = $this->conn->query($req);
            $appartienirs = [];
            while($row = $list->fetch_assoc()){
                $appartienir = new Appartienir($row["ID_OFFRE"],$row["ID_MAT"]);
                $appartienirs[] = $appartienir;
            }
            return $appartienirs;
        } catch(Exception $e){
            return null;
        }
    }

    public function ajouter(Appartienir $appartienir) {
        try {
            $offre = $appartienir->getIdOffre();
            $matiere = $appartienir->getIdMatiere();
            $stmt = $this->conn->prepare("INSERT INTO appartienir (ID_OFFRE,ID_MAT) VALUES (?,?)");
            $stmt->bind_param("ii",$offre,$matiere);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function supprimer($id_offre,$id_matiere) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM appartienir WHERE ID_OFFRE = ? AND ID_MATIERE = ?");
            $stmt->bind_param("ii",$id_offre,$id_matiere);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function recherche_par_id($id_offre) {
        try {
            $stmt = $this->conn->prepare("SELECT ID_OFFRE,ID_MAT FROM appartienir WHERE ID_OFFRE = ?");
            $stmt->bind_param("i", $id_offre);
            $stmt->execute();
            $result = $stmt->get_result();
            $matieres = [];
            while ($row = $result->fetch_assoc()) {
                $matiere = new Matiere($row["ID_OFFRE"],$row["ID_MAT"]);
                $matieres[] = $matiere;
            }
            return $matieres;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    
}

?>