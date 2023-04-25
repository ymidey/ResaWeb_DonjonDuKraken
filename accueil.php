<?php
include ("header.php");
$requeteCategorie = "SELECT * FROM sae203_categories";
$stmt=$db->query($requeteCategorie);
$resultCategorie=$stmt->fetchall(PDO::FETCH_ASSOC);

$requeteProchainEvenement = "SELECT * FROM sae203_jeux, sae203_evenements WHERE sae203_jeux.ID_Jeu = sae203_evenements.ID_Jeu ORDER BY Date_Evenement ASC LIMIT 7";
$stmt=$db->query($requeteProchainEvenement);
$resultProchainEvenement=$stmt->fetchall(PDO::FETCH_ASSOC);

$requeteNouveauEvenement = "SELECT * FROM sae203_jeux, sae203_evenements WHERE sae203_jeux.ID_Jeu = sae203_evenements.ID_Jeu ORDER BY DATEDIFF(NOW(), Date_Creation) DESC LIMIT 5";
$stmt=$db->query($requeteNouveauEvenement);
$resultNouveauEvenement=$stmt->fetchall(PDO::FETCH_ASSOC);
?>

<body>
    <!-- NavBar -->
    <header>
        <nav>
            <a href="#form_reservation" class="skip-link">Passer au formulaire</a>
            <div class="logo">
                <a href="#">
                    <img src="Images/Logo_sansTexte.svg" alt="Accueil">
                </a>
            </div>
            <ul class="links">
                <li><a href="#">Accueil</a></li>
                <li><a href="#">Nos évènements</a></li>
                <li><a href="#">Nos tournois</a></li>
                <li><a href="#">À propos</a></li>
                <li><a href="#" class="btn-panier">Mon panier</a></li>
            </ul>

        </nav>
    </header>

    <main>
        <!-- Hero section -->
        <section class="hero">
            <div class="hero-text">
                <h1>Le Donjon du Kraken</h1>
                <p>Jeu d'ambiance, Escape game, jeu de stratégie, jeu de rôle.<br>
                    Reservez vos places pour jouer à nos nombreux évènements jeux de sociétés
                </p>
                <a href="#form_reservation" class="btn-reservation">Reservez maintenant</a>
            </div>

            <div class="hero-form" id="form_reservation">
                <form class="reservation-form" action="">
                    <div>
                        <label for="date">
                            Dates
                        </label>
                        <input type="date" id="date" name="date-evenement" placeholder="Vos disponibilités ?"
                            required />

                    </div>
                    <div>
                        <label for="participant">
                            Nombres participants
                        </label>
                        <input type="number" id="participant" name="participant-evenement"
                            placeholder="Combien de participant ?" required />
                    </div>
                    <div>
                        <label for="type">
                            Catégorie d'évènements
                        </label>
                        <select id="type" name="type-evenement">
                            <?php foreach ($resultCategorie as $row) { ?>
                            <option value="ID_Categorie=<?php echo $row["ID_Categorie"]?>">
                                <?php echo $row["Nom_categorie"]?></option>
                            <?php }?>

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
                <?php foreach ($resultProchainEvenement as $row){ ?>
                <div class="card-container">
                    <a href="#">
                        <div class="card-container_images">
                            <img src="Images/Image_jeu/<?php echo $row["Image_Jeu"]?>.jpg"
                                alt="<?php echo $row["Nom"]?>" />
                        </div>
                        <div class="card-content">
                            <p class="card-content_date">
                                <?php  $date_evenement = new DateTime($row["Date_Evenement"]);
                                echo $date_evenement->format("j F Y, H:i");?>
                            </p>
                            <h1 class="card-content_title"><?php echo $row["Titre"]?>
                            </h1>
                            <p class="card-content_desc"><?php echo $row["Description"]?></p>
                            <div class="flex-row">
                                <div class="card-content_price">
                                    <p><?php echo $row["Prix"]?>€ / pers.</p>
                                </div>
                                <div class="card-content_seats">
                                    <p><?php echo $row["Nb_Place"]?> places restantes</p>
                                </div>
                            </div>
                            <div class="card-link">
                                <button>Détails</button>
                                <button>Ajouter au panier <img src="Images/ajout-produit-panier.svg"
                                        class="ajout-panier" alt=""></button>
                            </div>
                        </div>
                    </a>
                </div>
                <?php }?>
            </div>

        </section>

        <!-- Nouveaux evenements section -->
        <section class="nouveaux-evenements">
            <div class="head">
                <h1 class="title">Nos nouveaux évènements</h1>
            </div>
            <div class="card">
                <?php foreach ($resultNouveauEvenement as $row){ ?>
                <div class="card-container">
                    <a href="#">
                        <div class="card-container_images">
                            <div class="nouveaute">Nouveauté</div>
                            <img src="Images/Image_jeu/<?php echo $row["Image_Jeu"]?>.jpg"
                                alt="<?php echo $row["Nom"]?>" />
                        </div>
                        <div class="card-content">
                            <p class="card-content_date">
                                <?php  $date_evenement = new DateTime($row["Date_Evenement"]);
                                echo $date_evenement->format("j F Y, H:i");?>
                            </p>
                            <h1 class="card-content_title"><?php echo $row["Titre"]?>
                            </h1>
                            <p class="card-content_desc"><?php echo $row["Description"]?></p>
                            <div class="flex-row">
                                <div class="card-content_price">
                                    <p><?php echo $row["Prix"]?>€ / pers.</p>
                                </div>
                                <div class="card-content_seats">
                                    <p><?php echo $row["Nb_Place"]?> places restantes</p>
                                </div>
                            </div>
                            <div class="card-link">
                                <button>Détails</button>
                                <button>Ajouter au panier <img src="Images/ajout-produit-panier.svg"
                                        class="ajout-panier" alt=""></button>
                            </div>
                        </div>
                    </a>
                </div>
                <?php }?>
            </div>
        </section>

        <!-- Section à propos -->
        <section class="a-propos">
            <h1 class="title">À propos</h1>
            <div class="img-desc">
                <div class="left">
                    <img src="Images/Logo_DonjonKraken.svg" alt=""></video>
                </div>

                <div class="right">
                    <h2>Le Donjon du Kraken c'est quoi ?</h2>
                    <p>Le Donjon du Kraken c'est votre plateforme de réservation d'évènements amical et
                        de tournois autour des jeux de sociétés.
                        <br><br>
                        N'avez vous jamais eu envie de jouer à des jeux de société mais vous n'étiez pas assez de joueur
                        pour y jouer ? Vous souhaitez jouez à des jeux de société dit "haut de gamme" mais sans dépenser
                        une
                        fortune ? Vous êtes à la recherche d'une communauté de joueurs passionnés pour partager de bons
                        moments autour des jeux de sociétés ? Vous êtes à la recherche d'activité ludique et amusante à
                        faire pour vos enfants ?<br>
                        Reservez dès maintenant vos places pour l'un des nombreux évènements que propose Le donjon du
                        Kraken
                    </p>
                    <a href="#">En savoir plus</a>
                </div>
            </div>
        </section>

        <!-- section categorie evenements -->
        <section class="categorie-evenement">
            <h1 class="title">Catégorie d'évènements</h1>
            <div class="content">
                <!-- cart -->
                <div class="cart">
                    <img src="Images/Cat_famille.jpg" alt="evenements jeux familiale">
                    <div class=" content">
                        <div>
                            <h2>Jeux d'ambiance</h2>
                        </div>
                    </div>
                </div>

                <!-- cart -->
                <div class="cart">
                    <img src="Images/Cat_EscapeGame.jpg" alt="evenements jeux Escape-game">
                    <div class="content">
                        <div>
                            <h2>Escape-game</h2>
                        </div>
                    </div>
                </div>

                <!-- cart -->
                <div class="cart">
                    <img src="Images/Cat_Strategie_illustrration.jpg" alt="evenements jeux stratégie">
                    <div class="content">
                        <div>
                            <h2>Stratégie</h2>
                        </div>
                    </div>
                </div>

                <!-- cart -->
                <div class="cart">
                    <img src="Images/Cat_JeuCarte.jpg" alt="">
                    <div class="content">
                        <div>
                            <h2>Jeux de cartes</h2>
                        </div>
                    </div>
                </div>

                <!-- cart -->
                <div class="cart">
                    <img src="Images/Cat_JeuRole.jpg" alt="">
                    <div class="content">
                        <div>
                            <h2>Jeux de rôle</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="footer_addr">
            <img src="Images/Logo_DonjonKraken.svg" alt="" class="footer_logo">

            <h1>Nous contacter :</h1>
            <address>2 Rue Albert Einstein, 77420 Champs-sur-Marne <br>
                <p>Email : midey.yannick@gmail.com</p>
            </address>
        </div>

        <ul class="footer_nav">
            <li class="nav_item">
                <h2 class="nav_title">Nos évènements</h2>
                <ul class="nav_ul">
                    <li>
                        <a href="#">Prochains évènements</a>
                    </li>
                    <li>
                        <a href="#">Nouveaux évènements</a>
                    </li>
                </ul>
            </li>

            <li class="nav_item nav_item-extra">
                <h2 class="nav_title">Catégories d'évènements</h2>

                <ul class="nav_ul nav_ul--extra">
                    <li>
                        <a href="#">Jeux d'ambiance</a>
                    </li>

                    <li>
                        <a href="#">EscapeGame</a>
                    </li>

                    <li>
                        <a href="#">Stratégie</a>
                    </li>

                    <li>
                        <a href="#">Jeux de cartes</a>
                    </li>

                    <li>
                        <a href="#">Jeux de rôle</a>
                    </li>

                </ul>
            </li>
            <li class="nav_item">
                <h2 class="nav_title">À propos</h2>

                <ul class="nav_ul">
                    <li>
                        <a href="#">Le créateur</a>
                    </li>

                    <li>
                        <a href="#">Le concept</a>
                    </li>
                    <li>
                        <a href="#">Mentions légals</a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="legal">
            <p>&copy;2023 Le Donjon du Kraken. Tout droits reservés.</p>
        </div>

    </footer>


</body>
<script src="script.js"></script>

</html>