document.addEventListener('DOMContentLoaded', function () {

  if ( document.querySelector('.wrapper') ) {
    document.querySelector('.wrapper').classList.add('_loaded');
  }

  // Langs

  const langsCurrent = document.querySelector('.langs__current');

  langsCurrent.addEventListener('click', function () {
    const parentElemen = this.parentElement;

    if ( parentElemen.classList.contains('active') ) {
      parentElemen.classList.remove('active');
    } else {
      parentElemen.classList.add('active');
    }
  });

  document.addEventListener('mouseup', function (event) {
    const target = event.target;

    if ( !target.closest('langs') ) {
      document.querySelector('.langs').classList.remove('active');
    }
  });

  // Copy

  const $resForm = document.querySelector('.unsimple');
  const copy = `
    <a href="https://unsimpleworld.com" rel="dofollow" title="Website development / Разработка сайта Unsimple World" target="_blank" class="footer__logo unsimple">
      <img src="img/logos/unsimple.png" alt="Website development / Разработка сайта Unsimple World">
    </a>
  `;

  $resForm || document.querySelector('.footer .content-area').insertAdjacentHTML('beforeend', copy);
  
});