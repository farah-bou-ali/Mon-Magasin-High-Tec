<?php
session_start(); 
require 'db.php'; 


if (isset($_POST['ajouter'])) {
    $id = $_POST['id'];
    $qte = (int)$_POST['quantite'];
    
    if (isset($_SESSION['panier'][$id])) {
        $_SESSION['panier'][$id] += $qte;
    } else {
        $_SESSION['panier'][$id] = $qte;
    }
}


if (isset($_GET['supprimer'])) {
    $id_a_supprimer = $_GET['supprimer'];
    if (isset($_SESSION['panier'][$id_a_supprimer])) {
        unset($_SESSION['panier'][$id_a_supprimer]);
    }
    header("Location: panier.php"); 
    exit();
}

$total_general = 0; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre Panier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 style="text-align: center;">🛒 Votre Panier</h1>

    <?php if (!empty($_SESSION['panier'])): ?>
        <table border="1" style="width: 80%; margin: 0 auto; border-collapse: collapse; text-align: center;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>Produit</th>
                    <th>Prix Unitaire</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['panier'] as $id => $qte): 
                    $stmt = $pdo->prepare("SELECT * FROM produits WHERE id = ?");
                    $stmt->execute([$id]);
                    $p = $stmt->fetch();
                    
                    if ($p):
                        $sous_total = $p['prix'] * $qte;
                        $total_general += $sous_total;
                ?>
                    <tr>
                        <td><?= htmlspecialchars($p['nom']) ?></td>
                        <td><?= number_format($p['prix'], 2) ?> DT</td>
                        <td><?= $qte ?></td>
                        <td><?= number_format($sous_total, 2) ?> DT</td>
                        <td>
                            <a href="panier.php?supprimer=<?= $id ?>" style="color: red; text-decoration: none;">❌ Supprimer</a>
                        </td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div style="text-align: right; max-width: 80%; margin: 20px auto;">
            <h3 style="color: #2c3e50;">Total Général : <span style="color: #e74c3c;"><?= number_format($total_general, 2) ?> DT</span></h3>
            
            <form action="confirmation.php" method="POST">
                <input type="hidden" name="total_a_payer" value="<?= $total_general ?>">
                <button type="submit" name="valider" style="background-color: #27ae60; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 1.1em;">
                    ✅ Valider la commande
                </button>
            </form>
        </div>

    <?php else: ?>
        <div style="text-align: center; margin-top: 50px;">
            <p>Votre panier est vide.</p>
            <a href="index.php" style="color: blue;">Go Shopping!</a>
        </div>
    <?php endif; ?>

    <p style="text-align: center; margin-top: 30px;">
        <a href="index.php" style="text-decoration: none; color: #34495e;">← Continuer mes achats</a>
    </p>
</body>
</html>