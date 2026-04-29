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
    <style>
        /* تنسيق بسيط لشريط الزبون العلوي */
        .client-nav {
            background: #333;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .client-nav a {
            color: #ffcc00;
            text-decoration: none;
            margin-left: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <nav class="client-nav">
        <div>
            <strong>🏠 High-Tech Store</strong>
        </div>
        <div>
            <?php if(isset($_SESSION['client_nom'])): ?>
                <span>Bienvenue, 👤 <?php echo htmlspecialchars($_SESSION['client_nom']); ?></span>
                <a href="logout_client.php" style="color: #ff4d4d;">Déconnexion</a>
            <?php else: ?>
                <a href="login_client.php">🔐 Connexion Client</a>
                <a href="inscription.php" style="background: #ffcc00; color: #333; padding: 5px 10px; border-radius: 5px;">S'inscrire</a>
            <?php endif; ?>
        </div>
    </nav>

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

    <div class="footer-nav" style="text-align: center; margin-top: 30px;">
        <a href="panier.php" class="btn-cart" style="padding: 15px 30px; font-size: 1.2em;">Voir mon panier 🛒</a>
    </div>

    <footer style="margin-top: 80px; text-align: center; padding: 40px; border-top: 2px solid #eee; background-color: #fafafa;">
    <a href="login.php" style="
        color: #444;                 
        text-decoration: none;       
        font-size: 1.5em;            
        font-weight: bold;           
        padding: 10px 20px;          
        border: 1px solid #ddd;      
        border-radius: 8px;           
        background-color: #fff;       
        box-shadow: 0 2px 5px rgba(0,0,0,0.05); 
        transition: all 0.3s ease;   
    ">
        🔐 Espace Administration
    </a>
</footer>

</body>
</html>