<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vroomly</title>
    <link rel="stylesheet" href="acceuil_footer.css">
    <link rel="stylesheet" href="acceuil.css">
</head>
<body>
    <div class="conteneur">
        <div class="contenu">
            <div class="container">
                <nav>
                    <div class="logo-container">
                        <img src="logo.png" alt="Logo de Vroomly" class="logo" />
                    </div>
                    <ul>
                        <li><a href="#" class="active">Accueil</a></li>
                        <li><a href="vehicules.php">Voitures</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><button id="auth-button" class="auth-btn">Connexion</button></li>
                    </ul>
                </nav>

                <section class="site-container">
                    <p>Bienvenue sur</p>
                    <h1>VROOMLY</h1>
                    <h3>Locations de voitures</h3>
                </section>
            </div>
        </div>

        <footer>
            <div class="contenu-footer">
                <div class="footer-services bloc">
                    <h3>Nos services</h3>
                    <p>Location de voitures</p>
                </div>

                <div class="footer-contact bloc">
                    <h3>Nous contacter</h3>
                    <p>Téléphone : 55-55-55-55</p>
                    <p>Email : <a href="mailto:vroomly@gmail.com">vroomly@gmail.com</a></p>
                    <p>Adresse : 6 rue de l'invention, Le Mans, 72100</p>
                </div>

                <div class="footer-horaires bloc">
                    <h3>Nos horaires</h3>
                    <p>Ouvert 7j/7</p>
                    <p>24h/24</p>
                </div>
            </div>

            <div class="pied-de-page">
                <p>&copy; 2025 Vroomly. Tous droits réservés.</p>
            </div>
        </footer>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Récupérer le bouton de connexion/déconnexion
            const authButton = document.getElementById("auth-button");

            // Vérifier si l'utilisateur est connecté 
            let isUserLoggedIn = localStorage.getItem("isLoggedIn") === "true";

            // Mettre à jour le bouton
            function updateAuthButton() {
                if (isUserLoggedIn) {
                    authButton.textContent = "Déconnexion";
                    authButton.style.backgroundColor = "#e74c3c"; // Couleur rouge
                    authButton.onclick = () => {
                        // Rediriger vers la page de déconnexion
                        window.location.href = "deconnexion.php";
                    };
                } else {
                    authButton.textContent = "Connexion";
                    authButton.style.backgroundColor = "#3498db"; //couleur bleu
                    authButton.onclick = () => {
                        // Rediriger vers la page de connexion
                        window.location.href = "connexion.php";
                    };
                }
            }

            updateAuthButton();
        });
    </script>
</body>
</html>
