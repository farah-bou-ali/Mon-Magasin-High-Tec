<?php
session_start();
require 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    try {
        
        $stmt = $pdo->prepare("SELECT * FROM clients WHERE email = :email AND mot_de_passe = :pass");
        $stmt->execute(['email' => $email, 'pass' => $pass]);
        $client = $stmt->fetch();

        if ($client) {
           
            $_SESSION['client_id'] = $client['id'];
            $_SESSION['client_nom'] = $client['nom_complet'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Email ou mot de passe incorrect !";
        }
    } catch (PDOException $e) {
        $error = "Erreur de base de données : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Client Login</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding-top: 50px; }
        form { display: inline-block; padding: 20px; border: 1px solid #ccc; border-radius: 10px; }
        input { display: block; margin: 10px auto; padding: 8px; width: 200px; }
        button { background: #28a745; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px; }
    </style>
</head>
<body>
    <h2>Client Login</h2>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="pass" placeholder="Mot de passe" required>
        <button type="submit">Login</button>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    </form>
    <br>
    <a href="inscription.php">S'inscrire (Créer un compte)</a>
</body>
</html>