<?php

//Information de connexion a la BDD
$host = "localhost";
$dbname = "star_wars";
$user = "root";
$password = "";

try {
    //Création d'une instance PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    //Config du PDO en cas d'exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (PDOException $e) {
    //Si erreur de cnnexion
    die('Erreur de connexion: ' . $e->getMessage());
}



?>