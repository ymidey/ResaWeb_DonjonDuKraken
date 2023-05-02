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


