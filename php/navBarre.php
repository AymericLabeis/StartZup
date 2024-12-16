
<?php
session_start();

// Vérifier si l'utilisateur est connecté
require 'config.php';
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
// Affichage de l'email de l'utilisateur
$email = htmlspecialchars($_SESSION['email']);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/theme.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>
<body>
    <!-- Navbar -->
    <header> 
        <nav class="navbar navbar-expand-lg navColor">
            <div class="container-fluid">
                <img class="logo mx-2" src="./Ressources/logo_starZup.png" alt="">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="d-flex user-icons">
                    <i class="fa-solid fa-bell mx-1 d-block"></i>
                    <img src="./Ressources/user_img.jpg" alt="">
                    <li class="nav-item dropdown d-flex align-items-center">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user mx-1"></i>
                        </a>
                        <ul class="dropdown-menu custom-dropdown">
                            <?php if (isset($_SESSION['role'])): ?>
                                <li><a class="dropdown-item" href="./compte.html">Compte</a></li>
                                <li><a class="dropdown-item" href="logout.php">Déconnexion</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="./login.html">Connexion</a></li>
                                <li><a class="dropdown-item" href="./inscription.html">Inscription</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                </div>
                <div class="collapse navbar-collapse test" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex mx-auto my-auto mb-2 mb-lg-0">
                        <li class="nav-item mx-2 listMenu"><a class="nav-link" href="./index.html">Accueil</a></li>
                        <li class="nav-item mx-2 listMenu"><a class="nav-link" href="./candidats.html">Candidats</a></li>
                        <li class="nav-item mx-2 listMenu"><a class="nav-link" href="./favoris.html">Favoris</a></li>
                        <li class="nav-item mx-2 listMenu"><a class="nav-link" href="./rendez-vous.html">Rendez-vous</a></li>
                        <li class="nav-item mx-2 listMenu"><a class="nav-link" href="./contact.html">Contact</a></li>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'client'): ?>
                            <!-- Si l'utilisateur est un client, afficher le dashboard -->
                            <li class="nav-item mx-2 listMenu"><a class="nav-link" href="./dashboard.html">Dashboard</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav> 
    </header>
    <p>Vous êtes connecté en tant que : <strong><?php echo $email; ?></strong></p>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
            crossorigin="anonymous"></script>
</body>
</html>
