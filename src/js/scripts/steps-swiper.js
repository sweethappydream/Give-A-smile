(function($) {
    var initializeSvgSwiper = function() {
      const selectswiper = document.querySelectorAll('.select-panel .slider-panel');
  
      if (selectswiper.length) {
        selectswiper.forEach(slider => {
          new Swiper(slider, {
            slidesPerView: 4,
                        spaceBetween: 30,
            pagination: {
              el: ".swiper-pagination",
              clickable: true,
            },
            keyboard: {
    enabled: true,
    onlyInViewport: false,
  },
            breakpoints: {
                            360: {
                                slidesPerView: 1.5,
                                spaceBetween: 20
                            },
                            640: {
                                slidesPerView: 2.5,
                                spaceBetween: 20
                            },
                            768: {
                                slidesPerView: 3,
                                spaceBetween: 30
                            },
                            1024: {
                                slidesPerView: 4,
                                spaceBetween: 30
                            }
                        }
          })
        });
      }
    }
    $(document).ready(function() {
      initializeSvgSwiper();
    });
    
  })(jQuery);