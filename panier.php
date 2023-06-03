<?php
include('header.php');

if (isset($_GET['success']) && $_GET['success'] == 'true') {
    echo '<div class="message message-succes">
            <p> Votre commande a bien été réalisée, vous recevrez votre ticket sur l\'adresse mail, que vous nous avez communiqué !</p>
        </div>';
}
// Vérifiez si le panier existe dans la session
if (isset($_SESSION['panier']) && count($_SESSION['panier']) > 0) {
    $panier = $_SESSION['panier'];
    $prixTotalReservation = 0;

?>

<main>
    <div class="panier">
        <h1 class="title-card"><span>Récapitulatif de la commande</span><span>Votre panier
                contient <?php echo count($panier); ?> événements</span></h1>

        <div class="panier-content">
            <table>
                <caption>Votre panier</caption>

                <thead>
                    <tr>
                        <th>Réf-événement</th>
                        <th>Événement</th>
                        <th>Desription</th>
                        <th>Prix unitaire</th>
                        <th>Nombre de participants</th>
                        <th>Prix total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($panier as $index => $evenement) { ?>
                    <tr>
                        <td class="td-number" id="id-evenement"><?php echo $evenement["id_Evenement"]; ?></td>
                        <td><?php echo $evenement['nomEvenement']; ?></td>
                        <td><?php echo $evenement['description']; ?></td>
                        <td class="td-number prix-evenement"><?php echo $evenement['prixEvenement']; ?>€</td>
                        <td class="td-number">
                            <select name="add-participant[<?php echo $index; ?>]" class="add-participant">
                                <?php for ($a = 1; $a <= $evenement['maxParticipant']; $a++) {
                                            if ($a == $evenement['nombreParticipants']) {
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
                        </td>
                        <td class="td-number">

                            <?php $prixTotalEvenement = $evenement['prixEvenement'] * $evenement['nombreParticipants']; ?>
                            <p><span class="prix-total" data-index="<?php echo $index; ?>"
                                    data-prixEvenement="<?php echo $evenement['prixEvenement']; ?>"><?php echo $prixTotalEvenement ?></span>
                                €</p>

                        </td>
                        <td>
                            <form class="form-delete-produit" action="delete-produit-panier.php" method="POST"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit du panier ?');">
                                <input type="hidden" name="index-produit" value="<?php echo $index; ?>"></input>
                                <button type="submit" name="supprimer-produit"><img src="./Images/trash.svg"
                                        alt="Supprimer l'événement" title="Supprimer l'événement"></button>
                            </form>
                        </td>
                    </tr>

                    <?php $prixTotalReservation += $prixTotalEvenement;
                            // Ici je supprime la valeur 'maxParticipant' de mon tableau car, je n'en ai plus besoin
                            unset($evenement['maxParticipant']);
                        } ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5">Prix total de votre commande : </th>
                        <td colspan="1">
                            <p><span class="prix-totalReservation"><?php echo $prixTotalReservation ?></span> €</p>
                        </td>
                        <td>
                            <button type="submit" class="btn-open-modal-panier">Validez la commande</button>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <!-- div contenant les mentions légales du site web. Elle est d'abord caché puis devient visible, si l'utilisateur clique sur l'un des deux paragraphes avec la class=" legals"-->
            <div class="reservinfo modal-invisible">
                <h1>Passez commandes</h1>
                <!-- Paragraphe permettant la fermeture du modal contenant les mentions légales -->
                <p class="closeReservInfo"></p>
                <p>Prix total de votre commande : <span
                        class="prix-totalReservation"><?php echo $prixTotalReservation ?></span> €</p>
                <form action="ajout-reservation.php" class="form-reservation" method="post">
                    <input type="hidden" name="prixtotal" id="prixtotal" value="">
                    <input type="hidden" name="nb_participant_par_evenement" id="nb_participant_par_evenement" value="">
                    <label for=" nom">Votre nom</label>
                    <input type="text" name="nom" id="nom" required>
                    <label for="prenom">Votre prénom</label>
                    <input type="text" name="prenom" id="prenom" required>
                    <label for="email">Votre adresse email</label>
                    <input type="email" name="email" id="email" required>
                    <button type="submit" class="btn-reserv-submit">Valider votre/vos réservation(s)</button>
                </form>
            </div>

        </div>
        <form action="delete-produit-panier.php" method="POST" class="form-delete-panier"
            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer tout les événements de votre panier ?');">
            <button type="submit" name="supprimer-panier" class="btn-delete-panier">Supprimer le panier</button>
        </form>

    </div>
    <?php
} else {
    echo "<div class='panier'><h1>Oups... Votre panier est vide.</h1><a href='nos-evenements.php'>Commencer mes achats</a></div>";
}
    ?>

</main>
<?php include('footer.php'); ?>