<?php

//Information de connexion a la BDD
$host = "localhost";
$dbname = "bibliothèque";
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

// Preparation de la requete

$query = "SELECT * FROM auteur";

//Execution de la requete

$stmt = $pdo -> query($query);
//Recuperation des données (tableau associatif)
$auteurs = $stmt -> fetchAll(PDO::FETCH_ASSOC);

/*print_r($auteurs);*/

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./crud.css">

    <title>Liste des livres</title>
</head>
<body>
<?php if (! empty ($auteurs)): ?>
<table>
        <thead

            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
            </tr>
        </thead>
    <tbody>
    <?php foreach ($auteurs as $a):   ?>
    <tr>
        <td><?= htmlspecialchars($a['id']) ?></td>
        <td><?= htmlspecialchars($a['nom']) ?></td>
        <td><?= htmlspecialchars($a['prenom']) ?></td>
        <td><?= htmlspecialchars($a['date_naissance']) ?></td>

    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p>Aucun auteur</p>
<?php endif; ?>
</body>
</html>
