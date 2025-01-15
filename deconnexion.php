<?php
session_start(); // Démarrage de la session
session_unset(); // Supprime toutes les variables de session
session_destroy(); // Détruit la session
header('Location: index.php'); // Redirige vers la page d'accueil
exit;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion</title>
    <link rel="stylesheet" href="deconnexion.css">
    <style>* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Tw Cen MT', sans-serif;
}

body {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #333;
    color: #fff;
}

.container {
    text-align: center;
    padding: 20px;
    border: 2px solid #ffa400;
    border-radius: 10px;
    background-color: rgba(0, 0, 0, 0.8);
    width: 90%;
    max-width: 400px;
}

.content h1 {
    font-size: 32px;
    margin-bottom: 10px;
}

.content p {
    font-size: 18px;
    margin-bottom: 20px;
}

.buttons {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.buttons .btn {
    padding: 10px 20px;
    text-decoration: none;
    color: #fff;
    border: 1px solid #ffa400;
    border-radius: 5px;
    text-align: center;
    transition: background-color 0.3s, color 0.3s;
}

.buttons .btn:hover {
    background-color: #ffa400;
    color: #000;
}
</style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h1>Vous êtes déconnecté(e)</h1>
            <p>Merci d'avoir utilisé notre service. À bientôt !</p>
            <div class="buttons">
                <a href="index.php" class="btn">Retour à l'accueil</a>
                <a href="login.php" class="btn">Se reconnecter</a>
            </div>
        </div>
    </div>
</body>
</html>
