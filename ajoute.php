<?php
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
    }
    
    $_SESSION['panier'][] = $id;
}

header("Location: index.php");
exit();
?>