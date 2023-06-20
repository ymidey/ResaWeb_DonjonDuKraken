<?php

include("header.php");

// Requête SQL pour récupérer les catégories
$requeteCategorie = "SELECT * FROM sae203_categories";
$stmtCategorie = $db->prepare($requeteCategorie);
$stmtCategorie->execute();
$resultCategorie = $stmtCategorie->fetchAll(PDO::FETCH_ASSOC);

// Requête SQL afin de récupérer les informations des 12 prochains évènements de ma base de données à l'aide des ligne WHERE sae203_evenements.Date_Evenement >= CURDATE () et ASC LIMIT 7
$requeteProchainEvenement = "SELECT sae203_jeux.*, sae203_evenements.*, GROUP_CONCAT(sae203_categories.Nom_Categorie SEPARATOR ', ') AS Categories
FROM sae203_jeux
JOIN sae203_evenements ON sae203_jeux.ID_Jeu = sae203_evenements.ID_Jeu 
JOIN sae203_lien_jeuxcategories ON sae203_jeux.ID_Jeu = sae203_lien_jeuxcategories.ID_Jeu 
JOIN sae203_categories ON sae203_categories.ID_Categorie = sae203_lien_jeuxcategories.ID_Categorie
WHERE sae203_evenements.Date_Evenement >= CURDATE()
GROUP BY sae203_evenements.ID_Evenement
ORDER BY sae203_evenements.Date_Evenement ASC LIMIT 12";
$stmtProchainEvenement = $db->prepare($requeteProchainEvenement);
$stmtProchainEvenement->execute();
$resultProchainEvenement = $stmtProchainEvenement->fetchAll(PDO::FETCH_ASSOC);

// Requête SQL afin de récupérer les informations des 8 nouveaux évènements de ma base de données à l'aide des ligne WHERE sae203_evenements.Date_Creation <= CURDATE () et DESC LIMIT 5
$requeteNouveauEvenement = "SELECT sae203_jeux.*, sae203_evenements.*, GROUP_CONCAT(sae203_categories.Nom_Categorie SEPARATOR ', ') AS Categories
FROM sae203_jeux
JOIN sae203_evenements ON sae203_jeux.ID_Jeu = sae203_evenements.ID_Jeu 
JOIN sae203_lien_jeuxcategories ON sae203_jeux.ID_Jeu = sae203_lien_jeuxcategories.ID_Jeu 
JOIN sae203_categories ON sae203_categories.ID_Categorie = sae203_lien_jeuxcategories.ID_Categorie
WHERE sae203_evenements.Date_Creation <= CURDATE() 
GROUP BY sae203_evenements.ID_Evenement
ORDER BY sae203_evenements.Date_Creation DESC LIMIT 8";
$stmtNouveauEvenement = $db->prepare($requeteNouveauEvenement);
$stmtNouveauEvenement->execute();
$resultNouveauEvenement = $stmtNouveauEvenement->fetchAll(PDO::FETCH_ASSOC);
?>


<main>
    <!-- Hero section -->
    <section class="hero">
        <div class="hero-text">
            <h1 class="title"><span>Le Donjon du Kraken</span></h1>
            <p class="typing-text"><span>Jeu d'ambiance, Escape game, jeu de stratégie, jeu de rôle.</span>
                <span>Reservez vos places pour jouer à nos nombreux événements de jeux de sociétés.</span>
            </p>
            <a href="#form_reservation" class="btn-reservation">Réservez maintenant</a>
        </div>

        <div class="hero-form" id="form_reservation">
            <form class="reservation-form" method="GET" action="./nos-evenements.php">
                <div>
                    <label for="date">
                        Choix de la date :
                    </label>
                    <input type="date" id="date" name="date-evenement" placeholder="Vos disponibilités ?" />

                </div>
                <div>
                    <label for="nombre participant">
                        Nombre de participants :
                    </label>
                    <input type="number" min="1" id="nombre participant" name="participant-evenement" placeholder="Combien de participants ?" />
                </div>
                <div>
                    <label for="catégories-évènements">
                        Catégorie d'évènement :
                    </label>
                    <select id="catégories-évènements" name="categorie[]">
                        <!-- Ce code ne fonctionne pas encore, il est a retravailler -->
                        <!--  <option value="">Toutes les catégories</option> -->
                        <?php foreach ($resultCategorie as $row) { ?>
                            <option value="<?php echo $row["ID_Categorie"] ?>">
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
            <h2 class="title">Nos prochains évènements</h1>
        </div>
        <a href="nos-evenements.php?tri=date-croissant" class="link-see-all">Voir tout</a>
        <div class="owl-carousel owl-theme">
            <?php foreach ($resultProchainEvenement as $row) { ?>
                <a href="detail-evenement.php?ID_Evenement=<?php echo $row['ID_Evenement'] ?>">
                    <div class="card-container item">
                        <div class="card-container_images">
                            <img src="./Images/Image_jeu/<?php echo $row["Image_Jeu"] ?>.jpg" alt="<?php echo $row["Nom"] ?>" />
                        </div>
                        <div class="card-content">
                            <p class="card-content_categorie"><?php echo $row['Categories'] ?></p>
                            <p class="card-content_date">
                                <?php
                                $datefmt = new IntlDateFormatter('fr_FR', NULL, NULL, NULL, NULL,  'dd MMMM yyyy');
                                $date_evenement = date_create($row['Date_Evenement']);
                                echo $datefmt->format($date_evenement); ?>
                                à
                                <?php $heure = new DateTimeImmutable($row['Heure_Evenement']);
                                echo $heure->format('H\hi'); ?>
                            </p>
                            <h3 class="card-content_title"><?php echo $row["Titre"] ?></h3>
                            <p class="card-content_desc"><?php echo $row["Description"] ?></p>
                        </div>
                        <div class="card-content_otherinfo">
                            <div class="flex-row">
                                <div class="card-content_price">
                                    <p><?php echo $row["Prix_Evenement"] ?>€ / pers.</p>
                                </div>
                                <div class="card-content_seats">
                                    <p><?php echo $row["Nb_Place"] ?> places restantes</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
    </section>

    <!-- Nouveaux evenements section -->
    <section class="nouveaux-evenements">
        <div class="head">
            <h2 class="title">Nos nouveaux évènements</h2>
        </div>
        <a href="nos-evenements.php?tri=nouveaute" class="link-see-all">Voir tout</a>
        <div class="slider">
            <button type="button" class="btn-slide btn-left">
                <img src="./Images/chevron.svg" alt="évènements précédent">
            </button>
            <div class="card">
                <?php foreach ($resultNouveauEvenement as $row) { ?>
                    <a href="detail-evenement.php?ID_Evenement=<?php echo $row['ID_Evenement'] ?>">
                        <div class="card-container">
                            <div class="card-container_images">
                                <div class="nouveaute">Nouveauté</div>
                                <img src="./Images/Image_jeu/<?php echo $row["Image_Jeu"] ?>.jpg" alt="<?php echo $row["Nom"] ?>" />
                            </div>
                            <div class="card-content">
                                <p class="card-content_categorie"><?php echo $row['Categories'] ?></p>
                                <p class="card-content_date">
                                    <?php
                                    $datefmt = new IntlDateFormatter('fr_FR', NULL, NULL, NULL, NULL,  'dd MMMM yyyy');
                                    $date_evenement = date_create($row['Date_Evenement']);
                                    echo $datefmt->format($date_evenement); ?>
                                    à
                                    <?php $heure = new DateTimeImmutable($row['Heure_Evenement']);
                                    echo $heure->format('H\hi'); ?>
                                </p>
                                <h3 class="card-content_title"><?php echo $row["Titre"] ?></h3>
                                <p class="card-content_desc"><?php echo $row["Description"] ?></p>
                            </div>
                            <div class="card-content_otherinfo">
                                <div class="flex-row">
                                    <div class="card-content_price">
                                        <p><?php echo $row["Prix_Evenement"] ?>€ / pers.</p>
                                    </div>
                                    <div class="card-content_seats">
                                        <p><?php echo $row["Nb_Place"] ?> places restantes</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </a>
            </div>
            <button type="button" class="btn-slide btn-right">
                <img src="./Images/chevron.svg" alt="évènements suivant">
            </button>
        </div>
    </section>

    <!-- Section à propos -->
    <section class="concept">
        <h2 class="title">Le concept</h2>
        <div class="img-desc">
            <div class="left">
                <img src="Images/Logo_DonjonKraken.svg" alt=""></video>
            </div>
            <div class="right">
                <h3>Le Donjon du Kraken c'est quoi ?</h3>
                <p>Le Donjon du Kraken, c'est votre plateforme de réservation d'évènements autour des jeux de sociétés.
                    <br><br>
                    N'avez vous jamais eu envie de jouer à des jeux de société, mais vous n'étiez pas assez de joueur
                    pour y jouer ? Vous souhaitez jouer à des jeux de société dit "haut de gamme" mais sans dépenser
                    une fortune ? Vous êtes à la recherche d'une communauté de joueurs passionnés pour partager de bons
                    moments autour des jeux de sociétés ? Vous êtes à la recherche d'activité ludique et amusante à
                    faire pour vos enfants ?<br>
                    Reservez dès maintenant vos places pour l'un des nombreux événements que propose Le donjon du
                    Kraken !
                </p>
                <a href="a-propos.php#pourquoi">En savoir plus</a>
            </div>
        </div>
    </section>

    <!-- section categorie evenements -->
    <section class="categorie-evenement">
        <h2 class="title">Catégorie d'évènements</h2>
        <div class="content">
            <?php foreach ($resultCategorie as $row) { ?>
                <div class="cart">
                    <a href="nos-evenements.php?categorie[]=<?php echo $row['ID_Categorie'] ?>">
                        <img src="Images/Image_categorie/<?php echo $row['Image_Categorie'] ?>.jpg" alt="évènements <?php echo $row['Nom_categorie'] ?>">
                        <div class=" content">
                            <div>
                                <h3><?php echo $row['Nom_categorie'] ?></h3>
                            </div>
                        </div>
                    </a>
                </div>
            <?php }; ?>
        </div>
    </section>
</main>
<?php include("footer.php"); ?>