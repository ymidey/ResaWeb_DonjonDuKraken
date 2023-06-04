<?php
include('connexion.php');
session_start();

// Vérifiez si le tableau panier existe dans la variable de session et qu'il n'est pas vide
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

  // Ici, on récupère le nouvelle ID généré lors de la précédante requête
  $idReservation = $db->lastInsertId();

  $evenementsReservation = array();
  // Récupérer les ID des événements et le nombre de participants depuis le panier
  foreach ($participantsArray as $evenement) {
    $idEvenement = $evenement['id_evenement'];
    $nombreParticipants = $evenement['participants'];
    $evenementsReservation[] = "($idReservation, $idEvenement, $nombreParticipants)";
  }

  // On insére les données dans la table "sae203_lien_evenementsreservations" si la variable $evenementsReservation n'est pas vide
  if (!empty($evenementsReservation)) {
    $values = implode(", ", $evenementsReservation);
    $InsertLienEvenementsReservation = "INSERT INTO sae203_lien_evenementsreservations (ID_Reservation, ID_Evenement, Nb_participant) VALUES $values";
    $stmt = $db->exec($InsertLienEvenementsReservation);
  }

  // On vide le panier
  $_SESSION['panier'] = array();
  $dateJour = date("d/m/Y");;
  $counter = 0;
  // Envoi de l'e-mail
  $subject = "Votre reçu de commande passé le $dateJour !";

  // Structure du message de l'email
  $message = "<html>
  <head>
    <title>Reçu de commande</title>
  </head>
  <body>
    <h1 style='text-align: center;'>Merci pour votre achat auprès du Donjon du Kraken !</h1>
    <h2 style='text-align: center; font-weight: bold;'>Bonjour $nom $prenom</h2>
    <h3 style='text-align: center;'>Numéro de facture n°$idReservation - Prix total de la commande : $prixTotal € </h3>
    <table style='margin: 0 auto;'>
      <caption style='text-align: center; font-weight: bold;'>Informations sur votre commande</caption>
      <thead>
        <tr style='borderborder: 1px solid black;
  border-collapse: collapse;>
          <th style='padding: 5px; borderborder: 1px solid black;
  border-collapse: collapse;'>Réf. événement</th>
          <th style='padding: 5px; borderborder: 1px solid black;
  border-collapse: collapse;'>Nom de l'événement</th>
          <th style='padding: 5px; borderborder: 1px solid black;
  border-collapse: collapse;'>Prix de la place</th>
          <th style='padding: 5px; borderborder: 1px solid black;
  border-collapse: collapse;'>Nombre de participants</th>
          <th style='padding: 5px; borderborder: 1px solid black;
  border-collapse: collapse;'>Prix total de l'événement</th>
          <th style='padding: 5px; borderborder: 1px solid black;
  border-collapse: collapse;'>Date de l'événement</th>
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
    <td style='padding: 5px; borderborder: 1px solid black;
  border-collapse: collapse;'>$idEvenement</td>
    <td style='padding: 5px; borderborder: 1px solid black;
  border-collapse: collapse;'>$TitreEvenement</td>
        <td style='padding: 5px; borderborder: 1px solid black;
  border-collapse: collapse;'>$prixEvenement €</td>
    <td style='padding: 5px; borderborder: 1px solid black;
  border-collapse: collapse;'>$nombreParticipants</td>
<td style='padding: 5px; borderborder: 1px solid black;
  border-collapse: collapse;'>$prixTotalEvenement €</td>
    <td style='padding: 5px; borderborder: 1px solid black;
  border-collapse: collapse;'>$DateEvenement</td>
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
  header('Location: panier.php?success=true');
}
// Si le panier n'existe pas ou est vide, on retourne une erreur au visiteur
else {
  header('Location: panier.php?success=false');
}
