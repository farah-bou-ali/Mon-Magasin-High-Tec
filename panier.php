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
    
    <link rel="stylesheet" href="style.css"> </head>
<body>
    <h1>Votre Panier</h1>

    <?php if (!empty($_SESSION['panier'])): ?>
        <table>
            <thead>
                <tr>
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
                        <td><?= number_format($p['prix'], 2) ?> €</td>
                        <td><?= $qte ?></td>
                        <td><?= number_format($sous_total, 2) ?> €</td>
                        <td>
                            <a href="panier.php?supprimer=<?= $id ?>" style="color: red;">Supprimer</a>
                        </td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div style="text-align: right; max-width: 800px; margin: 0 auto;">
            <h3>Total Général : <?= number_format($total_general, 2) ?> € </h3>
            
            <form action="confirmation.php" method="POST">
                <button type="submit" name="valider">Valider la commande </button>
            </form>
        </div>

    <?php else: ?>
        <p style="text-align: center;">Votre panier est vide.</p>
    <?php endif; ?>

    <p style="text-align: center;">
        <a href="index.php">Continuer mes achats</a>
    </p>
</body>
</html>