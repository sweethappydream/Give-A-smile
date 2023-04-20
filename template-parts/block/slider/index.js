(function($) {
  var initializeBlock = function() {
    const bannerSlider = document.querySelectorAll('.js-banner-slider');

    if (bannerSlider.length) {
      bannerSlider.forEach(slider => {
        new Swiper(slider, {
          effect: 'fade',
          fadeEffect: {
            crossFade: true
          },
		keyboard: {
   		enabled: true,
 			},
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
          },
			a11y: {
    	 prevSlideMessage: "Previous Slide",
                nextSlideMessage: "Next Slide",
                firstSlideMessage: "This is the first Slide",
                lastSlideMessage: "This is the last Slide",
                paginationBulletMessage: "Go to slide {{index}}"
  			},
        })
      });
    }
  }
  $(document).ready(function() {
    initializeBlock();
  });
  if (window.acf) {
    window.acf.addAction('render_block_preview/type=smile-slider', initializeBlock);
  }
})(jQuery);