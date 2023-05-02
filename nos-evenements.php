<?php
include("header.php");

// Récupérer les paramètres de la requête url actuelle
$current_params = $_GET;

$requeteEvenement = "SELECT * FROM sae203_jeux, sae203_evenements, sae203_lien_jeuxcategories, sae203_categories 
WHERE sae203_jeux.ID_Jeu = sae203_evenements.ID_Jeu 
AND sae203_evenements.Date_Evenement >= CURDATE() 
AND sae203_jeux.ID_Jeu = sae203_lien_jeuxcategories.ID_Jeu 
AND sae203_lien_jeuxcategories.ID_Categorie = sae203_categories.ID_Categorie";

// créer la requête de filtrage en fonction des valeurs du formulaire
if (isset($_GET['date-evenement']) && !empty($_GET['date-evenement'])) {
    $date = $_GET['date-evenement'];
    $requeteEvenement .= " AND sae203_evenements.Date_Evenement = '$date'";
}
if (isset($_GET['participant-evenement']) && !empty($_GET['participant-evenement'])) {
    $participant = $_GET['participant-evenement'];
    $requeteEvenement .= " AND sae203_evenements.Nb_Place >= $participant";
}
if (isset($_GET['prix']) && !empty($_GET['prix'])) {
    $prix = $_GET['prix'];
    $requeteEvenement .= " AND sae203_evenements.Prix_evenement < '$prix'";
}

if (isset($_GET['categorie']) && !empty($_GET['categorie'])) {
    $categories = $_GET['categorie'];
    $requeteEvenement .= " AND (";
    foreach ($categories as $categorie) {
        $requeteEvenement .= "sae203_categories.ID_Categorie = $categorie OR ";
    }
    $requeteEvenement = rtrim($requeteEvenement, " OR ");
    $requeteEvenement .= ")";
}

if (isset($_GET['recherche']) && !empty($_GET['recherche'])) {
    $recherche = $_GET['recherche'];
    $requeteEvenement .= " AND sae203_evenements.Titre LIKE '%$recherche%'";
}

$requeteEvenement .= " GROUP BY sae203_evenements.ID_Evenement ";

if ($_GET['tri'] == "date-croissant") {
    $requeteEvenement .= "ORDER BY sae203_evenements.Date_Evenement ASC";
}

if ($_GET['tri'] == "date-decroissant") {
    $requeteEvenement .= "ORDER BY sae203_evenements.Date_Evenement DESC";
}
if ($_GET['tri'] == "prix-croissant") {
    $requeteEvenement .= "ORDER BY sae203_evenements.Prix_Evenement ASC";
}
if ($_GET['tri'] == "prix-decroissant") {
    $requeteEvenement .= "ORDER BY sae203_evenements.Prix_Evenement DESC";
}
echo '<script>';
echo 'console.log(' . json_encode($requeteEvenement, JSON_HEX_TAG) . ')';
echo '</script>';
// exécuter la requête de filtrage
$stmt = $db->query($requeteEvenement);
$resultEvenement = $stmt->fetchall(PDO::FETCH_ASSOC);

?>

<div class="nos-evenements">
    <form class="filter-form" action="">
        <input type="hidden" name="tri" value="<?php echo $_GET["tri"] ?>">
        <h1>Recherche avancé</h1>
        <div class="filter-prix filter">
            <fieldset>
                <legend>
                    <h2>Prix de l'évènement</h2>
                </legend>
                <?php
                $liste_prix = array("3", "6", "8", "11");

                foreach ($liste_prix as $prix) {
                    $checked = "";
                    if (isset($_GET['prix']) and $_GET['prix'] == $prix) {
                        $checked = "checked";
                    }
                ?>
                    <div>
                        <label for="<?php echo $prix ?>€">
                            <input type="radio" id="<?php echo $prix ?>€" value="<?php echo $prix ?>" name="prix" <?php echo $checked ?>> Moins de <?php echo $prix ?>€
                        </label>
                    </div>
                <?php
                }
                ?>
            </fieldset>
        </div>

        <div class="filter-date filter">
            <label for="date">
                <h2>Choix de la date</h2>
                <input type="date" id="date" name="date-evenement" placeholder="Vos disponibilités ?" value="<?php echo isset($_GET['date-evenement']) ? $_GET['date-evenement'] : '' ?>" />
            </label>
        </div>

        <div class="filter-participant filter">
            <label for="participant">
                <h2>Nombre de participant</h2>
                <input type="number" id="participant" name="participant-evenement" placeholder="Combien de participant ?" value="<?php echo isset($_GET['participant-evenement']) ? $_GET['participant-evenement'] : '' ?>" />
            </label>
        </div>
        <div class="filter-categorie filter">
            <fieldset>
                <legend>
                    <h2>Choix de la ou des catégories</h2>
                </legend>
                <div class="checkbox">
                    <?php foreach ($resultCategorie as $row) { ?>
                        <label for="<?php echo $row["ID_Categorie"] ?>"><?php echo $row["Nom_categorie"] ?>
                            <input type="checkbox" name="categorie[]" id="<?php echo $row["ID_Categorie"] ?>" value="<?php echo $row["ID_Categorie"] ?>" <?php if (isset($_GET['categorie']) && !empty($_GET['categorie'])) {
                                                                                                                                                                foreach ($_GET['categorie'] as $categorie) {
                                                                                                                                                                    if ($categorie == $row["ID_Categorie"]) {
                                                                                                                                                                        echo "checked";
                                                                                                                                                                    }
                                                                                                                                                                }
                                                                                                                                                            } ?>>
                        </label><?php } ?>
                </div>
            </fieldset>
        </div>
        <input type="submit" value="Rechercher">
    </form>
    <div class="test">
        <label for="recherche-input">
            <h1>Rechercher un évènement :</h1>
        </label>
        <form class="recherche" action="">
            <input type="search" id="recherche-input" name="recherche" placeholder="ex : Monopoly, La Bonne Paye, Cluedo..." value="<?php echo isset($_GET['recherche']) ? $_GET['recherche'] : '' ?>" />
            <button type="submit"><img src="Images/search-icon.svg" alt="valider la recherche"></button>
        </form>
        <div class="dropdown">
            <label for="tri">
                <input class="text-box" type="text" id="tri" placeholder="Tri par : <?php echo $_GET['tri'] ?>" readonly>
                <div class="options">
                    <div><a href="nos-evenements.php?<?php echo http_build_query(array_merge($current_params, array('tri' => 'date-croissant'))); ?>">Par
                            date croissante</a></div>
                    <div><a href="nos-evenements.php?<?php echo http_build_query(array_merge($current_params, array('tri' => 'date-decroissant'))); ?>">Par
                            date décroissante</a></div>
                    <div><a href="nos-evenements.php?<?php echo http_build_query(array_merge($current_params, array('tri' => 'prix-croissant'))); ?>">Par
                            prix croissant</a></div>
                    <div><a href="nos-evenements.php?<?php echo http_build_query(array_merge($current_params, array('tri' => 'prix-decroissant'))); ?>">Par
                            prix décroissant</a></div>
                </div>
            </label>
        </div>
        <div class="card-evenement">
            <?php foreach ($resultEvenement as $row) { ?>
                <div class="card-container">
                    <a href="#">
                        <div class="card-container_images">
                            <img src="Images/Image_jeu/<?php echo $row["Image_Jeu"] ?>.jpg" alt="<?php echo $row["Nom"] ?>" />
                        </div>
                        <div class="card-content">
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
                                <button>Ajouter au panier <img src="Images/ajout-produit-panier.svg" class="ajout-panier" alt=""></button>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>

    </div>
</div>

<?php
include("footer.php");
?>