const scroll_left = document.getElementsByClassName("btn-left")[0];
const scroll_right = document.getElementsByClassName("btn-right")[0];

const scrollContainer = document.querySelector(".card");

scroll_right.addEventListener("click", function () {
    scrollContainer.scrollLeft += 200
})

scroll_left.addEventListener("click", function () {
    scrollContainer.scrollLeft -= 200
})


document.addEventListener('DOMContentLoaded', () => {
    const triLinks = document.querySelectorAll('.tri a');
    triLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const tri = e.target.getAttribute('data-tri');
            window.location.href = `nos-evenements.php?tri=${tri}`;
        });
    });
});
