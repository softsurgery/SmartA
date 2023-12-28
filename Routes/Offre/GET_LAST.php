<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/OffreController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Model/Offre.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $controller = new OffreController();
    echo $controller->dernier_offre();
} else {
    echo "";
}
?>
