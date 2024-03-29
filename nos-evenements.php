<?php
include("header.php");

// Récupérer les paramètres de la requête url actuelle
$current_params = $_GET;

$requeteEvenements =
    "SELECT sae203_jeux.*, sae203_evenements.*, GROUP_CONCAT(sae203_categories.Nom_Categorie SEPARATOR ', ') AS Categories
FROM sae203_jeux
JOIN sae203_evenements ON sae203_jeux.ID_Jeu = sae203_evenements.ID_Jeu 
JOIN sae203_lien_jeuxcategories ON sae203_jeux.ID_Jeu = sae203_lien_jeuxcategories.ID_Jeu 
JOIN sae203_categories ON sae203_categories.ID_Categorie = sae203_lien_jeuxcategories.ID_Categorie
WHERE sae203_evenements.Date_Evenement >= CURDATE()";

$params = array();

if (isset($_GET['categorie']) && !empty($_GET['categorie'])) {
    $categories = $_GET['categorie'];
    $requeteEvenements .= " AND sae203_jeux.ID_Jeu IN 
        (SELECT sae203_jeux.ID_Jeu
         FROM sae203_jeux 
          JOIN sae203_lien_jeuxcategories ON sae203_jeux.ID_Jeu = sae203_lien_jeuxcategories.ID_Jeu 
         WHERE ";
    foreach ($categories as $categorie) {
        $requeteEvenements .= "sae203_lien_jeuxcategories.ID_Categorie = :categorie$categorie OR ";
        $params[":categorie$categorie"] = $categorie;
    }
    $requeteEvenements = rtrim($requeteEvenements, " OR ");
    $requeteEvenements .= ")";
}

// créer la requête de filtrage en fonction des valeurs du formulaire
if (isset($_GET['date-evenement']) && !empty($_GET['date-evenement'])) {
    $date = $_GET['date-evenement'];
    $requeteEvenements .= " AND sae203_evenements.Date_Evenement = :date_evenement";
    $params[':date_evenement'] = $date;
}
if (isset($_GET['participant-evenement']) && !empty($_GET['participant-evenement'])) {
    $participant = $_GET['participant-evenement'];
    $requeteEvenements .= " AND sae203_evenements.Nb_Place >= :participant_evenement";
    $params[':participant_evenement'] = $participant;
}
if (isset($_GET['prix']) && !empty($_GET['prix'])) {
    $prix = $_GET['prix'];
    $requeteEvenements .= " AND sae203_evenements.Prix_evenement < :prix";
    $params[':prix'] = $prix;
}

if (isset($_GET['recherche']) && !empty($_GET['recherche'])) {
    $recherche = $_GET['recherche'];
    $requeteEvenements .= " AND sae203_evenements.Titre LIKE :recherche";
    $params[':recherche'] = "%$recherche%";
}

$requeteEvenements .= " GROUP BY sae203_evenements.ID_Evenement ";

if (!isset($_GET['tri'])) {
    $requeteEvenements .= "ORDER BY sae203_evenements.Date_Evenement ASC";
}

if (isset($_GET['tri'])) {
    if ($_GET['tri'] == "date-croissant") {
        $requeteEvenements .= "ORDER BY sae203_evenements.Date_Evenement ASC";
    }

    if ($_GET['tri'] == "date décroissante") {
        $requeteEvenements .= "ORDER BY sae203_evenements.Date_Evenement DESC";
    }
    if ($_GET['tri'] == "prix croissant") {
        $requeteEvenements .= "ORDER BY sae203_evenements.Prix_Evenement ASC";
    }
    if ($_GET['tri'] == "prix décroissant") {
        $requeteEvenements .= "ORDER BY sae203_evenements.Prix_Evenement DESC";
    }
    if ($_GET['tri'] == "nouveauté") {
        $requeteEvenements .= "ORDER BY sae203_evenements.Date_Creation DESC";
    }
}

// exécuter la requête de filtrage
$stmt = $db->prepare($requeteEvenements);
$stmt->execute($params);
$resultEvenements = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<main>
    <div class="nos-evenements">
        <div class="filter-div">
            <form class="filter-form" action="">
                <?php if (isset($_GET['tri'])) { ?>
                    <input type="hidden" name="tri" value="<?php echo $_GET["tri"] ?>">
                <?php }; ?>
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
                        <input type="number" min="1" id="participant" name="participant-evenement" placeholder="Un nombre est attendu" value="<?php echo isset($_GET['participant-evenement']) ? $_GET['participant-evenement'] : '' ?>" />
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
                                </label>
                            <?php } ?>
                        </div>
                    </fieldset>
                </div>
                <input type="submit" value="Rechercher">
            </form>
            <a href="nos-evenements.php" onclick="return confirm('Êtes-vous sûr de vouloir supprimer tous les événements de votre panier ?');">
                <button class="btn-delete-filter" type="button">Réinitialiser tous les filtres</button>
            </a>
        </div>
        <div class="liste-evenements">
            <label for="recherche-input">
                <h1>Rechercher un évènement :</h1>
            </label>
            <form class="recherche" id="form_reservation" action="">
                <input type="search" id="recherche-input" name="recherche" placeholder="ex : Monopoly, La Bonne Paye, Cluedo..." value="<?php echo isset($_GET['recherche']) ? $_GET['recherche'] : '' ?>" />
                <button type="submit"><img src="./Images/search-icon.svg" alt="valider la recherche"></button>
            </form>
            <div class="dropdown">
                <label for="tri">
                    <input class="text-box" type="text" id="tri" placeholder="Tri par : <?php if (isset($_GET['tri'])) {
                                                                                            echo $_GET['tri'];
                                                                                        } else  echo "Tri : Date-croissante";
                                                                                        ?>" readonly>
                    <div class="options">
                        <div><a href="nos-evenements.php?<?php echo http_build_query(array_merge($current_params, array('tri' => 'date croissante'))); ?>">Par
                                date croissante</a>
                        </div>
                        <div><a href="nos-evenements.php?<?php echo http_build_query(array_merge($current_params, array('tri' => 'date décroissante'))); ?>">Par
                                date décroissante</a></div>
                        <div><a href="nos-evenements.php?<?php echo http_build_query(array_merge($current_params, array('tri' => 'prix croissant'))); ?>">Par
                                prix croissant</a></div>
                        <div><a href="nos-evenements.php?<?php echo http_build_query(array_merge($current_params, array('tri' => 'prix décroissant'))); ?>">Par
                                prix décroissant</a></div>
                        <div><a href="nos-evenements.php?<?php echo http_build_query(array_merge($current_params, array('tri' => 'nouveauté'))); ?>">Par
                                nouveaux évènements</a></div>
                    </div>
                </label>
            </div>
            <div class="card-evenement">
                <?php if (empty($resultEvenements)) {
                    echo "<p>Malheureusement, aucun événement a été trouvés, essayez de changer vos filtres ou de réssayer plus tard.</p>";
                }
                foreach ($resultEvenements as $row) { ?>
                    <a href="detail-evenement.php?ID_Evenement=<?php echo $row['ID_Evenement'] ?>">

                        <div class="card-container">
                            <div class=" card-container_images">
                                <img src="./Images/Image_jeu/<?php echo $row["Image_Jeu"] ?>.jpg" alt="<?php echo $row["Nom"] ?>" />
                            </div>
                            <div class="card-content">
                                <p class="card-content_categorie"><?php echo $row['Categories'] ?></p>
                                <p class="card-content_date">
                                    <?php
                                    // Merci à Julp du forum OpenClassRoom pour avoir donné un code qui permettent de transformer une date en format numérique
                                    // en date, en format textuelle et française
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

                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</main>
<?php
include("footer.php");
?>