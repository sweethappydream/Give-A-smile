(function($) {
    var initializeBlock = function() {
        const quotesSlider = document.querySelectorAll('.quotes-slider .swiper-container');

        if (quotesSlider.length) {
            quotesSlider.forEach(slider => {
                const swiper = new Swiper(slider, {
                    // Swiper configuration options
                    loop:true,
                    effect: "creative",
                    creativeEffect: {
                      prev: {
                        shadow: true,
                        translate: ["-120%", 0, -500],
                      },
                      next: {
                        shadow: true,
                        translate: ["120%", 0, -500],
                      },
                    },
                    keyboard: {
                        enabled: true,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    a11y: {
                        prevSlideMessage: 'Previous Slide',
                        nextSlideMessage: 'Next Slide',
                        firstSlideMessage: 'This is the first Slide',
                        lastSlideMessage: 'This is the last Slide',
                        paginationBulletMessage: 'Go to slide {{index}}'
                    }
                });

                // Add event listeners for next and previous buttons
                const nextButton = slider.querySelector('.swiper-button-next');
                const prevButton = slider.querySelector('.swiper-button-prev');

                nextButton.addEventListener('click', function() {
                    swiper.slideNext();
                });

                prevButton.addEventListener('click', function() {
                    swiper.slidePrev();
                });
            });
        }
    };

    $(document).ready(function() {
        initializeBlock();
    });

    if (window.acf) {
        window.acf.addAction('render_block_preview/type=Quotes-Slider', initializeBlock);
    }
})(jQuery);