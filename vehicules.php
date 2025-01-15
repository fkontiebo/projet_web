<?php
session_start(); // Gestion des sessions

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'luxride');
if ($conn->connect_error) {
    die('Erreur de connexion : ' . $conn->connect_error);
}

// Récupération des véhicules
$requete = "SELECT * FROM vehicules";
$resultat = $conn->query($requete);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxRide Locations</title>
    <link rel="stylesheet" href="monstyle.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        }

        .liste-vehicules {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .carte-vehicule {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .carte-vehicule img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .carte-vehicule h3 {
            margin: 10px 0;
            font-size: 1.5em;
        }

        .carte-vehicule p {
            margin: 10px;
            color: #555;
        }

        .carte-vehicule .btn {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            color: white;
            background: #333;
            text-decoration: none;
            border-radius: 5px;
        }

        .carte-vehicule .btn:hover {
            background: #555;
        }

        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
        }
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
        </ul>
    </nav>
</header>

<main>
    <h2>Nos Véhicules Disponibles</h2>
    <div class="liste-vehicules">
        <?php while ($vehicule = $resultat->fetch_assoc()): ?>
            <div class="carte-vehicule">
                <img src="<?php echo htmlspecialchars($vehicule['url_image']); ?>" alt="Image de <?php echo htmlspecialchars($vehicule['nom']); ?>">
                <h3><?php echo htmlspecialchars($vehicule['nom']); ?></h3>
                <p>Prix : <?php echo htmlspecialchars($vehicule['prix_par_jour']); ?> €/jour</p>
                <p><?php echo htmlspecialchars($vehicule['description']); ?></p>
                <?php if (isset($_SESSION['utilisateur_id'])): ?>
                    <!-- Si l'utilisateur est connecté -->
                    <a href="reservation.php?id_vehicule=<?php echo $vehicule['id']; ?>" class="btn">Réserver</a>
                <?php else: ?>
                    <!-- Si l'utilisateur n'est pas connecté -->
                    <a href="connexion.php" class="btn">Connectez-vous pour réserver</a>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<footer>
    <p>&copy; 2025 LuxRide Locations. Tous droits réservés.</p>
</footer>
</body>
</html>

