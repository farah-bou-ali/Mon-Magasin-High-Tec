<?php
session_start(); 
require 'db.php'; 

$query = $pdo->query("SELECT * FROM produits ORDER BY id ASC");
$produits = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>High-Tech Store</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <header>
        <h1>💻 NOS PRODUITS HIGH-TECH</h1>
    </header>
    
    <div class="produits-container">
        <?php foreach ($produits as $p): ?>
            <div class="produit">
                <?php 
                    $name = strtolower($p['nom']);
                    if (strpos($name, 'pc') !== false) { $img = "pc.jpg.jpg"; }
                    elseif (strpos($name, 'souris') !== false) { $img = "souris.jpg.jpg"; }
                    elseif (strpos($name, 'clavier') !== false) { $img = "clavier.jpg.jpg"; }
                    else { $img = "default.jpg"; }
                ?>
                
                <div class="img-wrapper">
                    <img src="<?php echo $img; ?>?v=<?php echo time(); ?>" alt="<?= htmlspecialchars($p['nom']) ?>" class="produit-img">
                </div>

                <h3><?= htmlspecialchars($p['nom']) ?></h3>
                
                <p class="prix">Prix: <?= number_format($p['prix'], 2) ?> DT</p>
                
                <form action="panier.php" method="POST">
                    <input type="hidden" name="id" value="<?= $p['id'] ?>">
                    <div class="qte-selector">
                        <label>Quantité: </label>
                        <input type="number" name="quantite" value="1" min="1">
                    </div>
                    <button type="submit" name="ajouter" class="btn-add">Ajouter au panier 🛒</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="footer-nav">
        <a href="panier.php" class="btn-cart">Voir mon panier 🛒</a>
    </div>
</body>
</html>