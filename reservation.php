<?php
session_start(); // Démarrage de la session

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: connexion.php'); // Redirection vers la page de connexion
    exit;
}

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'luxride');
if ($conn->connect_error) {
    die('Erreur de connexion : ' . $conn->connect_error);
}

// Récupération des détails du véhicule
$id_vehicule = $_GET['id_vehicule'] ?? null;
if ($id_vehicule) {
    $requete = "SELECT * FROM vehicules WHERE id = ?";
    $stmt = $conn->prepare($requete);
    $stmt->bind_param('i', $id_vehicule);
    $stmt->execute();
    $resultat = $stmt->get_result();
    $vehicule = $resultat->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération de l'identifiant utilisateur depuis la session
    $id_utilisateur = $_SESSION['utilisateur_id'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];

    // Insertion de la réservation
    $requete_insertion = "INSERT INTO reservations (id_vehicule, id_utilisateur, date_debut, date_fin) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($requete_insertion);
    $stmt->bind_param('iiss', $id_vehicule, $id_utilisateur, $date_debut, $date_fin);

    if ($stmt->execute()) {
        echo "<p>Réservation réussie pour le véhicule : " . htmlspecialchars($vehicule['nom']) . "</p>";
    } else {
        echo "<p>Erreur lors de la réservation. Veuillez réessayer.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation - LuxRide Locations</title>
    <link rel="stylesheet" href="connexion.css">
    <style>
        /* Vos styles existants */
        /* Styles spécifiques au formulaire */
    </style>
</head>
<body>
<header>
    <h1>LuxRide Locations</h1>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="vehicules.php">Véhicules</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="deconnection.php">Déconnexion</a></li>
        </ul>
    </nav>
</header>
<main>
    <div class="container">
        <h2>Réserver le Véhicule</h2>
        <?php if ($vehicule): ?>
            <div class="vehicle-info">
                <h3><?php echo htmlspecialchars($vehicule['nom']); ?></h3>
                <p>Prix : <?php echo htmlspecialchars($vehicule['prix_par_jour']); ?> €/jour</p>
            </div>
            <form method="post">
                <label for="date_debut">Date de Début :</label>
                <input type="date" id="date_debut" name="date_debut" required>

                <label for="date_fin">Date de Fin :</label>
                <input type="date" id="date_fin" name="date_fin" required>

                <button type="submit">Confirmer la Réservation</button>
            </form>
        <?php else: ?>
            <p>Véhicule non trouvé.</p>
        <?php endif; ?>
    </div>
</main>
<footer>
    <p>&copy; 2025 LuxRide Locations. Tous droits réservés.</p>
</footer>
</body>
</html>
