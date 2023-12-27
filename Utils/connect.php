<?php

function connect(){
    try{
        $conn = new mysqli("localhost","root","","sa");
        //echo "<script>console.log('Base Connectée')</script>";
        return $conn;
    } catch(Exception $e) {
        echo "<script>console.log('Echec de base')</script>";
    }
}

?>