const $ = window.jQuery;

let switcher = $('.wpml-ls-statics-shortcode_actions');


if (switcher.length){
    switcher.find('ul').attr('aria-label','change language');
}
window.getCookie = function (name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ))
    return matches ? decodeURIComponent(matches[1]) : undefined
}
