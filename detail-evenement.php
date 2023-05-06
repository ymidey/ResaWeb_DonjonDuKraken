<?php
include("header.php");

$evenement = $_GET['ID_Evenement'];
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
    <?php foreach ($resultEvenement as $row) { ?>
    <div class="evenement-img">
        <img src="Images/Image_jeu/<?php echo $row['Image_Jeu'] ?>" alt="image du jeu <?php echo $row['Nom'] ?>">
    </div>
    <div class=" evenement-text">
        <h1><?php echo $row['Titre'] ?></h1>
        <h2>Jeu : <?php echo $row['Nom'] ?></h2>
        <p><?php echo $row['Categories'] ?></p>
        <div class="evenement-attribut">
            <p><?php
                // Merci à Julp du forum OpenClassRoom pour avoir donné un code qui fonctionne 
                $datefmt = new IntlDateFormatter('fr_FR', NULL, NULL, NULL, NULL,  'dd MMMM yyyy');
                $date_evenement = date_create($row['Date_Evenement']);
                echo $datefmt->format($date_evenement); ?>
                à
                <?php $heure = new DateTimeImmutable($row['Heure_Evenement']);
                echo $heure->format('H\hi'); ?>
            </p>
            <p><?php echo $row['Prix_Evenement'] ?>€ / par personne</p>
            <p>À partir de <?php echo $row['Age_Recommande'] ?> ans</p>
        </div>
        <h3>Description</h3>
        <p><?php echo $row['Description_jeu'] ?></p>
        <button id="btnModal" class="btnReserve">Réserver</button>
    </div>
    <?php }; ?>

</div>