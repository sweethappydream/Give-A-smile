(function($) {
    var initializeBlock = function() {
        const sliders = document.querySelectorAll('.class-slider-quotes .swiper-container');

        if (sliders.length) {
            sliders.forEach(slider => {
                const swiper = new Swiper(slider, {
                    direction: 'vertical',
                    loop:true,
                    slidesPerView: 2, // Display 2 slides at a time
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                      },
                    keyboard: {
                        enabled: true,
                    },
                    a11y: {
                        prevSlideMessage: 'Previous Slide',
                        nextSlideMessage: 'Next Slide',
                        firstSlideMessage: 'This is the first Slide',
                        lastSlideMessage: 'This is the last Slide',
                        paginationBulletMessage: 'Go to slide {{index}}'
                    }
                });
            });
        }
    };

    $(document).ready(function() {
        initializeBlock();
    });

    if (window.acf) {
        window.acf.addAction('render_block_preview/type=slider-love-us', initializeBlock);
    }
})(jQuery);
