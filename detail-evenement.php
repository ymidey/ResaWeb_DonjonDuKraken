<?php
include("header.php");

$evenement = $_GET['ID_Evenement'];

// Vérifiez si un message de succès doit être affiché
if (isset($_GET['success']) && $_GET['success'] == 'true') {
    echo '<div class="message message-succes">
            <p>L\'événement a été ajouté avec succès à votre panier !</p>
        </div>';
} else if (isset($_GET['error']) && $_GET['succes'] == 'false') {
    echo '<div class="message message-error">
            <p>Une erreur est survenue lors de l\'ajout de l\'événement dans votre panier</p>
        </div>';
};

// Vérifiez si un message d'erreur doit être affiché


$requeteDetailEvenement =
    " SELECT sae203_jeux.*, sae203_evenements.*, GROUP_CONCAT(sae203_categories.Nom_Categorie SEPARATOR ', ') AS Categories
FROM sae203_jeux
JOIN sae203_evenements ON sae203_jeux.ID_Jeu = sae203_evenements.ID_Jeu 
JOIN sae203_lien_jeuxcategories ON sae203_jeux.ID_Jeu = sae203_lien_jeuxcategories.ID_Jeu 
JOIN sae203_categories ON sae203_categories.ID_Categorie = sae203_lien_jeuxcategories.ID_Categorie
WHERE sae203_evenements.ID_Evenement = $evenement";

$stmt = $db->query($requeteDetailEvenement);
$resultEvenement = $stmt->fetchall(PDO::FETCH_ASSOC);

?>

<div class="evenement">
    <div class="evenement-header">
        <?php foreach ($resultEvenement as $row) { ?>
            <div class="evenement-img">
                <img src="./Images/Image_jeu/<?php echo $row['Image_Jeu'] ?>.jpg" alt="image du jeu <?php echo $row['Nom'] ?>">
            </div>
            <div class="evenement-text">
                <h1><?php echo $row['Titre'] ?></h1>
                <div class="evenement-attribut">
                    <p><span class="prix-evenement"><?php echo $row['Prix_Evenement'] ?></span>€ / par personne</p>
                    <p>À partir de <?php echo $row['Age_Recommande'] ?> ans</p>
                    <p><span class="nbPlaceMax"><?php echo $row['Nb_Place'] ?></span> places disponibles</p>
                </div>
                <h2>-- <?php
                        // Merci à Julp du forum OpenClassRoom pour avoir donné un code qui fonctionne 
                        $datefmt = new IntlDateFormatter('fr_FR', NULL, NULL, NULL, NULL,  'dd MMMM yyyy');
                        $date_evenement = date_create($row['Date_Evenement']);
                        echo $datefmt->format($date_evenement); ?>
                    à
                    <?php $heure = new DateTimeImmutable($row['Heure_Evenement']);
                    echo $heure->format('H\hi'); ?> --
                </h2>
                <h2><?php echo $row['Description'] ?></h2>
                <h2>Description du jeu</h2>

                <p><?php echo $row['Description_jeu'] ?></p>
                <div class="evenement-ajout">
                    <form action="ajout-panier.php" method="GET">
                        <div class="bloc-ajout-infos">
                            <label for="add-participant">Nombre de participants : </label>
                        </div>
                        <div>
                            <select name="add-participant" id="add-participant">
                                <?php for ($a = 1; $a <= $row['Nb_Place']; $a++) {
                                    if ($a == 1) {
                                ?>
                                        <option selected value="<?php echo $a ?>"><?php echo $a ?></option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?php echo $a ?>"><?php echo $a ?></option>
                                <?php
                                    }
                                } ?>
                            </select>
                            <input type="hidden" name="ID_Evenement" value="<?php echo $row['ID_Evenement'] ?>">

                            <button type="submit">Ajouter au panier</button>
                        </div>
                    </form>
                    <?php $prixTotalEvenement = $row['Prix_Evenement'] ?>
                    <p>Prix total : <span class="prix-total"><?php echo $prixTotalEvenement ?></span>
                        €</p>
                </div>
            </div>
    </div>
</div>

<?php }; ?>
</div>

<?php include("footer.php"); ?>