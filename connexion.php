<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'luxride');
if ($conn->connect_error) {
    die('Erreur de connexion : ' . $conn->connect_error);
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'connexion') {
        // Connexion
        $email = $_POST['email'];
        $mot_de_passe = $_POST['mot_de_passe'];

        $requete = "SELECT * FROM utilisateurs WHERE email = ?";
        $stmt = $conn->prepare($requete);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $resultat = $stmt->get_result();
        $utilisateur = $resultat->fetch_assoc();

        if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
            $_SESSION['utilisateur_id'] = $utilisateur['id'];
            $_SESSION['nom_utilisateur'] = $utilisateur['nom'];
            header('Location: index.php');
            exit();
        } else {
            $message = "Email ou mot de passe incorrect.";
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'inscription') {
        // Inscription
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

        $requete = "INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($requete);
        $stmt->bind_param('sss', $nom, $email, $mot_de_passe);

        if ($stmt->execute()) {
            $message = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
        } else {
            $message = "Erreur lors de l'inscription. Veuillez réessayer.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion ou Inscription - LuxRide</title>
    <link rel="stylesheet" href="connexion.css"> <!-- Style global -->

</head>
<body>

    <main class="container">
        <h2>Bienvenue sur LuxRide</h2>
        <?php if (!empty($message)): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>

        <div class="tabs">
            <button class="tab-button active" onclick="showForm('connexion')">Se connecter</button>
            <button class="tab-button" onclick="showForm('inscription')">S'inscrire</button>
        </div>

        <div id="connexion" class="form-section active">
            <form method="post">
                <input type="hidden" name="action" value="connexion">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
                <label for="mot_de_passe">Mot de passe :</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required>
                <button type="submit">Se connecter</button>
            </form>
        </div>

        <div id="inscription" class="form-section">
            <form method="post">
                <input type="hidden" name="action" value="inscription">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
                <label for="mot_de_passe">Mot de passe :</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required>
                <button type="submit">S'inscrire</button>
            </form>
        </div>
    </main>


    <script>
        function showForm(formId) {
            document.querySelectorAll('.form-section').forEach(section => {
                section.classList.remove('active');
            });
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('active');
            });
            document.getElementById(formId).classList.add('active');
            event.target.classList.add('active');
        }
    </script>
</body>
</html>
