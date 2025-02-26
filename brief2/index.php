<?php
require 'config.php';

// Preparation de la requete

$query = "SELECT * FROM film";

//Execution de la requete

$stmt = $pdo -> prepare($query);
$stmt ->execute();
//Recuperation des données (tableau associatif)
$film = $stmt -> fetchAll(PDO::FETCH_ASSOC);

?>
<!--// $id = $_GET ['id'];-->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des films</title>
</head>
<body>
<?php if (!empty($film)): ?>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>Stock</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($film as $f): ?>
            <tr>
                <td><?= htmlspecialchars($f['id']) ?></td>
                <td><?= htmlspecialchars($f['nom']) ?></td>
                <td><?= htmlspecialchars($f['prix']) ?>€</td>
                <td><?= htmlspecialchars($f['stock']) ?>qt</td>
                <td><a href="edit.php?id=<?= $f['id']; ?>">Editer</a> </td>
                <td><a href="delete.php?id=<?= $f['id']; ?>">Supprimer</a> </td>
                <td><a href="add.php?id=<?= $f['id']; ?>">Ajouter</a> </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Aucun film disponible.</p>
<?php endif; ?>
</body>
</html>
