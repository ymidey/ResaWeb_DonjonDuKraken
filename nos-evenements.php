<?php
include ("header.php");
$requeteEvenement = "SELECT * FROM sae203_jeux, sae203_evenements WHERE sae203_jeux.ID_Jeu = sae203_evenements.ID_Jeu";
$stmt=$db->query($requeteEvenement);
$resultEvenement=$stmt->fetchall(PDO::FETCH_ASSOC);

$requeteCategorie = "SELECT * FROM sae203_categories";
$stmt=$db->query($requeteCategorie);
$resultCategorie=$stmt->fetchall(PDO::FETCH_ASSOC);
?>

<div class="nos-evenements">
    <form class="filter-form" action="">
        <h1>Recherche avancé</h1>
        <div class="filter-prix filter">
            <h2>Prix de l'évènement</h2>

            <div>
                <label for="4">
                    <input type="radio" id="4" name="prix"> Moins de 4€
                </label>
            </div>
            <div>
                <label for="6">
                    <input type="radio" id="6" name="prix"> Moins de 6€
                </label>
            </div>
            <div>
                <label for="8">
                    <input type="radio" id="8" name="prix"> Moins de 8€
                </label>
            </div>
            <div>
                <label for="11">
                    <input type="radio" id="11" name="prix"> Moins de 11€
                </label>
            </div>
        </div>

        <div class="filter-date filter">
            <label for="date">
                <h2>Choix de la date</h2>
                <input type="date" id="date" name="date-evenement" placeholder="Vos disponibilités ?" />
            </label>
        </div>

        <div class="filter-participant filter">
            <label for="participant">
                <h2>Nombre de participant</h2>
                <input type="number" id="participant" name="participant-evenement"
                    placeholder="Combien de participant ?" />
            </label>
        </div>
        <div class="filter-categorie filter">
            <h2>Choix de la ou des catégories</h2>
            <div class="checkbox">
                <?php foreach ($resultCategorie as $row) { ?>
                <label for="<?php echo $row["ID_Categorie"]?>"><?php echo $row["Nom_categorie"]?>
                    <input type="checkbox" name="Categorie" id="<?php echo $row["ID_Categorie"]?>">
                </label><?php }?>
            </div>
        </div>
        <input type="submit" value="Rechercher">
    </form>
    <div class="test">
        <form class="recherche">
            <input type="search" placeholder="Rechercher un évènement...">
            <button type="submit"><img src="Images/search-icon.svg" alt=""></button>
        </form>
        <div class="tri">
            <span>Trier par :</span>
            <a href="#" data-tri="Date-croissant">Date croissante</a>
            <a href="#" data-tri="Date-decroissant">Date décroissante</a>
            <a href="#" data-tri="Prix-croissant">Prix croissant</a>
            <a href="#" data-tri="Prix-decroissant">Prix décroissant</a>
            <a href="#" data-tri="Date-Ajout">Date d'ajout</a>
        </div>
        <div class="card-evenement">
            <?php foreach ($resultEvenement as $row) {?>
            <div class="card-container">
                <a href="#">
                    <div class="card-container_images">
                        <img src="Images/Image_jeu/<?php echo $row["Image_Jeu"]?>.jpg" alt="<?php echo $row["Nom"]?>" />
                    </div>
                    <div class="card-content">
                        <p class="card-content_date">
                            <?php $date_evenement = new DateTime($row["Date_Evenement"]);
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
                            <button>Ajouter au panier <img src="Images/ajout-produit-panier.svg" class="ajout-panier"
                                    alt=""></button>
                        </div>
                    </div>
                </a>
            </div>
            <?php }?>
        </div>

    </div>
</div>


<?php 
include ("footer.php");
?>