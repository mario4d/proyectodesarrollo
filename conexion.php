<?php

$host="localhost";
$user="d72024";
$pass="1234567";
$db="ds82024";


$est= mysqli_connect($host,$user,$pass,$db);



if($est->connect_errno){
    die(utf8_decode("Fallo la coneccion a MYSQL: ".$est->connect_errno."".mysqli_connect_error()));
    
}
$est->set_charset('utf8');



?>