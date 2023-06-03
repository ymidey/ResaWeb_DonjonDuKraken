var currentURL = window.location.href;

if (currentURL === "" || currentURL.endsWith("/") || currentURL.includes("accueil.php")) {
    document.addEventListener("DOMContentLoaded", function () {
        const scroll_left = document.getElementsByClassName("btn-left")[0];
        const scroll_right = document.getElementsByClassName("btn-right")[0];
        const scrollContainer = document.querySelector(".card");

        scroll_right.addEventListener("click", function () {
            scrollContainer.scrollLeft += 200
        })

        scroll_left.addEventListener("click", function () {
            scrollContainer.scrollLeft -= 200
        })

    })
}

else if (currentURL.includes("nos-evenements.php")) {
    document.addEventListener("DOMContentLoaded", function () {
        let dropdown = document.querySelector(".dropdown");
        dropdown.onclick = function (event) {
            dropdown.classList.toggle("active");
        };

        document.addEventListener("click", function (event) {
            // Vérifie si l'élément cliqué n'est pas le menu déroulant ou l'un de ses enfants
            if (!dropdown.contains(event.target)) {
                dropdown.classList.remove("active");
            }
        });
    });
}

else if (currentURL.includes("panier.php")) {
    var selectParticipants = document.querySelectorAll('.add-participant');

    selectParticipants.forEach(function (selectParticipant) {
        selectParticipant.addEventListener('change', function () {

            var participant = parseInt(selectParticipant.value);
            var rowIndex = selectParticipant.getAttribute('name').match(/\[(.*?)\]/)[1];
            var prixEvenementTotal = document.querySelector('.prix-total[data-index="' + rowIndex + '"]');
            var prixEvenement = parseInt(prixEvenementTotal.getAttribute('data-prixEvenement'));
            var prixTotal = prixEvenement * participant;
            prixEvenementTotal.innerHTML = prixTotal;

            var prixTotalReservations = document.querySelectorAll('.prix-totalReservation');
            var prixEvenementTotals = document.querySelectorAll('.prix-total');
            var totalReservation = 0;

            prixEvenementTotals.forEach(function (prixEvenementTotal) {
                totalReservation += parseInt(prixEvenementTotal.innerHTML);
            });

            prixTotalReservations.forEach(function (prixTotalReservation) {
                prixTotalReservation.innerHTML = totalReservation;
            });

        });
    });
    var submitModal = document.querySelector(".btn-open-modal-panier")
    submitModal.addEventListener("click", function () {
        var prixTotal = document.querySelector('.prix-totalReservation').textContent;
        document.getElementById('prixtotal').value = prixTotal;

        let arrayParticipantEvenement = [];
        var nbParticipantsParEvenement = document.querySelectorAll('.add-participant');

        nbParticipantsParEvenement.forEach(function (nbParticipantParEvenement) {
            let idEvenement = nbParticipantParEvenement.closest('tr').querySelector('#id-evenement').textContent;
            let nombreParticipants = nbParticipantParEvenement.value;
            arrayParticipantEvenement.push({ id_evenement: idEvenement, participants: nombreParticipants });
        });

        // Convertir le tableau en chaîne JSON
        let jsonValue = JSON.stringify(arrayParticipantEvenement);

        // Ajouter la valeur JSON à l'input du formulaire
        let inputField = document.getElementById('nb_participant_par_evenement');
        inputField.value = jsonValue;

        const modal = document.querySelector('.reservinfo');
        modal.classList.remove("modal-invisible");
        modal.classList.add("modal-visible");
    });

    /* Code permettant de retirer la class "modal-visible" et d'ajouter la class "modal-invisible" a la div ayant la class "mentions_legales" afin de rendre la div contenant mon modal invisible, si un clique est effectué sur le bouton ayant la class "closeMentionsLegals" */
    var closeMentionsLegales = document.querySelector(".closeReservInfo");
    closeMentionsLegales.addEventListener("click", function () {
        const modal = document.querySelector('.reservinfo');
        modal.classList.remove("modal-visible");
        modal.classList.add("modal-invisible");
    });
}

else if (currentURL.includes("detail-evenement.php")) {
    var nbParticipant = document.querySelector('#add-participant');
    var prixTotal = document.querySelector('.prix-total');
    var prixEvenementInput = document.querySelector('.prix-evenement');

    nbParticipant.addEventListener('change', function () {
        var NbParticipant = parseInt(nbParticipant.value);
        var prixEvenement = parseInt(prixEvenementInput.innerHTML);
        prixTotal.innerHTML = NbParticipant * prixEvenement;
    });


}