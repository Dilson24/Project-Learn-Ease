/*menu con cambio de background*/
const scrolling = () => {
  const head = document.querySelector('.head');
  let windowPosition = window.scrollY > 50
  head.classList.toggle('active', windowPosition)
}
window.addEventListener('scroll', scrolling);

/*Cambio de imagen*/
// Obtén la referencia al elemento de imagen
var imagen = document.querySelector('.headerImg');

// Función para cambiar la imagen y establecer el ancho máximo
function cambiarImagen() {
  // Verifica el ancho de la pantalla
  var screenWidth = window.innerWidth || document.documentElement.clientWidth;

  if (screenWidth <= 1200) {
    // Cambia el valor del atributo src
    imagen.src = 'Public/Assets/Img/header2.png';

    // Agrega una regla de estilo CSS para establecer max-width: 1200px
    imagen.style.maxWidth = '1200px';
  } else {
    // Restablece la imagen original
    imagen.src = 'Public/Assets/Img/header2.svg';

    // Restablece el estilo de max-width
    imagen.style.maxWidth = '';
  }
}

// Ejecuta la función inicialmente
cambiarImagen();

// Agrega un listener al evento resize
window.addEventListener('resize', cambiarImagen);


/*menu*/
  // Obtén las referencias a los elementos
  var menuIcon = document.querySelector('.menuIcon');
  var menuHeader = document.querySelector('.menuHeader');

  // Agrega un evento click a menuIcon para mostrar/ocultar el menú
  menuIcon.addEventListener('click', function() {
    menuHeader.classList.toggle('show');
  });

