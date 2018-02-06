<?php 
    $mysqli=new mysqli('localhost','root','','address_book');
    if($mysqli->connect_error){
        die("ERROR!:{$mysqli->connect_errno} {$mysqli->connect_error}");
    }
    $mysqli->query("SET NAMES 'UTF8'");
?>