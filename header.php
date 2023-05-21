<?php
include("connexion.php");

$requeteCategorie = "SELECT * FROM sae203_categories";
$stmt = $db->query($requeteCategorie);
$resultCategorie = $stmt->fetchall(PDO::FETCH_ASSOC);

if (isset($_GET['ID_Evenement'])) {
    $idEvenement = $_GET['ID_Evenement'];
    $requeteJeuNom = "SELECT sae203_jeux.Nom FROM sae203_jeux 
JOIN sae203_evenements ON sae203_jeux.ID_Jeu = sae203_evenements.ID_Jeu
WHERE sae203_evenements.ID_Evenement = $idEvenement";
    $stmt = $db->query($requeteJeuNom);
    $resultJeuNom = $stmt->fetchall(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
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
    <link rel=" stylesheet" href="style.css">
</head>

<body>
    <!-- NavBar -->
    <header>
        <nav>
            <?php
            $nom_page = basename($_SERVER['PHP_SELF']);
            if ($nom_page == 'accueil.php') { ?>
                <a href="#form_reservation" class="skip-link">Passer au formulaire</a>
            <?php }; ?>
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