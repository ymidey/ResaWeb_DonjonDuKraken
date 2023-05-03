<?php
include("connexion.php");

$requeteCategorie = "SELECT * FROM sae203_categories";
$stmt = $db->query($requeteCategorie);
$resultCategorie = $stmt->fetchall(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Le donjon du Kraken - Réservations d'évènement de jeux de société à Champs-Sur-Marne">
    <title>Le donjon du Kraken - Réservations d'évènement de jeux de société</title>
    <link rel=" stylesheet" href="style.css">
</head>

<body>
    <!-- NavBar -->
    <header>
        <nav>
            <?php
            $nom_page = basename ($_SERVER ['PHP_SELF']);
            if ($nom_page == 'accueil.php') {?>
            <a href="#form_reservation" class="skip-link">Passer au formulaire</a>
            <?php };?>
            <div class="logo">
                <a href="accueil.php">
                    <img src="Images/Logo_sansTexte.svg" alt="Accueil">
                </a>
            </div>
            <ul class="links">
                <li><a href="accueil.php">Accueil</a></li>
                <li><a href="nos-evenements.php">Nos évènements</a></li>
                <li><a href="a-propos.php">À propos</a></li>
                <li><a href="#" class="btn-panier">Mon panier</a></li>
            </ul>

        </nav>
    </header>