$(document).ready(function () {
    document.querySelectorAll(".btn-close").forEach(function (btn) {
        btn.addEventListener("click", function () {
            document.querySelector(".navbar-collapse").classList.remove("show");
        });
    });
});
