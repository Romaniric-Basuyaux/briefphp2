<?php
require 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (is_numeric($id)) {
        $query = "DELETE FROM film WHERE id = ?";
        $stmt = $pdo->prepare($query);

        if ($stmt->execute([$id])) {
            header("Location: index.php");
            exit;
        } else {
            echo "Erreur lors de la suppression du film.";
        }
    } else {
        echo "ID invalide.";
    }
} else {
    echo "Aucun ID fourni.";
}
?>


