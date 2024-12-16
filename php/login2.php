<?php
// Inclure le fichier de configuration
include 'config.php';

// Initialisation des messages d'erreur
$error_email = "";
$error_password = "";

// Traitement du formulaire
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
                // Connexion réussie
                $_SESSION['role'] = $client['role'];
                
                header("Location: ../index.php");
                exit();
            } else {
                // Mot de passe incorrect
                $error_password = "Mot de passe incorrect.";
            }
        } else {
            // Email inexistant
            $error_email = "Cet email n'existe pas.";
        }
    } catch (PDOException $e) {
        // Gestion des erreurs SQL
        $error_email = "Erreur SQL : " . htmlspecialchars($e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Votre style CSS */
        *, ::before, ::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            height: 100vh; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            font-family: "Poppins", sans-serif;   
            background: url('./Ressources/bg_login.png') repeat-y;
            background-size: cover;
        }
        .formLogin {
            background-color: rgba(0, 59, 94, 0.9);
            color: rgb(255, 255, 255);
            border-radius: 1rem;
            border: 3px solid rgba(255, 255, 255, 0.781);
        }
        .titleConnexion {
            background-color: rgba(255, 255, 255, 0.4);
            border-radius: 0.5rem;
        }
        .letter-spacing {
            letter-spacing: 1px; 
        }
        @media (max-width: 767px) {
            body {
                background: url('./Ressources/bg_login.png') no-repeat;
                background-size: cover; 
                background-position: center center; 
            }
        }
        @media screen and (min-width:768px) and (max-width:1279px) {
            body {
                height: 100vh;
            }
            .formLogin {
                width: 80%;
            }
        }
        .error-message {
            color: red;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6 col-lg-6 col-11 justify-content-center align-items-center py-2 px-4 formLogin">
                <form method="post">
                    <div class="d-flex align-items-center justify-content-center pt-2 my-2 titleConnexion">
                        <h2>Connexion</h2>
                    </div>
                    <div class="mb-2">
                        <label for="inputEmail" class="form-label fs-5">Adresse E-mail</label>
                        <input id="inputEmail" name="email" minlength="5" maxlength="50" type="email" 
                            placeholder="Entrez votre e-mail" class="form-control letter-spacing borderColor" required>
                        <span id="errorEmail" class="error-message"><?php echo $error_email; ?></span>
                    </div>
                    <div class="mb-2">
                        <label for="inputPassword" class="form-label fs-5">Mot de passe</label>
                        <input id="inputPassword" name="motDePasse" minlength="6" maxlength="30" type="password" 
                            placeholder="Entrez votre mot de passe" class="form-control letter-spacing borderColor" required>
                        <span id="errorPassword" class="error-message"><?php echo $error_password; ?></span>
                    </div>
                    <div class="text-center mt-2">
                        <a href="#" class="form-label mt-1 d-inline-block fs-5">Mot de passe oublié ?</a>
                    </div>
                    <input type="submit" class="btn btn-primary d-flex justify-content-center mx-auto mt-2 w-100 letter-spacing fs-5 borderColor" value="Valider">
                </form>
                <div class="text-center mt-3">
                    <p>Pas encore de compte ? <a href="inscription.html">Inscrivez-vous</a> dès maintenant</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
