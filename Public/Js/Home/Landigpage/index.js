// /*menu con cambio de background*/
// const scrolling = () => {
//   const menuHeader = document.querySelector('.menuHeader');
//   let windowPosition = window.scrollY > 50
//   menuHeader.classList.toggle('activeScroll', windowPosition)
// }
// window.addEventListener('scroll', scrolling);

/*Cambio de imagen*/
// Obtén la referencia al elemento de imagen
// var imagen = document.querySelector('.headerImg');

// // Función para cambiar la imagen y establecer el ancho máximo
// function cambiarImagen() {
//   // Verifica el ancho de la pantalla
//   var screenWidth = window.innerWidth || document.documentElement.clientWidth;

//   if (screenWidth <= 1200) {
//     // Cambia el valor del atributo src
//     imagen.src = 'Public/Assets/Img/header2.png';

//     // Agrega una regla de estilo CSS para establecer max-width: 1200px
//     imagen.style.maxWidth = '1200px';
//   } else {
//     // Restablece la imagen original
//     imagen.src = 'Public/Assets/Img/header.svg';

//     // Restablece el estilo de max-width
//     imagen.style.maxWidth = '';
//   }
// }

// Ejecuta la función inicialmente
// cambiarImagen();

// // Agrega un listener al evento resize
// window.addEventListener('resize', cambiarImagen);


// /*menu*/
// const bars = document.querySelector(".bars");
const menuHeader = document.querySelector(".menuHeader");
const hamburger = document.querySelector(".hamburger");

hamburger.onclick = () => {
  hamburger.classList.toggle("is-active");
  menuHeader.classList.toggle("active");
}



//scroll reveal

// Espera a que el contenido HTML esté cargado
document.addEventListener('DOMContentLoaded', function (event) {
  // Inicializa ScrollReveal con las opciones deseadas
  const sr = ScrollReveal({
    duration: 1000,
    delay: 200,
    origin: 'bottom',
    distance: '20px',
    easing: 'ease-in-out',
    mobile: true
  });

  // Función para aplicar el efecto ScrollReveal a una clase específica
  function applyScrollReveal(className) {
    sr.reveal(className, {
      interval: 200, // Retraso entre la aparición de cada elemento
      reset: true // Reinicia las animaciones cuando el usuario vuelva a hacer scroll
    });
  }

  // Aplica el efecto ScrollReveal a las clases deseadas
  applyScrollReveal('.contentHeader');
  applyScrollReveal('.features');
  applyScrollReveal('.one');
  applyScrollReveal('.two');
  applyScrollReveal('.three');
  applyScrollReveal('.FQA');
  applyScrollReveal('.comments');
  applyScrollReveal('.containerComments');
  applyScrollReveal('.footerContact');
  // También puedes aplicarlo a otras clases llamando la función applyScrollReveal con la clase correspondiente
  // applyScrollReveal('.otraClase');
});

//acordion 
(function () {
  const accordionToggles = document.querySelectorAll('.js-accordionTrigger');
  const touchSupported = ('ontouchstart' in window);
  const pointerSupported = ('pointerdown' in window);

  const skipClickDelay = function (e) {
      e.preventDefault();
      e.target.click();
  };

  const setAriaAttr = function (el, ariaType, newProperty) {
      el.setAttribute(ariaType, newProperty);
  };

  const setAccordionAria = function (el1, el2, expanded) {
      switch (expanded) {
          case "true":
              setAriaAttr(el1, 'aria-expanded', 'true');
              setAriaAttr(el2, 'aria-hidden', 'false');
              break;
          case "false":
              setAriaAttr(el1, 'aria-expanded', 'false');
              setAriaAttr(el2, 'aria-hidden', 'true');
              break;
          default:
              break;
      }
  };

  const switchAccordion = function (e) {
      console.log("triggered");
      e.preventDefault();
      const thisAnswer = e.target.parentNode.nextElementSibling;
      const thisQuestion = e.target;
      const isCollapsed = thisAnswer.classList.contains('is-collapsed');

      setAccordionAria(thisQuestion, thisAnswer, isCollapsed ? 'true' : 'false');
      thisQuestion.classList.toggle('is-collapsed');
      thisQuestion.classList.toggle('is-expanded');
      thisAnswer.classList.toggle('is-collapsed');
      thisAnswer.classList.toggle('is-expanded');
      thisAnswer.classList.toggle('animateIn');
  };

  for (let i = 0; i < accordionToggles.length; i++) {
      if (touchSupported) {
          accordionToggles[i].addEventListener('touchstart', skipClickDelay, false);
      }
      if (pointerSupported) {
          accordionToggles[i].addEventListener('pointerdown', skipClickDelay, false);
      }
      accordionToggles[i].addEventListener('click', switchAccordion, false);
  }
})();

