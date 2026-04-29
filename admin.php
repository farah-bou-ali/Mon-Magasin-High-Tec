<?php
session_start();
require 'db.php';


if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

try {
   
    $stmt = $pdo->query("SELECT * FROM commandes ORDER BY id DESC");
    $commandes = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-container { max-width: 900px; margin: 30px auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: center; }
        th { background: #333; color: white; }
        .logout { float: right; color: red; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body style="background: #f4f7f6;">

    <div class="admin-container">
        <a href="logout.php" class="logout">Se déconnecter [X]</a>
        <h2>🛒 Liste des Commandes</h2>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Total (DT)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $c): ?>
                <tr>
                    <td>#<?= $c['id'] ?></td>
                    <td><?= $c['date_commande'] ?></td>
                    <td><strong><?= number_format($c['total_general'], 2) ?> DT</strong></td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($commandes)) echo "<tr><td colspan='3'>Aucune commande reçue.</td></tr>"; ?>
            </tbody>
        </table>
        <br>
        <a href="index.php">← Retour au magasin</a>
    </div>

</body>
</html>