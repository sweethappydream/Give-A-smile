(function($) {
  var initializeBlock = function() {
    const partnersSlider = document.querySelectorAll('.js-partners-slider');

    if (partnersSlider.length) {

      partnersSlider.forEach(slider => {
        const nextArrow = slider.querySelector('.swiper-button-next');
        const prevArrow = slider.querySelector('.swiper-button-prev');
        new Swiper(slider, {
          slidesPerView: 2.5,
          spaceBetween: 10,
          navigation: {
            nextEl: nextArrow,
            prevEl: prevArrow,
          },
          freeMode: {
            enabled: true,
            sticky: true,
          },
          breakpoints: {
            360: {
              slidesPerView: 2.5,
              spaceBetween: 10,
              navigation: false,
            },
            640: {
              slidesPerView: 3.5,
              spaceBetween: 20,
              navigation: false,
            },
            768: {
              slidesPerView: 4,
              spaceBetween: 30,
              freeMode: false,
            },
            1024: {
              slidesPerView: 5,
              spaceBetween: 30,
              freeMode: false,
            },
          },
        })
      });
    }

  }
  $(document).ready(function() {
    initializeBlock();
  });
  if (window.acf) {
    window.acf.addAction('render_block_preview/type=smile-partners', initializeBlock);
  }
})(jQuery);