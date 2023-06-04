// J'attends que ma page soit complétement chargée
document.addEventListener("DOMContentLoaded", function () {

    // Je récupère l'url de la page de mon navigateur
    var currentURL = window.location.href;

    // Je vérifie si je suis sur ma page index ou sur ma page accueil.php
    if (currentURL === "" || currentURL.endsWith("/") || currentURL.includes("accueil.php")) {

        // Réalisation du carroussel sans plugin
        const scroll_left = document.getElementsByClassName("btn-left")[0];
        const scroll_right = document.getElementsByClassName("btn-right")[0];
        const scrollContainer = document.querySelector(".card");

        // au clic sur le bouton droit 'btn-right' je déplace mon slider vers la droite
        scroll_right.addEventListener("click", function () {
            scrollContainer.scrollLeft += 400;
        })

        // au clic sur le bouton gauche 'btn-left' je déplace mon slider vers la gauche
        scroll_left.addEventListener("click", function () {
            scrollContainer.scrollLeft -= 400;
        })


        // Réalisation du carroussel à l'aide du plugin OwlCarousel
        $('.owl-carousel').owlCarousel({

            loop: true,

            margin: 10,

            nav: false,

            dots: false,

            responsive: {

                0: {

                    items: 1

                },

                800: {

                    nav: true,

                    items: 3

                },

                1100: {

                    items: 5,

                    nav: true

                }

            }

        })


    }

    // Je vérifie si je suis sur ma page nos-evenements.php
    else if (currentURL.includes("nos-evenements.php")) {
        let dropdown = document.querySelector(".dropdown");
        // J'ajoute la classe "active" à mon dropdown au clic
        dropdown.onclick = function (event) {
            dropdown.classList.toggle("active");
        };

        document.addEventListener("click", function (event) {
            // Vérifie si l'élément cliqué n'est pas le menu déroulant ou l'un de ses enfants
            if (!dropdown.contains(event.target)) {
                dropdown.classList.remove("active");
            }
        });
    }

    // Je vérifie si je suis sur ma page detail-evenement.php
    else if (currentURL.includes("detail-evenement.php")) {

        // Ce script permet de mettre à jour dynamiquement le prix total en fonction du nombre de participants sélectionné, lorsqu'un changement de valeur est détecté sur l'élément "add-participant".
        var nbParticipant = document.querySelector('#add-participant');
        var prixTotal = document.querySelector('.prix-total');
        var prixEvenementInput = document.querySelector('.prix-evenement');

        nbParticipant.addEventListener('change', function () {
            var NbParticipant = parseInt(nbParticipant.value);
            var prixEvenement = parseInt(prixEvenementInput.innerHTML);
            prixTotal.innerHTML = NbParticipant * prixEvenement;
        });
    }

    // Je vérifie si je suis sur ma page panier.php
    else if (currentURL.includes("panier.php")) {

        // Ce script permet de changer la valeur de mes divs ayant la class 'prix-totalReservation' et 'prix-total'
        // quand la valeur d'un des selects situé dans mes selects ayant la classe 'add-participant' changent. 
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

        // Ce script ouvre un modal de réservation après le clic sur un bouton. Il récupère également les données des prix totaux de chaque événement et les organisent dans un tableau JSON, met à jour des valeurs dans un formulaire
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
})