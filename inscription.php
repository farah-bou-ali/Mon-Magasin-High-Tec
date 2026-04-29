<?php
require 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    try {
     
        $check = $pdo->prepare("SELECT * FROM clients WHERE email = :email");
        $check->execute(['email' => $email]);

        if ($check->rowCount() > 0) {
            $error = "Cet e-mail est déjà utilisé !";
        } else {
          
            $sql = "INSERT INTO clients (nom_complet, email, mot_de_passe) VALUES (:nom, :email, :pass)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'nom'   => $nom,
                'email' => $email,
                'pass'  => $pass
            ]);

            $success = "Compte créé avec succès ! <a href='login_client.php'>Connectez-vous هنا</a>";
        }
    } catch (PDOException $e) {
        $error = "Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription Client</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding-top: 50px; background-color: #f4f7f6; }
        form { display: inline-block; padding: 30px; background: white; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        input { display: block; margin: 15px auto; padding: 10px; width: 250px; border: 1px solid #ddd; border-radius: 5px; }
        button { background: #007bff; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px; width: 100%; }
        .msg { margin: 10px; padding: 10px; border-radius: 5px; }
    </style>
</head>
<body>
    <h2>Créer un compte Client</h2>
    <form method="POST">
        <input type="text" name="nom" placeholder="Nom Complet" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="pass" placeholder="Mot de passe" required>
        <button type="submit">S'inscrire</button>

        <?php if(isset($error)): ?>
            <div class="msg" style="background: #f8d7da; color: #721c24;"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if(isset($success)): ?>
            <div class="msg" style="background: #d4edda; color: #155724;"><?php echo $success; ?></div>
        <?php endif; ?>
    </form>
    <br>
    <a href="index.php">Retour au magasin</a>
</body>
</html>