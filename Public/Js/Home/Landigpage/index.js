/*--- M E N U ---*/
const menuHeader = document.querySelector(".menuHeader");
const hamburger = document.querySelector(".hamburger");
hamburger.onclick = () => {
  hamburger.classList.toggle("is-active");
  menuHeader.classList.toggle("active");
}

/*--- S C R O L L - R E V E A L ---*/
document.addEventListener('DOMContentLoaded', function (event) {
  const sr = ScrollReveal({
    duration: 1000,
    delay: 200,
    origin: 'bottom',
    distance: '20px',
    easing: 'ease-in-out',
    mobile: true
  });

  function applyScrollReveal(className) {
    sr.reveal(className, {
      interval: 200,
      reset: true
    });
  }

  applyScrollReveal('.contentHeader');
  applyScrollReveal('.features');
  applyScrollReveal('.one');
  applyScrollReveal('.two');
  applyScrollReveal('.three');
  applyScrollReveal('.FQA');
  applyScrollReveal('.comments');
  applyScrollReveal('.containerComments');
  applyScrollReveal('.footerContact');
});

/*--- A C C O R D I O N ---*/
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

/*--- E V E N T C L I C K  L O G O ---*/

  var logo = document.getElementById('logo');
      logo.addEventListener('click', function() {
       window.location.href = 'index.html';
  });
