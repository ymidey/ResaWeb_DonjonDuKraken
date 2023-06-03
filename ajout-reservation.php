<?php
include('connexion.php');
session_start();

if (isset($_SESSION['panier']) && count($_SESSION['panier']) > 0) {
  $panier = $_SESSION['panier'];

  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $prixTotal = $_POST['prixtotal'];
  $participantsData = $_POST['nb_participant_par_evenement'];
  $participantsArray = json_decode($participantsData, true);

  // Insére les données dans la table "sae203_reservations"
  $InsertReservation = "INSERT INTO sae203_reservations (Nom_Client, Prenom_Client, Adressemail_Client, PrixTotal, Date_Reservation) VALUES ('$nom', '$prenom', '$email', '$prixTotal', NOW())";
  $stmt = $db->exec($InsertReservation);

  // Récupérer l'id de réservation généré
  $idReservation = $db->lastInsertId();

  // Récupérer les ID des événements et le nombre de participants depuis le panier
  $evenementsReservation = array();
  foreach ($participantsArray as $evenement) {
    $idEvenement = $evenement['id_evenement'];
    $nombreParticipants = $evenement['participants'];
    $evenementsReservation[] = "($idReservation, $idEvenement, $nombreParticipants)";
  }

  // Insérer les données dans la table "sae203_lien_evenementsreservations"
  if (!empty($evenementsReservation)) {
    $values = implode(", ", $evenementsReservation);
    $InsertLienEvenementsReservation = "INSERT INTO sae203_lien_evenementsreservations (ID_Reservation, ID_Evenement, Nb_participant) VALUES $values";
    $stmt = $db->exec($InsertLienEvenementsReservation);
  }

  // On vide le panier
  $_SESSION['panier'] = array();
  $dateJour = time();
  $counter = 0;
  // Envoi de l'e-mail
  $subject = "Votre reçu de commande passé le $dateJour !";
  $message = "<html>
  <head>
    <title>Reçu de commande</title>
  </head>
  <body>
    <h1>Merci pour votre achat auprès du Donjon du Kraken !</h1>
    <h2 style='font-style:bold;'>Bonjour $nom $prenom</h2>
    <p>Numéro de facture $idReservation</p>
    <table>
      <caption>Informations sur votre commande</caption>
      <thead>
        <tr>
          <th style='padding: 2px'>Réf. événement</th>
          <th style='padding: 2px'>Nom événement</th>
          <th style='padding: 2px'>Prix de la place </th>
          <th style='padding: 2px'>Nombre participant</th>
          <th style='padding: 2px'>Date événement</th>
        </tr>
      </thead>
      <tbody>";
  $counter = 0;
  foreach ($participantsArray as $evenement) {
    $DateEvenement = $panier[$counter]['date_evenement'];
    $TitreEvenement = $panier[$counter]['nomEvenement'];
    $prixEvenement = $panier[$counter]['prixEvenement'];

    $idEvenement = $evenement['id_evenement'];
    $nombreParticipants = $evenement['participants'];
    $prixTotalEvenement = $nombreParticipants * $prixEvenement;

    $message .= "<tr>
    <td>$idEvenement</td>
    <td>$TitreEvenement</td>
        <td>$prixEvenement</td>
    <td> $nombreParticipants</td>
<td>$prixTotalEvenement</td>
    <td>$DateEvenement</td>
  </tr>";
    $counter += 1;
  }

  $message .= "</tbody>
  </table>
</body>
</html>";

  $headers[] = 'MIME-Version: 1.0';
  $headers[] = 'Content-type: text/html; charset=iso-8859-1';
  $headers[] = "From: midey.yannick@resaweb.midey.butmmi.o2switch.site";
  mail($email, $subject, $message, implode("\r\n", $headers));
}


<html>
  <head>
    <title>Reçu de commande</title>
  </head>
  <body>
    <h1 style="text-align: center;">Merci pour votre achat auprès du Donjon du Kraken !</h1>
    <h2 style="text-align: center; font-weight: bold;">Bonjour $nom $prenom</h2>
    <p style="text-align: center;">Numéro de facture $idReservation</p>
    <table style="margin: 0 auto;">
      <caption style="text-align: center; font-weight: bold;">Informations sur votre commande</caption>
      <thead>
        <tr>
          <th style="padding: 5px;">Réf. événement</th>
          <th style="padding: 5px;">Nom événement</th>
          <th style="padding: 5px;">Prix de la place</th>
          <th style="padding: 5px;">Nombre de participants</th>
          <th style="padding: 5px;">Prix total de l'événement</th>
          <th style="padding: 5px;">Date de l'événement</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $counter = 0;
        foreach ($participantsArray as $evenement) {
          $DateEvenement = $panier[$counter]['date_evenement'];
          $TitreEvenement = $panier[$counter]['nomEvenement'];
          $prixEvenement = $panier[$counter]['prixEvenement'];

          $idEvenement = $evenement['id_evenement'];
          $nombreParticipants = $evenement['participants'];
          $prixTotalEvenement = $nombreParticipants * $prixEvenement;

          echo "<tr>
            <td style='padding: 5px;'>$idEvenement</td>
            <td style='padding: 5px;'>$TitreEvenement</td>
            <td style='padding: 5px;'>$prixEvenement</td>
            <td style='padding: 5px;'>$nombreParticipants</td>
            <td style='padding: 5px;'>$prixTotalEvenement</td>
            <td style='padding: 5px;'>$DateEvenement</td>
          </tr>";

          $counter += 1;
        }
        ?>
</tbody>
</table>
</body>

</html>