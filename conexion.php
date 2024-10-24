<?php

$host="localhost";
$user="userdb";
$pass="passworddb";
$db="proyecto_db";


$est= mysqli_connect($host,$user,$pass,$db);



if($est->connect_errno){
    die(utf8_decode("Fallo la coneccion a MYSQL: ".$est->connect_errno."".mysqli_connect_error()));
    
}
$est->set_charset('utf8');



?>