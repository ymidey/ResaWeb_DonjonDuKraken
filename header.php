<?php
// On fait appel à notre fichier connexion.php afin de se connecter à la bdd
include('connexion.php');

// On créer une session pour le visiteur
session_start();

// Requête SQL afin de récupérer toutes les catégories de la table nommée sae203_categories
$requeteCategorie = "SELECT * FROM sae203_categories";
$stmt = $db->query($requeteCategorie);
$resultCategorie = $stmt->fetchall(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="shortcut icon" href="./Images/Logo_sansTexte.svg" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Le donjon du Kraken - Réservations d'évènement de jeux de société à Champs-Sur-Marne">
    <title>Le donjon du Kraken - <?php if (isset($_GET['recherche'])) {
                                        echo $_GET['recherche'];
                                    } else if (isset($_GET['ID_Evenement'])) {
                                        foreach ($resultJeuNom as $row) {
                                            echo $row['Nom'];
                                        }
                                    } else
                                        echo "Réservations d'évènement de jeux de société" ?>
    </title>
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer">

</head>

<body>
    <!-- NavBar -->
    <header>
        <nav>
            <?php
            $nom_page = basename($_SERVER['PHP_SELF']);
            if (($nom_page == 'accueil.php') || ($nom_page == 'nos-evenements.php')) { ?>
                <a href="#form_reservation" class="skip-link">Passer au formulaire</a>
            <?php }; ?>
            <div class="logo">
                <a href="accueil.php">
                    <img src="Images/Logo_sansTexte.svg" alt="Accueil du site">
                </a>
            </div>
            <ul class="links">
                <li><a href="accueil.php">Accueil</a></li>
                <li><a href="nos-evenements.php">Nos évènements</a></li>
                <li><a href="a-propos.php">À propos</a></li>
                <li><a href="panier.php" class="btn-panier">Mon panier</a></li>
            </ul>

        </nav>
    </header>