<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/SmartA/Controller/SectionController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nouveauNom = $_POST["nouveauNom"];
    $controller = new SectionController();
    $section = new Section($id, $nouveauNom);
    echo $controller->modifier($section) ? "200" : "500";
} else {
    echo "400";
}
?>