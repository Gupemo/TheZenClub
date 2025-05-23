document.addEventListener('DOMContentLoaded', () => {
  const toggle = document.querySelector('.nav__toggle');
  const menu = document.querySelector('.nav__menu');

  // toggle para abrir/cerrar el menu
  toggle.addEventListener('click', (e) => {
    e.stopPropagation(); 
    menu.classList.toggle('nav__menu--active');
  });

  document.addEventListener('click', (e) => {
    // evento para cerrar el menu al hacer click o tocar fuera del menu
    if (
      menu.classList.contains('nav__menu--active') && 
      !menu.contains(e.target) && 
      !toggle.contains(e.target)
    ) {
      menu.classList.remove('nav__menu--active');
    }
  });
});
