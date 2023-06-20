<?php
include('connexion.php');
session_start();

// Vérifiez si le formulaire a été soumis et que les données sont présentes
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['add-participant']) && isset($_GET['ID_Evenement'])) {

    // Récupérez les données du formulaire
    $nombreParticipants = $_GET['add-participant'];
    $IdEvenement = $_GET['ID_Evenement'];

    // Requête préparée pour récupérer les informations d'un événement spécifique à partir de son ID
    $infoEvenement = "SELECT * FROM sae203_evenements WHERE ID_Evenement = :idEvenement";
    $stmtInfoEvenement = $db->prepare($infoEvenement);
    $stmtInfoEvenement->bindParam(':idEvenement', $IdEvenement);
    $stmtInfoEvenement->execute();
    $resultInfoEvenement = $stmtInfoEvenement->fetch(PDO::FETCH_ASSOC);

    // Ajoute toutes les informations de l'événement dans un tableau $evenement
    $evenement = [
        'id_Evenement' => $resultInfoEvenement['ID_Evenement'],
        'nombreParticipants' => $nombreParticipants,
        'description' => $resultInfoEvenement['Description'],
        'date_evenement' => $resultInfoEvenement['Date_Evenement'],
        'heure_evenement' => $resultInfoEvenement['Heure_Evenement'],
        'nomEvenement' => $resultInfoEvenement['Titre'],
        'prixEvenement' => $resultInfoEvenement['Prix_Evenement'],
        'maxParticipant' => $resultInfoEvenement['Nb_Place']
    ];

    // Ajoutez l'événement au panier dans la variable de session
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array(); // Initialisez le panier s'il n'existe pas encore
    }

    $_SESSION['panier'][] = $evenement; // Ajoutez l'événement au panier

    // Redirigez l'utilisateur vers la page du panier ou affichez un message de succès
    header("Location: detail-evenement.php?ID_Evenement=$IdEvenement&success=true");
    exit();
} else {
    // Redirigez l'utilisateur sur la page detail-evenement en affichant un message d'erreur
    header("Location: detail-evenement.php?ID_Evenement=$IdEvenement&succes=false");
    exit();
}
