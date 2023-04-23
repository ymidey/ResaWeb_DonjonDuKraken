<?php
include ("connexion.php");
$requeteCategorie = "SELECT * FROM sae203_categories";
$stmt=$db->query($requeteCategorie);
$resultCategorie=$stmt->fetchall(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le donjon du Kraken - Réservations d'évènement de jeux de société</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- NavBar -->
    <header>
        <nav>
            <a href="#form_reservation" class="skip-link">Passer au formulaire</a>
            <div class="logo">
                <a href="#">
                    <img src="Image/Logo_sansTexte.svg" alt="Accueil">
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

        <!-- Nouveaux evenements section -->
        <section class="nouveaux-evenements">
            <div class="head">
                <h1 class="title">Nos nouveaux évènements</h1>
                <div class="btn-container">
                    <button class="btn-slide btn-left">
                        <img src="Image/chevron.svg" alt="évènements précédent">
                    </button>
                    <button class="btn-slide btn-right">
                        <img src="Image/chevron.svg" alt="évènements suivant">
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-container">
                    <a href="#">
                        <div class="card-container_image">
                            <img src="Image/Evement_Monopoly.jpg" alt="Évènement Monopoly" />
                        </div>
                        <div class="card-content">
                            <p class="card-content_date">26 Sep. 2023 • 14h30</p>
                            <h1 class="card-content_title">Après-midi Monopoly
                            </h1>
                            <p class="card-content_desc">Venez jouez au jeu Monopoly dans une ambiance chaleureuse</p>
                            <div class="flex-row">
                                <div class="card-content_price">
                                    <p>3€ / pers.</p>
                                </div>
                                <div class="card-content_seats">
                                    <p>5 places restantes</p>
                                </div>
                            </div>
                            <div class="card-link">
                                <button>Détails</button>
                                <button>Ajouter au panier <img src="Image/ajout-produit-panier.svg" class="ajout-panier"
                                        alt=""></button>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="card-container">
                    <div class="card-container_image">
                        <img src="Image/Evement_Monopoly.jpg" alt="Évènement Monopoly" />
                    </div>
                    <div class="card-content">
                        <p class="card-content_date">26 Sep. 2023 • 14h30 à 17h00 </p>
                        <h1 class="card-content_title"><a href="#">Après-midi Monopoly
                            </a></h1>
                        <p class="card-content_desc">Venez jouez au jeu Monopoly dans une ambiance chaleureuse</p>
                        <div class="flex-row">
                            <div class="card-content_price">
                                <p>3€ / pers.</p>
                            </div>
                            <div class="card-content_seats">
                                <p>5 places restantes</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-container">
                    <div class="card-container_image">
                        <img src="Image/Evement_Monopoly.jpg" alt="Évènement Monopoly" />
                    </div>
                    <div class="card-content">
                        <p class="card-content_date">26 Sep. 2023 • 14h30 à 17h00 </p>
                        <h1 class="card-content_title"><a href="#">Après-midi Monopoly
                            </a></h1>
                        <p class="card-content_desc">Venez jouez au jeu Monopoly dans une ambiance chaleureuse
                        </p>
                        <div class="flex-row">
                            <div class="card-content_price">
                                <p>3€ / pers.</p>
                            </div>
                            <div class="card-content_seats">
                                <p>5 places restantes</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-container">
                    <div class="card-container_image">
                        <img src="Image/Evement_Monopoly.jpg" alt="Évènement Monopoly" />
                    </div>
                    <div class="card-content">
                        <p class="card-content_date">26 Sep. 2023 • 14h30 à 17h00 </p>
                        <h1 class="card-content_title"><a href="#">Après-midi Monopoly
                            </a></h1>
                        <p class="card-content_desc">Venez jouez au jeu Monopoly dans une ambiance
                            chaleureuse</p>
                        <div class="flex-row">
                            <div class="card-content_price">
                                <p>3€ / pers.</p>
                            </div>
                            <div class="card-content_seats">
                                <p>5 places restantes</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-container">
                    <div class="card-container_image">
                        <img src="Image/Evement_Monopoly.jpg" alt="Évènement Monopoly" />
                    </div>
                    <div class="card-content">
                        <p class="card-content_date">26 Sep. 2023 • 14h30 à 17h00 </p>
                        <h1 class="card-content_title"><a href="#">Après-midi Monopoly
                            </a></h1>
                        <p class="card-content_desc">Venez jouez au jeu Monopoly dans une ambiance
                            chaleureuse</p>
                        <div class="flex-row">
                            <div class="card-content_price">
                                <p>3€ / pers.</p>
                            </div>
                            <div class="card-content_seats">
                                <p>5 places restantes</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-container">
                    <div class="card-container_image">
                        <img src="Image/Evement_Monopoly.jpg" alt="Évènement Monopoly" />
                    </div>
                    <div class="card-content">
                        <p class="card-content_date">26 Sep. 2023 • 14h30 à 17h00 </p>
                        <h1 class="card-content_title"><a href="#">Après-midi Monopoly
                            </a></h1>
                        <p class="card-content_desc">Venez jouez au jeu Monopoly dans une ambiance
                            chaleureuse</p>
                        <div class="flex-row">
                            <div class="card-content_price">
                                <p>3€ / pers.</p>
                            </div>
                            <div class="card-content_seats">
                                <p>5 places restantes</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Nouveaux evenements section -->
        <section class="nouveaux-tournois">
            <div class="head">
                <h1 class="title">Nos nouveaux tournois</h1>
            </div>
            <div class="card">
                <div class="card-container">
                    <a href="#">
                        <div class="card-container_image">
                            <img src="Image/Cat_JeuCarte_illustration.jpg" alt="Tournoi Yu-Gi-Oh" />
                        </div>
                        <div class="card-content">
                            <p class="card-content_date">07 Sep. 2023 • 17h30 à 19h00 </p>
                            <h1 class="card-content_title">Tournoi Yu-Gi-Oh
                            </h1>
                            <p class="card-content_desc">Tournoi Yu-Gi-Oh série carte Photon Hypernova 2023 <br><br>
                                CashPrice pour le vainqueur: 6 Boosters Yu-Gi-Oh Photon Hypernova</p>
                            <div class="flex-row">
                                <div class="card-content_price">
                                    <p>8€ / pers.</p>
                                </div>
                                <div class="card-content_seats">
                                    <p>9 places restantes</p>
                                </div>
                            </div>
                            <button>Détails</button>
                            <button>Ajouter au panier</button>
                        </div>
                    </a>
                </div>
                <div class="card-container">
                    <a href="#">
                        <div class="card-container_image">
                            <img src="Image/Cat_JeuCarte_illustration.jpg" alt="Tournoi Yu-Gi-Oh" />
                        </div>
                        <div class="card-content">
                            <p class="card-content_date">07 Sep. 2023 • 17h30 à 19h00 </p>
                            <h1 class="card-content_title">Tournoi Yu-Gi-Oh
                            </h1>
                            <p class="card-content_desc">Tournoi Yu-Gi-Oh série carte Photon Hypernova 2023 <br><br>
                                CashPrice pour le vainqueur: 6 Boosters Yu-Gi-Oh Photon Hypernova</p>
                            <div class="flex-row">
                                <div class="card-content_price">
                                    <p>8€ / pers.</p>
                                </div>
                                <div class="card-content_seats">
                                    <p>9 places restantes</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="card-container">
                    <a href="#">
                        <div class="card-container_image">
                            <img src="Image/Cat_JeuCarte_illustration.jpg" alt="Tournoi Yu-Gi-Oh" />
                        </div>
                        <div class="card-content">
                            <p class="card-content_date">07 Sep. 2023 • 17h30 à 19h00 </p>
                            <h1 class="card-content_title">Tournoi Yu-Gi-Oh
                            </h1>
                            <p class="card-content_desc">Tournoi Yu-Gi-Oh série carte Photon Hypernova 2023 <br><br>
                                CashPrice pour le vainqueur: 6 Boosters Yu-Gi-Oh Photon Hypernova</p>
                            <div class="flex-row">
                                <div class="card-content_price">
                                    <p>8€ / pers.</p>
                                </div>
                                <div class="card-content_seats">
                                    <p>9 places restantes</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="card-container">
                    <a href="#">
                        <div class="card-container_image">
                            <img src="Image/Cat_JeuCarte_illustration.jpg" alt="Tournoi Yu-Gi-Oh" />
                        </div>
                        <div class="card-content">
                            <p class="card-content_date">07 Sep. 2023 • 17h30 à 19h00 </p>
                            <h1 class="card-content_title">Tournoi Yu-Gi-Oh
                            </h1>
                            <p class="card-content_desc">Tournoi Yu-Gi-Oh série carte Photon Hypernova 2023 <br><br>
                                CashPrice pour le vainqueur: 6 Boosters Yu-Gi-Oh Photon Hypernova</p>
                            <div class="flex-row">
                                <div class="card-content_price">
                                    <p>8€ / pers.</p>
                                </div>
                                <div class="card-content_seats">
                                    <p>9 places restantes</p>
                                </div>
                            </div>

                        </div>
                    </a>
                </div>

            </div>
        </section>

        <!-- Section à propos -->
        <section class="a-propos">
            <h1 class="title">À propos</h1>
            <div class="img-desc">
                <div class="left">
                    <img src="Image/Logo_Entreprise.svg" alt=""></video>
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
                    <img src="Image/Cat_famille_illustration.jpg" alt="evenements jeux familiale">
                    <div class=" content">
                        <div>
                            <h2>Jeux d'ambiance</h2>
                        </div>
                    </div>
                </div>

                <!-- cart -->
                <div class="cart">
                    <img src="Image/Cat_EscapeGame_illustration.jpg" alt="evenements jeux Escape-game">
                    <div class="content">
                        <div>
                            <h2>Escape-game</h2>
                        </div>
                    </div>
                </div>

                <!-- cart -->
                <div class="cart">
                    <img src="Image/Cat_Strategie_illustrration.jpg" alt="evenements jeux stratégie">
                    <div class="content">
                        <div>
                            <h2>Stratégie</h2>
                        </div>
                    </div>
                </div>

                <!-- cart -->
                <div class="cart">
                    <img src="Image/Cat_JeuCarte_illustration.jpg" alt="">
                    <div class="content">
                        <div>
                            <h2>Jeux de cartes</h2>
                        </div>
                    </div>
                </div>

                <!-- cart -->
                <div class="cart">
                    <img src="Image/Cat_JeuRole_illustration.jpg" alt="">
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
            <img src="Image/Logo_Entreprise.svg" alt="" class="footer_logo">

            <h1>Nous contacter :</h1>
            <address>2 Rue Albert Einstein, 77420 Champs-sur-Marne <br>
                <p>Email : midey.yannick@gmail.com</p>
            </address>
        </div>

        <ul class="footer_nav">
            <li class="nav_item">
                <h2 class="nav_title">Types d'évènements</h2>
                <ul class="nav_ul">
                    <li>
                        <a href="#">Évènements amical</a>
                    </li>
                    <li>
                        <a href="#">Nos tournois</a>
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