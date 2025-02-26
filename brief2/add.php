<?php


require "config.php";
session_start();



//Vérification du formulaire

if($_SERVER ['REQUEST_METHOD'] === 'POST') {
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : "";
    $prix = isset($_POST['prix']) ? trim($_POST['prix']) : "";
    $stock = isset($_POST['stock']) ? trim($_POST['stock']) : "";



    if ($nom !== '' || $prix !== '' || $stock !== '') {
        //Stockage de la session

        $_SESSION['message'] = "Vous avez ajouté un film " . $nom;

        $stmt = $pdo->prepare('INSERT INTO film (id, nom, prix, stock) values(NULL,?,?,?);)');
        $stmt->execute([$nom, $prix, $stock]);

// Stockage des informations nom, prix, stock dans la session pour les récupérer plus tard
        $_SESSION['nom'] = $nom;
        $_SESSION['prix'] = $prix;
        $_SESSION['stock'] = $stock;
        //redirection vers la meme page

        header('Location: index.php');
        exit();
    } else {

        //Message d'erreur
        $_SESSION['message-nom'] = "Veuillez indiquer le nom! " . $nom;
        $_SESSION['message-email'] = "Erreur du prix " . $prix;
        $_SESSION['message'] = "Article non disponible " . $stock;
    }

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>formulaire : ajouter un film</title>
</head>
<body>
<?php

if (isset($_SESSION['message'])) {
    echo "<p>" . htmlspecialchars($_SESSION['message']) . "</p>";
    unset($_SESSION['message']);
}
?>

<form action="add.php" method="post">
    <label for="nom"> Nom</label>
    <input type="text" id="nom" name="nom" required> <br>
    <label for="prix"> Prix</label>
    <input type="text" id="prix" name="prix" required><br>
    <label for="stock"> Stock</label>
    <input type="text" id="stock" name="stock" required> <br>
    <button type="submit">Ajouter</button>

</form>
<a href="index.php">Retournez a l'accueil</a>
</body>
</html>
