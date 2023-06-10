//SIDEBAR
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

document.getElementById('log_out').addEventListener('click', function () {
    // Realizar una solicitud AJAX o redirigir directamente a un archivo PHP que cierre la sesión
    // y luego redirigir a la página principal
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Redirigir a la página principal
                window.location.href = '../../../index.html';
            } else {
                // Manejar cualquier error de solicitud
                console.error('Error al cerrar sesión');
            }
        }
    };
    xhr.open('GET', '../../../App/View/User/loguot.php', true); // Reemplaza 'logout.php' con el nombre real del archivo que cierra la sesión
    xhr.send();
});

