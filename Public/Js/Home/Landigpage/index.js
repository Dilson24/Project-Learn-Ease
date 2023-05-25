// /*menu con cambio de background*/
// const scrolling = () => {
//   const menuHeader = document.querySelector('.menuHeader');
//   let windowPosition = window.scrollY > 50
//   menuHeader.classList.toggle('activeScroll', windowPosition)
// }
// window.addEventListener('scroll', scrolling);

/*Cambio de imagen*/
// Obtén la referencia al elemento de imagen
var imagen = document.querySelector('.headerImg');

// Función para cambiar la imagen y establecer el ancho máximo
function cambiarImagen() {
  // Verifica el ancho de la pantalla
  var screenWidth = window.innerWidth || document.documentElement.clientWidth;

  if (screenWidth <= 1200) {
    // Cambia el valor del atributo src
    imagen.src = 'Public/Assets/Img/header2-1.png';

    // Agrega una regla de estilo CSS para establecer max-width: 1200px
    imagen.style.maxWidth = '1200px';
  } else {
    // Restablece la imagen original
    imagen.src = 'Public/Assets/Img/header.svg';

    // Restablece el estilo de max-width
    imagen.style.maxWidth = '';
  }
}

// Ejecuta la función inicialmente
cambiarImagen();

// Agrega un listener al evento resize
window.addEventListener('resize', cambiarImagen);


// /*menu*/
// const bars = document.querySelector(".bars");
const menuHeader = document.querySelector(".menuHeader");
const hamburger = document.querySelector(".hamburger");

hamburger.onclick = () => {
  hamburger.classList.toggle("is-active");
  menuHeader.classList.toggle("active");
}



