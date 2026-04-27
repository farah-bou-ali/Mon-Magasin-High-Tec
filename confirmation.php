<?php
session_start();
require 'db.php';

if (isset($_POST['valider']) && !empty($_SESSION['panier'])) {
   
    $stmt = $pdo->prepare("INSERT INTO commandes (date_commande) VALUES (NOW())");
    $stmt->execute();
    $id_commande = $pdo->lastInsertId();
 
    foreach ($_SESSION['panier'] as $id_p => $qte) {
        $ins = $pdo->prepare("INSERT INTO ligne_commande (id_commande, id_produit, quantite) VALUES (?, ?, ?)");
        $ins->execute([$id_commande, $id_p, $qte]);
    }

   
    unset($_SESSION['panier']);
    $message = "Merci ! Votre commande n°<strong>$id_commande</strong> a été enregistrée avec succès.";
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation de Commande</title>
    <link rel="stylesheet" href="style.css">
    <style>
        
        .confirmation-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }

        .success-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 500px;
            width: 90%;
            border-top: 8px solid #27ae60; 
        }

        .success-icon {
            font-size: 80px;
            color: #27ae60;
            margin-bottom: 20px;
        }

        .success-card h1 {
            color: #2c3e50;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .message-box {
            background-color: #f1f8f4;
            color: #27ae60;
            padding: 15px;
            border-radius: 10px;
            margin: 20px 0;
            font-size: 1.1em;
        }

        .btn-home {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            transition: background 0.3s, transform 0.2s;
            margin-top: 20px;
        }

        .btn-home:hover {
            background-color: #2980b9;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    
    <div class="confirmation-container">
        <div class="success-card">
            <div class="success-icon">✅</div>
            <h1>Confirmation</h1>
            
            <div class="message-box">
                <?= $message ?>
            </div>
            
            <p style="color: #7f8c8d;">Un email récapitulatif vous a été envoyé. Nous préparons votre colis avec soin !</p>
            
            <a href="index.php" class="btn-home">🏠 Retour à l'accueil</a>
        </div>
    </div>

</body>
</html>