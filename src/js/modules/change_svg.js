const $ = window.jQuery;

jQuery(document).ready(function ($) {
    const scrollList = document.querySelector('.steps-list');
    if (scrollList) {
        const body = $('body')
        body.on('click', '.choosing-step-form .next-step, .project-popup__btn-wrap .btn-step, .customize-step-form #form-step3-submit, #form-step4 #form-step4-submit', scrollToTop);
        body.on('click', '.rush-btn', scrollToTop);
    }

    function scrollToTop() {
        scrollList.scrollIntoView({behavior: 'smooth'});
    }
});


