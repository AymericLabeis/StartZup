<?php
session_start();
// Inclure le fichier de configuration
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['motDePasse'];

    try {
        // Vérifier si l'utilisateur existe dans la base de données
        $query = $pdo->prepare('SELECT * FROM client WHERE email = ?');
        $query->execute([$email]);
        $client = $query->fetch(PDO::FETCH_ASSOC);
        
        if ($client) {
            // Vérifier le mot de passe
            if ($password === $client['motDePasse']) {
                $_SESSION['role'] = $client['role'];
                $_SESSION['email'] = $client['email']; 
                
                // Connexion réussie, rediriger vers la page d'accueil
                header("Location: ../index.php");
                exit();
            } else {
                // Mot de passe incorrect
                echo "<p style='color: red;'>Mot de passe incorrect.</p>";
            }
        } else {
            // Email inexistant
            echo "<p style='color: red;'>Cet email n'existe pas.</p>";
        }
    } catch (PDOException $e) {
        // Gestion des erreurs SQL
        echo "<p style='color: red;'>Erreur SQL : " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}
?>
