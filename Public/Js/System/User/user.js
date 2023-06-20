/*--- S I D E B A R ---*/
let btn = document.querySelector("#btn");
let sidebar = document.querySelector(".sidebar");
let searchBtn = document.querySelector(".bx-search");
let hamburger = document.querySelector(".hamburger");
btn.onclick = function () {
    hamburger.classList.toggle("is-active");
    sidebar.classList.toggle("active");
}
searchBtn.onclick = function () {
    sidebar.classList.toggle("active");
}
/*--- L O G - O U T ---*/ 
document.getElementById('log_out').addEventListener('click', function () {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                window.location.href = '../../../index.html';
            } else {

                console.error('Error al cerrar sesión');
            }
        }
    };
    xhr.open('GET', '../../../App/View/User/loguot.php', true);
});