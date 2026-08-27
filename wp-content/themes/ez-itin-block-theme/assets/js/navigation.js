(() => {
  'use strict';
  const menu = document.querySelector('.wp-block-navigation__responsive-container');
  if (!menu) return;
  menu.setAttribute('aria-label', 'Primary navigation');
})();
