<?php
session_start();
require 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);

    try {
       
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = :user AND password = :pass");
        $stmt->execute(['user' => $user, 'pass' => $pass]);
        $admin = $stmt->fetch();

        if ($admin) {
          
            $_SESSION['admin'] = $admin['username'];
            header("Location: admin.php"); 
            exit();
        } else {
         
            $error = "Nom d'utilisateur ou mot de passe incorrect !";
        }
    } catch (PDOException $e) {
        $error = "Erreur Connection : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Admin</title>
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); text-align: center; width: 350px; }
        h2 { color: #333; margin-bottom: 20px; }
        input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; }
        .btn { background: #333; color: white; border: none; padding: 12px; width: 100%; cursor: pointer; border-radius: 6px; font-size: 16px; transition: 0.3s; }
        .btn:hover { background: #555; }
        .error-msg { color: #e74c3c; margin-top: 15px; font-size: 14px; font-weight: bold; }
        .back-link { display: block; margin-top: 20px; text-decoration: none; color: #888; font-size: 0.9em; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>🔐 Admin Login</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Identifiant" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit" class="btn">Se connecter</button>
        </form>
        
        <?php if(isset($error)): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <a href="index.php" class="back-link">← Retour au magasin</a>
    </div>
</body>
</html>