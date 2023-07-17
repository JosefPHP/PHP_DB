<?php
$server ='localhost';
$user='root';
$pwd='root';
$db='film';

try{
    $con = new PDO('mysql:host='.$server.';dbname='.$db.';charset=utf8',$user,$pwd);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
    echo'Error - Verbindung: '.$e ->getCode().': '.$e->getMessage().'<br>';
}