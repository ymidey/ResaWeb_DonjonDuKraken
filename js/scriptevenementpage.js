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

