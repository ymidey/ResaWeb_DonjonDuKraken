<?php
include("header.php");
$requeteCategorie = "SELECT * FROM sae203_categories";
$stmt = $db->query($requeteCategorie);
$resultCategorie = $stmt->fetchall(PDO::FETCH_ASSOC);

// Requête SQL afin de récupérer les informations des 7 prochains évènements de ma base de données à l'aide des ligne WHERE sae203_evenements.Date_Evenement >= CURDATE () et ASC LIMIT 7
$requeteProchainEvenement = "SELECT sae203_jeux.*, sae203_evenements.*, GROUP_CONCAT(sae203_categories.Nom_Categorie SEPARATOR ', ') AS Categories
FROM sae203_jeux
JOIN sae203_evenements ON sae203_jeux.ID_Jeu = sae203_evenements.ID_Jeu 
JOIN sae203_lien_jeuxcategories ON sae203_jeux.ID_Jeu = sae203_lien_jeuxcategories.ID_Jeu 
JOIN sae203_categories ON sae203_categories.ID_Categorie = sae203_lien_jeuxcategories.ID_Categorie
WHERE sae203_evenements.Date_Evenement >= CURDATE()
GROUP BY sae203_evenements.ID_Evenement
ORDER BY sae203_evenements.Date_Evenement ASC LIMIT 7";
$stmt = $db->query($requeteProchainEvenement);
$resultProchainEvenement = $stmt->fetchall(PDO::FETCH_ASSOC);

// Requête SQL afin de récupérer les informations des 7 nouveaux évènements de ma base de données à l'aide des ligne WHERE sae203_evenements.Date_Creation <= CURDATE () et DESC LIMIT 5
$requeteNouveauEvenement = "SELECT sae203_jeux.*, sae203_evenements.*, GROUP_CONCAT(sae203_categories.Nom_Categorie SEPARATOR ', ') AS Categories
FROM sae203_jeux
JOIN sae203_evenements ON sae203_jeux.ID_Jeu = sae203_evenements.ID_Jeu 
JOIN sae203_lien_jeuxcategories ON sae203_jeux.ID_Jeu = sae203_lien_jeuxcategories.ID_Jeu 
JOIN sae203_categories ON sae203_categories.ID_Categorie = sae203_lien_jeuxcategories.ID_Categorie
WHERE sae203_evenements.Date_Creation <= CURDATE() 
GROUP BY sae203_evenements.ID_Evenement
ORDER BY sae203_evenements.Date_Creation DESC LIMIT 5";
$stmt = $db->query($requeteNouveauEvenement);
$resultNouveauEvenement = $stmt->fetchall(PDO::FETCH_ASSOC);
?>

<main>
    <!-- Hero section -->
    <section class="hero">
        <div class="hero-text">
            <h1>Le Donjon du Kraken</h1>
            <p>Jeu d'ambiance, Escape game, jeu de stratégie, jeu de rôle.<br>
                Reservez vos places pour jouer à nos nombreux évènements jeux de sociétés.
            </p>
            <a href="#form_reservation" class="btn-reservation">Reservez maintenant</a>
        </div>

        <div class="hero-form" id="form_reservation">
            <form class="reservation-form" action="">
                <div>
                    <label for="date">
                        Dates
                    </label>
                    <input type="date" id="date" name="date-evenement" placeholder="Vos disponibilités ?" />

                </div>
                <div>
                    <label for="nombre participant">
                        Nombres participants
                    </label>
                    <input type="number" id="nombre participant" name="participant-evenement"
                        placeholder="Combien de participant ?" />
                </div>
                <div>
                    <label for="catégories-évènements">
                        Catégorie d'évènements
                    </label>
                    <select id="catégories-évènements" name="type-evenement">
                        <?php foreach ($resultCategorie as $row) { ?>
                        <option value="ID_Categorie=<?php echo $row["ID_Categorie"] ?>">
                            <?php echo $row["Nom_categorie"] ?></option>
                        <?php } ?>

                    </select>
                </div>
                <input type="submit" value="Rechercher">
            </form>
    </section>

    <!-- Prochains evenements section -->
    <section class="prochains-evenements">
        <div class="head">
            <h1 class="title">Nos prochains évènements</h1>
            <div class="btn-container">
                <button class="btn-slide btn-left">
                    <img src="Images/chevron.svg" alt="évènements précédent">
                </button>
                <button class="btn-slide btn-right">
                    <img src="Images/chevron.svg" alt="évènements suivant">
                </button>
            </div>
        </div>

        <div class="card">
            <?php foreach ($resultProchainEvenement as $row) { ?>
            <div class="card-container">
                <a href="#">
                    <div class="card-container_images">
                        <img src="Images/Image_jeu/<?php echo $row["Image_Jeu"] ?>.jpg"
                            alt="<?php echo $row["Nom"] ?>" />
                    </div>
                    <div class="card-content">
                        <p class="card-content_categorie"><?php echo $row['Categories'] ?></p>
                        <p class="card-content_date">
                            <?php
                                // Merci à Julp du forum OpenClassRoom pour avoir donné un code qui fonctionne 
                                $datefmt = new IntlDateFormatter('fr_FR', NULL, NULL, NULL, NULL,  'dd MMMM yyyy');
                                $date_evenement = date_create($row['Date_Evenement']);
                                echo $datefmt->format($date_evenement); ?>
                            à
                            <?php $heure = new DateTimeImmutable($row['Heure_Evenement']);
                                echo $heure->format('H\hi'); ?>
                        </p>
                        <h1 class="card-content_title"><?php echo $row["Titre"] ?>
                        </h1>
                        <p class="card-content_desc"><?php echo $row["Description"] ?></p>
                        <div class="flex-row">
                            <div class="card-content_price">
                                <p><?php echo $row["Prix_Evenement"] ?>€ / pers.</p>
                            </div>
                            <div class="card-content_seats">
                                <p><?php echo $row["Nb_Place"] ?> places restantes</p>
                            </div>
                        </div>
                        <div class="card-link">
                            <button>Détails</button>
                            <button>Ajouter au panier <img src="Images/ajout-produit-panier.svg" class="ajout-panier"
                                    alt=""></button>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>

    </section>

    <!-- Nouveaux evenements section -->
    <section class="nouveaux-evenements">
        <div class="head">
            <h1 class="title">Nos nouveaux évènements</h1>
        </div>
        <div class="card">
            <?php foreach ($resultNouveauEvenement as $row) { ?>
            <div class="card-container">
                <a href="#">
                    <div class="card-container_images">
                        <div class="nouveaute">Nouveauté</div>
                        <img src="Images/Image_jeu/<?php echo $row["Image_Jeu"] ?>.jpg"
                            alt="<?php echo $row["Nom"] ?>" />
                    </div>
                    <div class="card-content">
                        <p class="card-content_categorie"><?php echo $row['Categories'] ?></p>
                        <p class="card-content_date">
                            <?php
                                // Merci à Julp du forum OpenClassRoom pour avoir donné un code qui fonctionne 
                                $datefmt = new IntlDateFormatter('fr_FR', NULL, NULL, NULL, NULL,  'dd MMMM yyyy');
                                $date_evenement = date_create($row['Date_Evenement']);
                                echo $datefmt->format($date_evenement); ?>
                            à
                            <?php $heure = new DateTimeImmutable($row['Heure_Evenement']);
                                echo $heure->format('H\hi'); ?>
                        </p>
                        <h1 class="card-content_title"><?php echo $row["Titre"] ?>
                        </h1>
                        <p class="card-content_desc"><?php echo $row["Description"] ?></p>
                        <div class="flex-row">
                            <div class="card-content_price">
                                <p><?php echo $row["Prix_Evenement"] ?>€ / pers.</p>
                            </div>
                            <div class="card-content_seats">
                                <p><?php echo $row["Nb_Place"] ?> places restantes</p>
                            </div>
                        </div>
                        <div class="card-link">
                            <button>Détails</button>
                            <button>Ajouter au panier <img src="Images/ajout-produit-panier.svg" class="ajout-panier"
                                    alt=""></button>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
    </section>

    <!-- Section à propos -->
    <section class="concept">
        <h1 class="title">Le concept</h1>
        <div class="img-desc">
            <div class="left">
                <img src="Images/Logo_DonjonKraken.svg" alt=""></video>
            </div>

            <div class="right">
                <h2>Le Donjon du Kraken c'est quoi ?</h2>
                <p>Le Donjon du Kraken c'est votre plateforme de réservation d'évènements autour des jeux de sociétés.
                    <br><br>
                    N'avez vous jamais eu envie de jouer à des jeux de société mais vous n'étiez pas assez de joueur
                    pour y jouer ? Vous souhaitez jouez à des jeux de société dit "haut de gamme" mais sans dépenser
                    une
                    fortune ? Vous êtes à la recherche d'une communauté de joueurs passionnés pour partager de bons
                    moments autour des jeux de sociétés ? Vous êtes à la recherche d'activité ludique et amusante à
                    faire pour vos enfants ?<br>
                    Reservez dès maintenant vos places pour l'un des nombreux évènements que propose Le donjon du
                    Kraken !
                </p>
                <a href="a-propos.php#pourquoi">En savoir plus</a>
            </div>
        </div>
    </section>

    <!-- section categorie evenements -->
    <section class="categorie-evenement">
        <h1 class="title">Catégorie d'évènements</h1>
        <div class="content">
            <!-- cart -->
            <div class="cart">
                <img src="Images/Cat_famille.jpg" alt="évènements jeux familiale">
                <div class=" content">
                    <div>
                        <h2>Jeux d'ambiance</h2>
                    </div>
                </div>
            </div>

            <!-- cart -->
            <div class="cart">
                <img src="Images/Cat_EscapeGame.jpg" alt="évènements jeux Escape-game">
                <div class="content">
                    <div>
                        <h2>Escape-game</h2>
                    </div>
                </div>
            </div>

            <!-- cart -->
            <div class="cart">
                <img src="Images/Cat_Strategie.jpg" alt="évènements jeux stratégique">
                <div class="content">
                    <div>
                        <h2>Stratégie</h2>
                    </div>
                </div>
            </div>

            <!-- cart -->
            <div class="cart">
                <img src="Images/Cat_JeuCarte.jpg" alt="évènements jeux de carte">
                <div class="content">
                    <div>
                        <h2>Jeux de cartes</h2>
                    </div>
                </div>
            </div>

            <!-- cart -->
            <div class="cart">
                <img src="Images/Cat_JeuRole.jpg" alt="évènements jeux de rôles">
                <div class="content">
                    <div>
                        <h2>Jeux de rôle</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include("footer.php"); ?>