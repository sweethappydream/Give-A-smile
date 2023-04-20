const $ = window.jQuery;
import lightGallery from "lightgallery";
import lgVideo from "lightgallery/plugins/video";

class Common {
  constructor(e = null) {
    this.aboutUsScrollNextSection();
    this.openVideoInModal();
    this.toggleFaq();
        //this.productSlider();
        this.toggleProductSlider();

        const svgSlider = document.querySelectorAll('.select-panel .slider-panel');

        if (svgSlider.length) {
          svgSlider.forEach(slider => {
            new Swiper(slider, {
              slidesPerView: 4,
              spaceBetween: 30,
              breakpoints: {
                360: {
                  slidesPerView: 1.5,
                  spaceBetween: 20,
                },
                640: {
                  slidesPerView: 2.5,
                  spaceBetween: 20,
                },
                768: {
                  slidesPerView: 3,
                  spaceBetween: 30,
                },
                1024: {
                  slidesPerView: 3,
                  spaceBetween: 30,
                },
              },
            });
          });
        }
      }

      aboutUsScrollNextSection() {
        $('.content-video a.btn-scroll').on('click', function (e) {
          e.preventDefault();
          const $nextSections = $(this).closest('section').nextAll('section');
          const $_nextSection = $($nextSections[0]);
          $([document.documentElement, document.body]).animate({
            scrollTop: $_nextSection.offset().top
          }, 1000);

        });
      }

      openVideoInModal() {
        lightGallery(document.querySelector('.video-link a'), {
          selector: 'this',
          plugins: [lgVideo],
          videojs: true,
          mobileSettings: {
            controls: true,
            showCloseIcon: true,
          },
          videojsOptions: {
            controls: true,
            autoplay: 'muted',
          },
        })

        // lightGallery($('.accordion-img-slider a'));

        lightGallery(document.querySelector('.accordion-img-slider .swiper-wrapper'), {
            thumbnail:true,
            // animateThumb: false,
            // showThumbByDefault: false
        }); 
      }

      toggleFaq() {
        $('.questions__title').on('click', function (e) {
          $(this).parent().toggleClass('open');
        });
      }

      productSlider() {
        const productSlider = document.querySelectorAll('.accordion-img-slider');

        if (productSlider.length) {
          productSlider.forEach(slider => {
            new Swiper(slider, {
              slidesPerView: "auto",
              spaceBetween: 10,
            });
          });
        }
      }

      toggleProductSlider() {
        const self = this;
        let isClosed = true;
        $(".accordion-title").on("click", function(e) {
          if (isClosed) {
            $('.preloader').show();
          }
          e.preventDefault();
          var $this = $(this);

          if (!$this.hasClass("open")) {
            $(".accordion-content").slideUp(400);
            $(".accordion-title").removeClass("open");
          }
          $this.toggleClass("open");
          $this.next().slideToggle(400, function () {
            self.productSlider();
            $('.preloader').hide();
          });
          isClosed = !isClosed;
        });
      }
    }

    export default Common;