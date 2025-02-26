<?php
require 'config.php';

// Vérifier si un ID est fourni pour la modification
$id = isset($_GET['id']) ? $_GET['id'] : null;
$nom = $prix = $stock = '';

// Si un ID est fourni, récupérer les données du film
if ($id) {
    $query = "SELECT * FROM film WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    $film = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($film) {
        $nom = $film['nom'];
        $prix = $film['prix'];
        $stock = $film['stock'];
    } else {
        die("Film non trouvé.");
    }
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];

    if ($id) {
        // Modification
        $query = "UPDATE film SET nom = ?, prix = ?, stock = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$nom, $prix, $stock, $id]);
    } else {
        // Ajout
        $query = "INSERT INTO film (nom, prix, stock) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$nom, $prix, $stock]);
    }

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $id ? "Modifier" : "Ajouter" ?> un Film</title>
</head>
<body>

<h1><?= $id ? "Modifier" : "Ajouter" ?> un Film</h1>

<form action="" method="POST">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($nom) ?>" required><br>

    <label for="prix">Prix :</label>
    <input type="number" name="prix" id="prix" step="0.01" value="<?= htmlspecialchars($prix) ?>" required><br>

    <label for="stock">Stock :</label>
    <input type="number" name="stock" id="stock" value="<?= htmlspecialchars($stock) ?>" required><br>

    <button type="submit"><?= $id ? "Modifier" : "Ajouter" ?></button>
</form>

<a href="index.php">Retour à la liste des films</a>

</body>
</html>
