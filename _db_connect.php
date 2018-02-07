<?php 
    $mysqli=new mysqli('localhost','root','','proj51');
    if($mysqli->connect_error){
        die("ERROR!:{$mysqli->connect_errno} {$mysqli->connect_error}");
    }
    $mysqli->query("SET NAMES 'UTF8'");

    if(! isset($_SESSION)){
        session_start();
    }
?>