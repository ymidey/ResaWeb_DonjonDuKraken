<?php
session_start();

// Vérifiez si le bouton de suppression du produit a été soumis
if (isset($_POST['supprimer-produit'])) {
    $indexProduit = $_POST['index-produit'];
    // Supprimer le produit du panier en utilisant l'indice
    if (isset($_SESSION['panier'][$indexProduit])) {
        unset($_SESSION['panier'][$indexProduit]);
        $_SESSION['panier'] = array_values($_SESSION['panier']); // Réorganiser les indices du tableau

        // Rediriger l'utilisateur vers la page panier.php ou une autre page après suppression du produit
        header("Location: panier.php");
        exit();
    }
} // S'il n'a pas été soumis, cela veut dire que notre utilisateur souhaite supprimer complètement son panier 
else {
    // Je vide donc le tableau panier de ma variable de session
    unset($_SESSION['panier']);
    header("Location: panier.php");
    exit();
}
