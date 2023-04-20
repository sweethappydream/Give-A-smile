import 'construct-style-sheets-polyfill';

const $ = window.jQuery;
import datepicker from 'js-datepicker';
import dateFormat from "dateformat";

import tabs from '../classes/tabs';
import modal from '../classes/modal.js';

import 'jquery-validation';
import phoneCountryPrefix from "./input-flags";

let customDays = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];
let customMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

if ($('html').attr("dir")) {
    customDays = ['א', 'ב', 'ג', 'ד', 'ה', 'ו', 'ש'];
    customMonths = ['יָנוּאָר', 'פברואר', 'מרץ', 'אַפּרִיל', 'מאי', 'יוני', 'יולי', 'אוגוסט', 'סֶפּטֶמבֶּר', 'אוֹקְטוֹבֶּר', 'נוֹבֶמבֶּר', 'דֵצֶמבֶּר'];
}

// Function to manage prev and next on textarea carousel.
function updateSvgWithTextareaContent(nextTextArea) {
    // If we don't have the element?
    if (!nextTextArea) {
        nextTextArea = $('body .wrapper-textarea > textarea.current-m');
    }
    // Make changes here onwards.
    if (nextTextArea.length) {
        let $valR = nextTextArea.val();
        let x = nextTextArea.attr('data-x');
        let y = nextTextArea.attr('data-y');
        let color = nextTextArea.attr('data-color');
        let fontS = nextTextArea.attr('data-font-size');
        $('.template > div.svg #message-svg').text($valR);
        steps.svgTextMultiline(".step3 .template", 'message-svg', x, y, color, fontS);
    }
}

const steps = {
    state: {
        'id': '',
        'template': '',
        'vId': '',
        'price': 0,
        'title': '',
        'step': 1,
        'type': '',
        'forms': {
            'form2': {},
            'form3': {},
            'form4': {},
        },
    },
    banner: $('.product-banner'),
    btnTrigger: $('.btn-step'),

    setLocalStorage: (state = [], id) => {
        let existing = localStorage.getItem('localState');

        existing = existing ? JSON.parse(existing) : steps.state;

        if (existing['id'] === id) return;

        localStorage.setItem('localState', JSON.stringify(state));
    },

    getLocalStorageArr: () => {
        let getState = localStorage.getItem('localState');
        return JSON.parse(getState);
    },

    updateLocalStorage: (value, key, form) => {
        let existing = localStorage.getItem('localState');
        existing = existing ? JSON.parse(existing) : steps.state;
        if (form) {
            existing[key][form] = value;
        } else {
            existing[key] = value;
        }
        localStorage.setItem('localState', JSON.stringify(existing));
    },

    paymentFieldsValidation: () => {
        const creditCard = document.querySelector('#og-ccnum');
        if (creditCard !== null) {
            creditCard.placeholder = "0000 0000 0000 0000";
            creditCard.maxLength = 19;
        }

        const cvv = document.querySelector('#og-cvv');
        if (cvv !== null) {
            cvv.placeholder = "xxx";
        }

        if ($('.og-cc-month') && $('.og-cc-year')) {
            $('.og-cc-month').parents('.form-row').addClass('is-date');
        }

        if ($('.og-cc-cvv')) {
            $('.og-cc-cvv').parents('.form-row').addClass('is-cvv');
        }
        const valid = $('.l-checkout').validate({
            errorElement: 'span',
            groups: {
                data: "og-expmonth og-expyear"
            },
            rules: {
                'og-ccnum': {
                    required: true,
                    minlength: 18,
                },
                'og-cvv': {
                    required: true,
                    minlength: 3,
                    maxlength: 4,
                    digits: true,
                },
            },
            messages: {
                'og-ccnum': {
                    required: "Is This the Correct Card Number?",
                    minlength: "Please enter at least 16 characters."
                },
                'og-cvv': {
                    minlength: "This field is required."
                }
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "og-expmonth" || element.attr("name") == "og-expyear")
                    error.insertAfter(".form-row.is-date .og-expiration");
                else
                    error.insertAfter(element);
            },
        });
    },

    svgChangeIds: () => {
        let allSvgTemplates = document.querySelectorAll('.steps-list input[name="template-id"], .default-card .default-card__block');

        if (allSvgTemplates.length) {

            allSvgTemplates.forEach((item, index) => {
                let svgID = item.getAttribute('id');
                const newSvg = item.closest('.item').querySelector('svg');
                // let newSvgStr = newSvg.innerHTML;

                if (newSvg) {
                    if (!newSvg.hasAttribute('id')) {
                        newSvg.setAttribute('id', svgID);
                    } else {
                        svgID = newSvg.getAttribute('id');
                    }

                    let selectorArr = [];

                    let gTags = newSvg.querySelectorAll('g');
                    let useTags = newSvg.querySelectorAll('use');
                    let clipPathTags = newSvg.querySelectorAll('clipPath');
                    let maskTags = newSvg.querySelectorAll('mask');
                    let filterTags = newSvg.querySelectorAll('filter');
                    let pathTags = newSvg.querySelectorAll('path');
                    let rectTags = newSvg.querySelectorAll('rect');
                    let colorMatrixTags = newSvg.querySelectorAll('feColorMatrix');
                    let radialGradientTags = newSvg.querySelectorAll('radialGradient');
                    let circleTags = newSvg.querySelectorAll('circle');

                    changeAttributes(gTags, useTags, clipPathTags, maskTags, filterTags, pathTags, rectTags, colorMatrixTags, radialGradientTags, circleTags);

                    function changeAttributes(...tagArr) {
                        tagArr.forEach((tag, index) => {
                            tag.forEach((item, index) => {
                                if (item.hasAttribute('id')) {
                                    let id = item.getAttribute('id');
                                    item.setAttribute('id', id + '-' + svgID);

                                    selectorArr['#' + id] = '#' + id + '-' + svgID;
                                }

                                if (item.hasAttribute('xlink:href')) {
                                    let id = item.getAttribute('xlink:href');
                                    item.setAttribute('xlink:href', id + '-' + svgID);

                                    selectorArr[id] = id + '-' + svgID;
                                }

                                if (item.hasAttribute('filter')) {
                                    let id = item.getAttribute('filter');
                                    id = id.match(/\((.*?)\)/);
                                    item.setAttribute('filter', 'url(' + id[1] + '-' + svgID + ')');

                                    selectorArr[id[1]] = id[1] + '-' + svgID;
                                }

                                if (item.hasAttribute('mask')) {
                                    let id = item.getAttribute('mask');
                                    id = id.match(/\((.*?)\)/);
                                    item.setAttribute('mask', 'url(' + id[1] + '-' + svgID + ')');

                                    selectorArr[id[1]] = id[1] + '-' + svgID;
                                }

                                if (item.hasAttribute('clip-path')) {
                                    let id = item.getAttribute('clip-path');
                                    id = id.match(/\((.*?)\)/);
                                    item.setAttribute('clip-path', 'url(' + id[1] + '-' + svgID + ')');

                                    selectorArr[id[1]] = id[1] + '-' + svgID;
                                }

                                if (item.hasAttribute('fill')) {
                                    let id = item.getAttribute('fill');
                                    id = id.match(/\((.*?)\)/);

                                    if (id) {
                                        item.setAttribute('fill', 'url(' + id[1] + '-' + svgID + ')');
                                        selectorArr[id[1]] = id[1] + '-' + svgID;
                                    }
                                }

                                // if (item.classList.length) {
                                //     let className = item.classList.value + '-' + svgID;
                                //     item.setAttribute('class', className);
                                //
                                //     selectorArr[item.classList.value] = className;
                                // }
                            });
                        });
                    }

                    // for (let key in selectorArr) {
                    //   newSvgStr = newSvgStr.replaceAll(key, selectorArr[key]);
                    // }

                    if (newSvg.querySelector('style')) {
                        let style = newSvg.querySelector('style');

                        style.innerHTML = style.innerHTML.replace(/\t/g, '');
                        style.innerHTML = style.innerHTML.replace(/\n/g, '');

                        if (style.innerHTML.match(/\}(.+?)(?=\{)/)) {
                            style.innerHTML = style.innerHTML.replace(/\}(.+?)(?=\{)/g, match => '}#' + svgID + ' ' + match.substring(1));
                            style.innerHTML = '#' + svgID + ' ' + style.innerHTML;
                        }
                        style.innerHTML = style.innerHTML.replace(/\(#(.+?)(?=\))/g, match => match + '-' + svgID);
                    }
                }
            });
        }
    },

    svgAddImportantTags: (svg) => {

        if (svg) {
            let viewBox = svg.getAttribute('viewBox');
            let viewBoxArr = viewBox.split(/\s+|,/);
            const viewBoxWidht = viewBoxArr[2];
            const viewBoxHeight = viewBoxArr[3];
            const ratio = (viewBoxWidht / viewBoxHeight).toFixed(1);


            // for 100px width of viewbox
            let fontSizeMessage = (ratio < 1.0) ? 2.89 : 2;
            let fontSizeReceiver = (ratio < 1.0) ? 6.9 : 5.5;
            let fontSizePriceTitle = (ratio < 1.0) ? 4 : 2.9;
            let imageSizeWidht = 25;
            let imageSizeHeight = 15;


            let receiverNameY = (ratio < 1.0) ? 6 : 4;
            let messageY = (ratio < 1.0) ? 16 : 16;
            let fromNameY = (ratio < 1.0) ? 41 : 43;
            let behalfY = (ratio < 1.0) ? 45 : 47;
            let productTitleY = (ratio < 1.0) ? 50 : 52;
            let partnerTitleY = (ratio < 1.0) ? 65 : 65;
            let partnerDescY = (ratio < 1.0) ? 69 : 69;
            let partnerLogoY = (ratio < 1.0) ? 79 : 79;
            let showPriceY = (ratio < 1.0) ? 58 : 58;


            fontSizeMessage = (viewBoxWidht / 100 * fontSizeMessage).toFixed(1);
            fontSizeReceiver = (viewBoxWidht / 100 * fontSizeReceiver).toFixed(1);
            fontSizePriceTitle = (viewBoxWidht / 100 * fontSizePriceTitle).toFixed(1);
            imageSizeWidht = (viewBoxWidht / 100 * imageSizeWidht).toFixed(1);
            imageSizeHeight = (viewBoxWidht / 100 * imageSizeHeight).toFixed(1);


            //Change size and position to horizontal card
            if (ratio > 1.3 && ratio < 1.5) {
                imageSizeHeight = 27;
                partnerLogoY = 85;
                partnerDescY = 73;
                fontSizeReceiver = 11;
                receiverNameY = 4;
                behalfY = 40.5;
                messageY = 10.5;
                fromNameY = 32;
                partnerTitleY = 32;
                productTitleY = 44;
                showPriceY = 52;
                partnerTitleY = 57;
            }

            // position gorizontal
            if (ratio > 0.6 && ratio < 0.8) {
                fromNameY = 34;
                productTitleY = 45;
                showPriceY = 53.5;
                behalfY = 42;
                partnerTitleY = 57;
                partnerDescY = 64;
                //imageSizeHeight = 22;
                messageY = 11.0;
                partnerLogoY = 77.5;
            }
            //change position title and description to square card
            if (ratio > 0.9 && ratio < 1.1) {
                fromNameY = 34.5;
                fontSizeMessage = 5;
                behalfY = 44;
                productTitleY = 47;
                partnerTitleY = 60;
                partnerDescY = 70;
                showPriceY = 55;
                fontSizePriceTitle = 7.5;
                messageY = 12;
            }

            const onlyMessageFontSize = 6.9;

            const tags = `<text x="50%" y="${receiverNameY}%" font-size="${fontSizeReceiver}" fill="#0E1856" font-weight="600" dominant-baseline="middle"
      text-anchor="middle" id="receiver-name-svg"></text>

      <text x="50%" y="${messageY}%" fill="#997C61" font-size="${onlyMessageFontSize}" dominant-baseline="middle"
      text-anchor="middle" id="message-svg"></text>

      <text x="50%" y="${fromNameY}%" font-size="${fontSizePriceTitle}" fill="#0E1856" font-weight="600" dominant-baseline="middle"
      text-anchor="middle" id="from-name-svg"></text>

      <text x="50%" y="${behalfY}%" font-size="${fontSizePriceTitle}" fill="#0E1856"  dominant-baseline="middle"
      text-anchor="middle" id="behalf-svg"></text>

      <text x="50%" y="${productTitleY}%" font-size="${fontSizePriceTitle}" dominant-baseline="middle" font-weight="600"
      text-anchor="middle" id="product-title-svg"></text> 

      <text x="50%" y="${partnerTitleY}%" font-size="${fontSizePriceTitle}" dominant-baseline="middle"
      text-anchor="middle" id="partner-title-svg"></text>

      <text x="50%" y="${partnerDescY}%" font-size="${fontSizeMessage}" dominant-baseline="middle"
      text-anchor="middle" id="partner-desc-svg"></text>


      <text x="50%" y="${showPriceY}%" font-size="${fontSizePriceTitle}" dominant-baseline="middle"
      text-anchor="middle" id="show-price-svg"></text>`;

            let PartnerLogoSrc = $('.js-svg-attr').attr('data-partner-logo');


            if (PartnerLogoSrc !== '') {
                let svgimg = document.createElementNS('http://www.w3.org/2000/svg', 'image');
                svgimg.setAttributeNS(null, 'height', imageSizeHeight);
                svgimg.setAttributeNS(null, 'width', imageSizeWidht);
                svgimg.setAttributeNS('http://www.w3.org/1999/xlink', 'href', PartnerLogoSrc);
                // svgimg.style.tranform = 'translateX(-10px)';
                // svgimg.setAttributeNS(null, 'x', `calc(50% - ${imageSizeWidht / 2}px)`);
                svgimg.setAttributeNS(null, 'x', `39%`);
                svgimg.setAttributeNS(null, 'y', `${partnerLogoY}%`);
                svgimg.setAttributeNS(null, 'visibility', 'visible');
                $(svg).append(svgimg);
            }
            if ($(svg).find('#receiver-name-svg').length &&
                $(svg).find('#from-name-svg').length &&
                $(svg).find('#message-svg').length &&
                $(svg).find('#show-price-svg').length) {
            } else {
                $(svg).append(tags);
            }

            return svg.outerHTML;
        }
    },

    timepickerChanger: () => {
        let animating = false;

        $(document).mouseup(e => {
            const $placeholder = $('.timepicker .placeholder');
            const $dropdown = $('.timepicker-dropdown');
            if (!$placeholder.is(e.target) && !$dropdown.is(e.target)
                && $placeholder.has(e.target).length === 0 && $dropdown.has(e.target).length === 0) {
                $placeholder.removeClass('open');
                $placeholder.siblings('.timepicker-dropdown').slideUp(300, () => {
                    animating = false;
                });
            }
        });

        $(document).on('click', '.timepicker .placeholder', (e) => {
            if (!animating) {
                animating = true;
                $(e.target).toggleClass('open');
                $(e.target).siblings('.timepicker-dropdown').slideToggle(300, () => {
                    animating = false;
                });
            }
        });

        $(document).on('click', '.item-hour', (e) => {
            $('.item-hour').removeClass('active');
            $('.custom-date.custom-show').attr('data-hour-value', $(e.target).text());
            $(e.target).addClass('active');
            $(e.target).closest('.timepicker-wrapper').find('.placeholder > .text').hide();
            $(e.target).closest('.timepicker-wrapper').find('.placeholder > .time').show().find('.hour').text($(e.target).text());
        });

        $(document).on('click', '.item-minute', (e) => {
            $('.item-minute').removeClass('active');
            $('.custom-date.custom-show').attr('data-minute-value', $(e.target).text());
            $(e.target).addClass('active');
            $(e.target).closest('.timepicker-wrapper').find('.placeholder > .text').hide();
            $(e.target).closest('.timepicker-wrapper').find('.placeholder > .time').show().find('.minute').text($(e.target).text());
        });

        $(document).on('change', '.custom-date', (e) => {
            if (e.target.classList.contains('custom-show')) {
                $(e.target).closest('.radiobutton-row').find('.time-group').slideDown(300);
            } else {
                $(e.target).closest('.radiobutton-row').find('.time-group').slideUp(300);
            }
        })
    },

    onStepsClick: () => {
        $(document).on('click', '.product-steps__item', (e) => {
            e.preventDefault();
            let $step = e.target.closest('.product-steps__item').getAttribute('data-steps-item');
            $step = parseInt($step, 10);
            switch ($step) {
                case 1:
                    $('[data-steps-item="2"],[data-steps-item="3"]').removeClass('active');
                    $('.steps-list__item').removeClass('show-step');
                    $('.step1').addClass('show-step');
                    $('.step1').setAttribute('aria-hidden', false); // ('aria-hidden', false)
                    $('.step2').setAttribute('aria-hidden', true); // ('aria-hidden', true)
                    $('.step3').setAttribute('aria-hidden', true); // ('aria-hidden', true)
                    $('.step4').setAttribute('aria-hidden', true); // ('aria-hidden', true)
                    $('.step5').setAttribute('aria-hidden', true); // ('aria-hidden', true)
                    $('.product-steps').hide();
                    $('.product-steps:not(.for-me)').fadeIn(500);
                    steps.updateLocalStorage($step, 'step');
                    steps.updateLocalStorage({}, 'forms', 'form2');
                    steps.updateLocalStorage({}, 'forms', 'form3');
                    steps.updateLocalStorage({}, 'forms', 'form4');
                    steps.updateLocalStorage('', 'template');
                    $('.wrapper-errors').removeClass('show');
                    $('.wrapper-errors-list').removeClass('show-list');
                    $('.default-item-row').removeClass('errors-find');
                    $('.new-item').remove();
                    $('.temp-svg').remove();
                    $('.btn-add-default').remove();
                    steps.banner.hide();
                    break;
                case 2:
                    $('[data-steps-item="3"]').removeClass('active');
                    steps.updateLocalStorage($step, 'step');
                    steps.updateLocalStorage('', 'template');
                    $('.steps-list__item').removeClass('show-step');
                    $('.step2').addClass('show-step');
                    $('.step1').setAttribute('aria-hidden', true); // ('aria-hidden', true)
                    $('.step2').setAttribute('aria-hidden', false); // ('aria-hidden', true)
                    $('.step3').setAttribute('aria-hidden', true); // ('aria-hidden', true)
                    $('.step4').setAttribute('aria-hidden', true); // ('aria-hidden', true)
                    $('.step5').setAttribute('aria-hidden', true); // ('aria-hidden', true)

                    break;
                case 3:
                    steps.updateLocalStorage(4, 'step');
                    $('.steps-list__item').removeClass('show-step');
                    $('.step4').addClass('show-step');
                    break;
            }
        })
    },

    showChangeCheckbox: () => {
        $(document).on('change', '.wrapper-errors-list input[type="checkbox"]', (e) => {
            if (e.target.checked) {
                e.target.closest('.wrapper-errors-list').querySelector('input[type="text"]').setAttribute('data-show', true);
            } else {
                e.target.closest('.wrapper-errors-list').querySelector('input[type="text"]').setAttribute('data-show', false);
            }
        })
    },

    validateFormFields: (form) => {
        let errors = [];
        let cur_language = 'en';
        if ($.isFunction('getCookie')) {
            cur_language = getCookie('wp-wpml_current_language');
        }

        for (let el of form.elements) {


            if (el.closest('.wrapper-errors') && !el.closest('.hidden-errors')) {

                if ((el.type !== 'checkbox' && el.getAttribute('data-show') === 'true' && el.name === 'sms-value') || (el.type !== 'checkbox' && el.getAttribute('data-show') === 'true' && el.name === 'whatsapp-value')) {

                    let filter = /^\+{0,1}[0-9]{10,12}$/;
                    let errorWrap = el.closest('.wrapper-errors');
                    let errorText = el.closest('.wrapper-errors').querySelector('.error');

                    // let phoneWithPrefix =  intlTelInput(el, {
                    //     utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.18/js/utils.js"
                    // });

                    if (el.value === '') {
                        errorText.innerHTML = 'Required fields';
                        if (cur_language == 'he') {
                            errorText.innerHTML = 'שדות חובה';
                        }
                        errorWrap.classList.add('show');
                        errors.push(el.type);
                    } else {
                        if (filter.test(el.value)) {
                            errorWrap.classList.remove('show');
                        } else {
                            errorText.innerHTML = 'Invalid data (only numbers from 10 to 12 characters)';
                            if (cur_language == 'he') {
                                errorText.innerHTML = 'נתונים לא חוקיים (רק מספרים מ-10 עד 12 תווים)';
                            }
                            errorWrap.classList.add('show');
                            errors.push(el.type);
                        }
                    }
                } else if (el.type !== 'checkbox' && el.getAttribute('data-show') === 'true' && el.name === 'email-value') {

                    let filter = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
                    let errorWrap = el.closest('.wrapper-errors');
                    let errorText = el.closest('.wrapper-errors').querySelector('.error');


                    if (el.value === '') {
                        errorText.innerHTML = 'Required fields';
                        if (cur_language == 'he') {
                            errorText.innerHTML = 'שדות חובה';
                        }
                        errorWrap.classList.add('show');
                        errors.push(el.type);
                    } else {
                        if (filter.test(el.value)) {
                            errorWrap.classList.remove('show');
                        } else {
                            errorText.innerHTML = 'Invalid data (example test@gmail.com)';
                            if (cur_language == 'he') {
                                errorText.innerHTML = 'נתונים לא חוקיים (לדוגמה test@gmail.com)';
                            }
                            errorWrap.classList.add('show');
                            errors.push(el.type);
                        }
                    }
                } else if (el.value === '' && el.type !== 'checkbox' && el.getAttribute('data-show') === null || el.value === '' && el.type !== 'checkbox' && el.getAttribute('data-show') !== null && el.getAttribute('data-show') === 'true') {
                    if (!el.closest('.send-row.temp') && !el.closest('.hidden-errors')) {
                        el.closest('.wrapper-errors').classList.add('show');
                        errors.push(el.type);
                    }
                } else {
                    el.closest('.wrapper-errors').classList.remove('show');
                }

            }
        }

        let storage = steps.getLocalStorageArr();
        if (storage['type'] === 'For Several Receivers') {
            errors = [];
            if (storage['step'] !== 4) {
                let i = 1;
                for (let el of form.elements) {
                    if (el.closest('.wrapper-errors') && !el.closest('.hidden-errors')) {
                        if (el.value === '' && el.type === 'text' && el.classList.contains('receivers-input') && i === 1) {
                            el.closest('.wrapper-errors').classList.add('show');
                            errors.push(el.type);
                            i++;
                        }
                        if (el.getAttribute('id') === 'from-name') {
                            el.closest('.wrapper-errors').classList.remove('show');
                        }
                    }
                }
            } else {
                errors = [];
                for (let el of form.elements) {
                    if (el.closest('.wrapper-errors') && !el.closest('.hidden-errors')) {
                        if (el.value === '' && el.type !== 'checkbox' && el.getAttribute('data-show') === null || el.value === '' && el.type !== 'checkbox' && el.getAttribute('data-show') !== null && el.getAttribute('data-show') === 'true') {
                            el.closest('.wrapper-errors').classList.add('show');
                            errors.push(el.type);
                        }
                        if (el.getAttribute('id') === 'from-name') {
                            el.closest('.wrapper-errors').classList.remove('show');
                        }
                    }
                }
            }
        }

        $('.product-steps__item[data-steps-item="1"],.product-steps__item[data-steps-item="2"],.product-steps__item[data-steps-item="3"]').bind('click', function () {
            $('.wrapper-errors').removeClass('show');
            errors = [];
        });

        return errors.length > 0;
    },


    validateFormCheckbox: (form) => {
        let errors = [];
        for (let el of form.elements) {
            if (el.closest('.wrapper-errors-list')) {
                if (el.type === 'checkbox' && !el.checked) {
                    if (!el.closest('.send-row.temp') && !el.closest('.hidden-errors')) {
                        el.closest('.wrapper-errors-list').classList.add('show-list');
                        errors.push(el.type);
                    }
                }
            }
        }
        if (errors.length < 3) $('.wrapper-errors-list').removeClass('show-list');

        return errors.length < 3;
    },

    validateFormCheckboxRows: () => {
        let errors = [];

        $('.default-item-row, .new-item').each(function () {
            if ($(this).find('input[type="checkbox"]').filter(':checked').length < 1) {
                $(this).find('.wrapper-errors-list').addClass('show-list');
                $(this).addClass('errors-find');
                errors.push(1);
            } else {
                $(this).find('.wrapper-errors-list').removeClass('show-list');
                $(this).removeClass('errors-find');
            }
        })

        return errors.length > 0;
    },

    onclickFromSubmit: () => {
        $('#form-step2').submit((e) => {
            e.preventDefault();

            const form = document.getElementById("form-step2");
            const data = $('#form-step2').serializeArray().reduce((obj, item) => {
                obj[item.name] = item.value;
                return obj;
            }, {});

            if (!steps.validateFormFields(form)) {
                steps.updateLocalStorage(3, 'step');
                steps.updateLocalStorage(data, 'forms', 'form2');

                let templateSvg = $('.template > div.svg').first().find('svg').clone(true, true);
                templateSvg = steps.svgAddImportantTags(templateSvg.get(0));
                $('.template-result > div.svg').html(templateSvg);

                let $input = $('textarea.current-m');
                let x = $input.attr('data-x');
                let y = $input.attr('data-y');
                let color = $input.attr('data-color');
                let fontS = $input.attr('data-font-size');
                $('.template > div.svg #message-svg').text($input.val());

                let partnerDesc = $('.js-svg-attr').attr('data-partner-desc');
                let partnerTitle = $('.js-svg-attr').attr('data-partner-title');
                let productTitle = $('.js-svg-attr').attr('data-product-title');
                let behalfTitle = $('.js-svg-attr').attr('data-behalf-title');

                $('.template > div.svg #partner-desc-svg').text(partnerDesc);
                $('.template > div.svg #partner-title-svg').text(partnerTitle);
                $('.template > div.svg #product-title-svg').text(productTitle);
                $('.template > div.svg #behalf-svg').text(behalfTitle);

                setTimeout(function () {
                    steps.svgTextMultiline(".step3 .template", 'message-svg', x, y, color, fontS);
                    steps.svgTextMultiline(".step3 .template", 'partner-desc-svg', x, y, color, fontS);
                    steps.svgTextMultiline(".step3 .template", 'partner-title-svg', x, y, color, fontS);
                    steps.svgTextMultiline(".step3 .template", 'product-title-svg', x, y, color, fontS);
                    steps.svgTextMultiline(".step3 .template", 'behalf-svg', x, y, color, fontS);
                }, 1)


                // $('.template > div.svg #message-svg').text($input.val());

                // setTimeout(function () {
                //   steps.svgTextMultiline(".step3 .template", 'message-svg', x, y, color, fontS);
                // }, 1)


                $('.steps-list__item').removeClass('show-step');
                $(`.step3`).addClass('show-step');

                const storage = steps.getLocalStorageArr().forms;
                if (storage['form2']['template-id'] !== null) {
                    let len = $(`#${storage['form2']['template-id']}`).closest('.items').find('.item').length;

                    if (len > 1) {
                        $('.switcher-btn').css({'opacity': 1, pointerEvents: 'auto', height: 'auto'});
                    } else {
                        $('.switcher-btn').css({'opacity': 0, pointerEvents: 'none', height: 0});
                    }
                }
            }


            /**
             * Custom work to manage dynamic messages based on occasion.
             *
             */
                // Get the current option selected.
            var selectedOrder = $('select#select-happening').find(':selected').attr('data-option-order');
            // Let's iterate textarea containers.
            $('.wrapper-textarea-for-occasion').each(function () {
                var currentElement = $(this);
                // Do we have this class on this container?
                if (currentElement.hasClass('wrapper-textarea-for-' + selectedOrder)) {
                    currentElement.addClass('wrapper-textarea');
                    currentElement.show();
                    // Find arrows.
                    currentElement.find('.arrow-left-inactive').addClass('arrow-left');
                    currentElement.find('.arrow-right-inactive').addClass('arrow-right');
                    // Make the right side SVG updated with correct textarea.
                    updateSvgWithTextareaContent(null);
                } else {
                    currentElement.removeClass('wrapper-textarea');
                    currentElement.hide();
                    // Find arrows.
                    currentElement.find('.arrow-left-inactive').removeClass('arrow-left');
                    currentElement.find('.arrow-right-inactive').removeClass('arrow-right');
                }
            });
        });


        const createReceiversSendDefault = (id, name, cloneItem, first = false) => {
            $('#for-several-receivers').append(`<div class="send-row new-item default-item-row" data-id="${id}">${cloneItem}</div>`);
            const current = $(`[data-id="${id}"]`);

            current.find('.title').addClass('default').text(name);
            current.find('.panel-title').addClass('panel-default');
            current.find('[id="email-id"]').attr('id', `email-id-${id}`);
            current.find('[for="email-id"]').attr('for', `email-id-${id}`);
            current.find('[name="email-value-id"]').attr('name', `email-value-id-${id}`);
            current.find('[id="sms-id"]').attr('id', `sms-id-${id}`);
            current.find('[for="sms-id"]').attr('for', `sms-id-${id}`);
            current.find('[name="sms-value-id"]').attr('name', `sms-value-id-${id}`).each(function () {
                phoneCountryPrefix(this);
            });
            current.find('[id="whatsapp-id"]').attr('id', `whatsapp-id-${id}`);
            current.find('[for="whatsapp-id"]').attr('for', `whatsapp-id-${id}`);
            current.find('[name="whatsapp-value-id"]').attr('name', `whatsapp-value-id-${id}`).each(function () {
                phoneCountryPrefix(this);
            });
            current.find('[id="now-id"]').attr('id', `now-id-${id}`);
            current.find('[for="now-id"]').attr('for', `now-id-${id}`);
            current.find('[id="date-id"]').attr('id', `date-id-${id}`);
            current.find('[for="date-id"]').attr('for', `date-id-${id}`);
            current.find('[name="dispatch-time-id"]').attr('name', `dispatch-time-id-${id}`);
            current.find('.datapicker').addClass(`datapicker-${id}`);

            if (first) {
                current.append($(document.createElement('button')).prop({
                    type: 'button',
                    innerHTML: themeVars.remove,
                    class: 'btn-remove-default',
                }).attr('data-remove-id', id));

                current.find('.panel-title').trigger('click');
            }

            if ($(`.datapicker-${id}`).length) {
                const picker = datepicker(`.datapicker-${id}`, {
                    showAllDates: true,
                    customDays: customDays,
                    customMonths: customMonths,
                    onSelect: (instance, date) => {
                        $(`#date-id-${id}`).val(dateFormat(date, 'mm/dd/yyyy'));
                    },
                });
                picker.setMin(new Date());
            }
        }

        $(document).on('click', '.rush-btn', function (e) {
            e.preventDefault();
            const storage = steps.getLocalStorageArr();
            steps.defaultCard();
            $('[data-steps-item="3"]').addClass('active');
            $('.steps-list__item').removeClass('show-step');
            $(`.step4`).addClass('show-step');
            steps.updateLocalStorage(4, 'step');
            $('.btn-add-default').remove();

            let x = $('.js-svg-attr').attr('data-x-t');
            let y = $('.js-svg-attr').attr('data-y-t');
            let color = $('.js-svg-attr').attr('data-color-t');
            let fontS = $('.js-svg-attr').attr('data-font-size-t');

            let partnerDesc = $('.js-svg-attr').attr('data-partner-desc');
            let partnerTitle = $('.js-svg-attr').attr('data-partner-title');
            let productTitle = $('.js-svg-attr').attr('data-product-title');
            let behalfTitle = $('.js-svg-attr').attr('data-behalf-title');

            $('.template > div.svg #partner-desc-svg').text(partnerDesc);
            $('.template > div.svg #partner-title-svg').text(partnerTitle);
            $('.template > div.svg #product-title-svg').text(productTitle);
            $('.template > div.svg #behalf-svg').text(behalfTitle);

            setTimeout(function () {
                steps.svgTextMultiline(".template-result", 'partner-desc-svg', x, y, color, fontS);
                steps.svgTextMultiline(".template-result", 'partner-title-svg', x, y, color, fontS);
                steps.svgTextMultiline(".template-result", 'product-title-svg', x, y, color, fontS);
                steps.svgTextMultiline(".template-result", 'behalf-svg', x, y, color, fontS);
            }, 1)

            if (storage['type'] === 'For Several Receivers') {
                const tempRow = $('#for-several-receivers .temp'),
                    cloneItem = tempRow.clone(true, true).html();
                createReceiversSendDefault(String(new Date().getTime()) + "123", themeVars.defaultText, cloneItem, true);
                $('#for-several-receivers').after($(document.createElement('button')).prop({
                    type: 'button',
                    innerHTML: themeVars.add,
                    class: 'btn-add-default'
                }));
            }
        });

        $(document).on('click', '.btn-add-default', function () {
            const tempRow = $('#for-several-receivers .temp'),
                cloneItem = tempRow.clone(true, true).html();
            createReceiversSendDefault(String(new Date().getTime()) + "123", themeVars.defaultText, cloneItem);
        });

        $(document).on('click', '.btn-remove-default', function (e) {
            let $this = $(e.target);
            $this.closest('.default-item-row').remove();
        });

        $('#form-step3').submit((e) => {
            const storage = steps.getLocalStorageArr();

            e.preventDefault();
            if (storage['type'] !== 'For Several Receivers') {
                const form = document.getElementById("form-step3");
                const data = $('#form-step3').serializeArray().reduce((obj, item) => {
                    obj['current-msg'] = $('.current-m').attr('id');
                    if (item.name === 'message') {
                        obj[item.name] = item.value;
                    } else {
                        obj[item.name] = item.value;
                    }
                    return obj;
                }, {});

                if (!steps.validateFormFields(form)) {
                    let templateSvg = $('.template > div.svg').first().find('svg').clone(true, true);
                    templateSvg = steps.svgAddImportantTags(templateSvg.get(0));
                    $('.template-result > div.svg').html(templateSvg);
                    $('[data-steps-item="3"]').addClass('active');
                    $('.steps-list__item').removeClass('show-step');
                    $(`.step4`).addClass('show-step');
                    steps.updateLocalStorage(4, 'step');
                    steps.updateLocalStorage(data, 'forms', 'form3');
                }
            }
        });

        $('#form-step4').submit((e) => {
            const storage = steps.getLocalStorageArr();

            if ($("#now").prop('checked')) {
                steps.updateLocalStorage('now', 'time_send');
            } else {
                let customDate = $('.custom-date.custom-show')
                let date = customDate.val();
                let hour = customDate.attr('data-hour-value');
                let minute = customDate.attr('data-minute-value');
                let alltime = date + ' ' + hour + ':' + minute;
                steps.updateLocalStorage(alltime, 'time_send');
            }

            e.preventDefault();
            if (storage['type'] === 'For One Receiver') {
                $('.payment-from').hide();
                $('.loader-payment, .payment-from').addClass('loading');
                const form = document.getElementById("form-step4");
                const data = $('#form-step4').serializeArray().reduce(function (obj, item) {
                    obj[item.name] = item.value;
                    return obj;
                }, {});


                const objItem = {
                    'receivers': [
                        {
                            'id': '',
                            'dispatch-time': data[`dispatch-time`],
                            'email': data[`email-value`],
                            'sms': data[`sms-value`],
                            'whatsapp': data[`whatsapp-value`],
                            'template': '',
                        }
                    ],
                    'sender-name': data['sender-name'],
                    'sender-phone': data['sender-phone'],
                };

                if (steps.validateFormCheckbox(form) && !steps.validateFormFields(form)) {
                    $('.steps-list__item').removeClass('show-step');
                    // $(`.step5`).addClass('show-step');
                    steps.updateLocalStorage(5, 'step');
                    steps.banner.hide();
                    // steps.updateLocalStorage(data, 'forms', 'form4');
                    steps.updateLocalStorage(objItem, 'forms', 'form4');

                    // let loggedIn = $('.logged-in').length > 0;
                    // if (!loggedIn) {
                    //     $("html, body").animate({scrollTop: 0}, {
                    //         easing: 'swing',
                    //         duration: 500,
                    //         complete: function () {
                    //             $('.js-trigger-modal.is-login').trigger('click');
                    //         }
                    //     });
                    // }
                }

                redirectToCheckout(true);
            }
        });
    },

    clickMainPopup: () => {
        steps.btnTrigger.on('click', (e) => {
            let state = steps.getLocalStorageArr();
            $('#product-modal [data-modal="close"]').trigger('click');
            $('.steps-list__item').removeClass('show-step');
            $(`.step${e.target.getAttribute('data-step')}`).addClass('show-step');
            steps.updateLocalStorage(`${e.target.getAttribute('data-type')}`, 'type');
            steps.updateLocalStorage(parseInt(e.target.getAttribute('data-step'), 10), 'step');
            $('[data-steps-item="2"]').addClass('active');
            steps.banner.find('.price').html(state['price']);
            steps.banner.find('.subtitle').html(state['title']);
            $('#show-price').attr({'data-price': state['price']});
            $('.js-svg-attr').attr({'data-product-title': state['title']});

            if (e.target.getAttribute('data-type') === 'For Several Receivers') {
                $('.for-one').addClass('hidden-errors').hide();
                $('.for-several').removeClass('hidden-errors').show();
            } else {
                $('.for-one').removeClass('hidden-errors').show();
                $('.for-several').addClass('hidden-errors').hide();
            }

            if (e.target.getAttribute('data-step') !== '5') {
                steps.banner.fadeIn(700);
            }

            if (e.target.getAttribute('data-step') === '5' && e.target.getAttribute('data-type') === 'For Me') {
                $('.product-steps').hide();
                $('.product-steps.for-me').fadeIn(500);
            }

            const data = {
                action: 'woocommerce_ajax_add_to_cart',
                product_id: steps.getLocalStorageArr().id,
                product_sku: '',
                quantity: 1,
                variation_id: steps.getLocalStorageArr().vId,
                donation: steps.getLocalStorageArr().price,
                gift: steps.getUrlParameter('gift'),
            };

            $.ajax({
                type: 'post',
                url: themeVars.ajaxUrl,
                data: data,
                beforeSend: () => {
                    $('.loader-payment, .payment-from').addClass('loading');
                },
                success: function (response) {
                    if (e.target.getAttribute('data-step') === '5' && e.target.getAttribute('data-type') === 'For Me') {
                        redirectToCheckout()
                    } else {
                        $('.payment-from').hide().html(response).fadeIn(300);
                        new tabs('.js-tab-payment');
                        new modal('.c-modal', '.l-modal-container');
                        steps.paymentFieldsValidation();


                        $('.js-add-tip').click(function () {
                            const addTipInput = $('.l-checkout__total .is-add-tip-input');
                            addTipInput.attr("disabled", !addTipInput.attr("disabled"));
                            addTipInput.toggleClass('is-active');

                            $(this).addClass('d-none');
                            $('.js-add-tip-finish').addClass('d-block');
                        });

                        $('.js-add-custom-price').click(function () {
                            $('.c-modal.is-add-tip input[name="add-tip"]').prop('checked', false);
                        });
                    }
                },
            });
        })
    },

    donationAmountValidate() {
        $('.donate-btn').on('click', function (e) {
            e.preventDefault();
            const amount = parseInt($(this).prev('.custom-price-wrap').find('input').val());
            const minPrice = parseInt($(this).prev('.custom-price-wrap').find('input').attr('min'));
            if (isNaN(amount) || ((minPrice === 0 && amount <= minPrice) || (minPrice > 0 && amount < minPrice))) {
                $('.custom-price-wrap .error').addClass('show');
            } else {
                let title = $(this).attr('data-title'),
                    id = $(this).attr('data-vproduct-id');
                title && steps.updateLocalStorage(title, 'title');
                id && steps.updateLocalStorage(id, 'vId');
                steps.updateLocalStorage(amount, 'price');
                $('.custom-price-wrap .error').removeClass('show');

                if (steps.getUrlParameter('gift')) {
                    $('.btn-step[data-type="For Me"]').trigger('click');
                } else {
                    $('.js-trigger-modal.is-product-modal').trigger('click');
                }
            }
        });
    },

    loadMore() {
        $('.load-more').on('click', function (e) {
            e.preventDefault();
            $('.product-step1__price-item').removeClass('hidden');
            $(this).remove();
        });
    },

    initModal() {
        $(document).on('click', '.regular-price a', function (e) {
            e.preventDefault();
            let title = $(this).attr('data-title'),
                id = $(this).attr('data-vproduct-id'),
                price = $(this).attr('data-price');
            title && steps.updateLocalStorage(title, 'title');
            id && steps.updateLocalStorage(id, 'vId');
            price && steps.updateLocalStorage(price, 'price');

            if (steps.getUrlParameter('gift')) {
                $('.btn-step[data-type="For Me"]').trigger('click');
            } else {
                $('.js-trigger-modal[data-modal="#product-modal"]').trigger('click');
            }
        });
    },

    formatTabChange: () => {
        $(document).on('change', '.radiobutton-format', function () {
            let format = $(this).attr('name');
            $(`.panel.${format}`).hide();
            $(`.panel.${$(this).val()}`).fadeIn(500);
        });

        $(document).on('change', '#select-happening', function () {
            $('.select-panel').hide();
            $(`.select-panel[data-select-value="${$(this).val()}"]`).fadeIn(500);
        });

        $(document).on('change', 'input[type=radio][name=template-id]', function () {
            let template = $('.template > div.svg');
            let currFormat = $(this).closest('.panel').attr('data-format');
            let currTemplate = $(this).closest('.item').find('svg').clone(true, true);

            currTemplate = steps.svgAddImportantTags(currTemplate.get(0));
            template.attr('data-format', currFormat);
            template.html(currTemplate);
        });

        let currTemplate = $('input[type=radio][name=template-id]:checked').siblings('.wrapper').find('svg').clone(true, true);
        currTemplate = steps.svgAddImportantTags(currTemplate.get(0));
        if ($('input[type=radio][name=template-id]:checked').length > 0) $('.template > div.svg').html(currTemplate);

    },

    switchCurrentTemplate: () => {
        const storage = steps.getLocalStorageArr().forms;
        if (storage['form2']['template-id'] !== null) {
            let len = $(`#${storage['form2']['template-id']}`).closest('.items').find('.item').length;

            if (len > 1) {
                $('.switcher-btn').css({'opacity': 1, pointerEvents: 'auto', height: 'auto'});
            } else {
                $('.switcher-btn').css({'opacity': 0, pointerEvents: 'none', height: 0});
            }
        }

        $('.switcher-btn').on('click', (e) => {
            e.preventDefault();
            const storage = steps.getLocalStorageArr().forms;
            $.fn.nextOrFirst = function (selector) {
                const next = this.next(selector);
                return (next.length) ? next : this.prevAll(selector).last();
            };

            if (storage['form2']['template-id'] !== null) {
                const current = $(`#${storage['form2']['template-id']}`).closest('.item');
                let $next = current.nextOrFirst(current);
                const arr = storage['form2'];
                arr['template-id'] = $next.find('[name=template-id]').attr('id');
                steps.updateLocalStorage(arr, 'forms', 'form2');
                let template = $('.template > div.svg');
                let currTemplate = $next.find('svg').clone(true, true);
                currTemplate = steps.svgAddImportantTags(currTemplate.get(0));
                template.html(currTemplate);
                setTimeout(function () {
                    if (steps.getLocalStorageArr()['type'] !== 'For Several Receivers') $('form #receiver-name').trigger('input');
                }, 0);

                // $('textarea.current-m').trigger('input');
                $('form #from-name').trigger('input');
                $('form #show-price').trigger('change');

                let partnerDesc = $('.js-svg-attr').attr('data-partner-desc');
                let partnerTitle = $('.js-svg-attr').attr('data-partner-title');
                let productTitle = $('.js-svg-attr').attr('data-product-title');
                let behalfTitle = $('.js-svg-attr').attr('data-behalf-title');

                $('.template > div.svg #partner-desc-svg').text(partnerDesc);
                $('.template > div.svg #partner-title-svg').text(partnerTitle);
                $('.template > div.svg #product-title-svg').text(productTitle);
                $('.template > div.svg #behalf-svg').text(behalfTitle);


                setTimeout(function () {
                    steps.svgTextMultiline(".step3 .template", 'partner-desc-svg');
                    steps.svgTextMultiline(".step3 .template", 'partner-title-svg');
                    steps.svgTextMultiline(".step3 .template", 'product-title-svg');
                    steps.svgTextMultiline(".step3 .template", 'behalf-svg');
                    // steps.svgTextMultiline(".step3 .template", 'product-title-svg', x, y, color, fontS);
                }, 1)
            }
        })
    },

    onChangeInputLister: () => {
        $('form #receiver-name').on('input', function (e) {
            const $input = $(e.target);
            $('.template > div.svg #receiver-name-svg').text($input.val());

            let x = $input.attr('data-x');
            let y = $input.attr('data-y');
            let color = $input.attr('data-color');
            let fontS = $input.attr('data-font-size');

            steps.svgTextMultiline(".step3 .template", 'receiver-name-svg', x, y, color, fontS);
        });

        $(document).on('input', 'textarea.current-m', function (e) {
            const $input = $(e.target);

            if (this.value.length > this.maxlength) {
                $input.text($input.val());
                this.value = this.value.substring(0, this.maxlength);
                return
            }
            $('.template > div.svg #message-svg').text(this.value);

            let x = $input.attr('data-x');
            let y = $input.attr('data-y');
            let color = $input.attr('data-color');
            let fontS = $input.attr('data-font-size');

            steps.svgTextMultiline(".step3 .template", 'message-svg', x, y, color, fontS);
        });

        $('form #from-name').on('input', function (e) {
            const $input = $(e.target);
            $('.template > div.svg #from-name-svg').text($input.val());

            let x = $input.attr('data-x');
            let y = $input.attr('data-y');
            let color = $input.attr('data-color');
            let fontS = $input.attr('data-font-size');

            steps.svgTextMultiline(".step3 .template", 'from-name-svg', x, y, color, fontS);
        });

        $('form #show-price').on('change', function (e) {
            const $checkbox = $(e.target);
            if ($checkbox.is(':checked')) {
                $('.template > div.svg #show-price-svg').text($checkbox.attr('data-text') + $checkbox.attr('data-price') + $checkbox.attr('data-currency'));
                // $('.template > div.svg #product-title-svg').text($checkbox.attr('data-product-title'));

                let xP = $checkbox.attr('data-x-p');
                // let xT = $checkbox.attr('data-x-t');
                let yP = $checkbox.attr('data-y-p');
                // let yT = $checkbox.attr('data-y-t');
                let colorP = $checkbox.attr('data-color-p');
                // let colorT = $checkbox.attr('data-color-t');
                let fontSp = $checkbox.attr('data-font-size-p');
                // let fontSt = $checkbox.attr('data-font-size-t');

                // let fontSt = $checkbox.attr('data-font-size-t');

                steps.svgTextMultiline(".step3 .template", 'show-price-svg', xP, yP, colorP, fontSp);
                // steps.svgTextMultiline(".step3 .template", 'product-title-svg', xT, yT, colorT, fontSt);
            } else {
                $('.template > div.svg #show-price-svg').text('');
                // $('.template > div.svg #product-title-svg').text('');
            }
        });
    },

    customSliderForTextarea: () => {
        // Function to manage prev and next on textarea carousel.
        function managePrevNextOnTextarea(element, isNext) {
            // Basics.
            let arrowLeft = $('body .arrow-left');
            let arrowRight = $('body .arrow-right');
            let countAll = $('body .wrapper-textarea > textarea').length;
            let currentSpan = $(element).siblings('span.count').find('span.current');
            // Find active textarea.
            let activeTextarea = $(element).parent('div').siblings('textarea.current-m');
            let activeTextareaPosition = parseInt(activeTextarea.data('textarea-order'));
            // Do we have next available?
            if (
                (
                    isNext
                    && activeTextareaPosition < countAll
                )
                || (
                    !isNext
                    && activeTextareaPosition >= 1
                )
            ) {
                // Next textarea.
                let nextTextArea = activeTextarea.next('textarea');
                let nextTextAreaPosition = activeTextareaPosition + 1;
                // If isNext is false?
                if (!isNext) {
                    nextTextArea = activeTextarea.prev('textarea');
                    nextTextAreaPosition = activeTextareaPosition - 1;
                }
                // Hide current one.
                activeTextarea.hide().removeClass('current-m');

                // Show next one.
                nextTextArea.fadeIn(500).addClass('current-m')
                // SVG changes.
                updateSvgWithTextareaContent(nextTextArea);
                nextTextArea.trigger('input');
                // Update current text.
                currentSpan.text(nextTextAreaPosition);
                // Change classes.
                if (nextTextAreaPosition === countAll) arrowRight.addClass('last');
                if (nextTextAreaPosition === countAll - 1) arrowRight.removeClass('last');
                if (nextTextAreaPosition > 1) arrowLeft.removeClass('last');
                if (nextTextAreaPosition === 1) arrowLeft.addClass('last');
            }
        }

        $('body').on('click', '.arrow-right', function () {
            managePrevNextOnTextarea(this, true);

        });
        $('body').on('click', '.arrow-left', function () {
            managePrevNextOnTextarea(this, false);
        });
    },

    defaultCard: () => {
        // let defaultTemplate = $('.default-card .svg').clone(true, true).html();
        let templateSvg = $('.default-card .svg').first().find('svg').clone(true, true);
        templateSvg = steps.svgAddImportantTags(templateSvg.get(0));
        $('.template-result > div.svg').html(templateSvg);
        $('.default-card .svg').remove();
        steps.updateLocalStorage('default', 'template');
    },

    placeOrder: () => {
        $(document.body).on("click", "#place_order", function (e) {
            e.preventDefault();
            const storage = steps.getLocalStorageArr();
            let template;
            if (storage['type'] === 'For Me') {
                template = '';
            } else {
                if (storage['template'] === 'default') {
                    template = 'default';
                } else {
                    template = $('.template-result > div.svg').clone(true, true).html();
                }
            }

            const productType = $('.product').hasClass('magic-gift');
            let merged = {...storage.forms.form3, ...storage.forms.form4};
            steps.paymentFieldsValidation();

            if ($('.l-checkout').valid()) {
                let receivers = storage.forms.form4.receivers;
                let sender_name = storage.forms.form4['sender-name'];
                let sender_phone = storage.forms.form4['sender-phone'];


                $.ajax({
                    type: 'POST',
                    url: themeVars.ajaxUrl,
                    data: {
                        'action': 'ajax_order',
                        'fields': $('form.checkout').serializeArray(),
                        'user_id': themeVars.userID,
                        'template': $.trim(template),
                        'steps_fields': merged,
                        'magic_gift': productType,
                        'amount': storage['price'],
                        'type_send': storage['type'],
                        'receivers': receivers,
                        'sender_name': sender_name,
                        'sender_phone': sender_phone,
                    },
                    beforeSend: () => {
                        $('.loader-payment, .payment-from').addClass('loading');
                    },
                    success: function (result) {
                        if (result && result.status === 'success') {
                            $('.error-payment-note').remove();
                            window.location.href = result.data.location;
                        } else {
                            if (!$('.error-payment-note').length) {
                                $('#wc-officeguy-cc-form').append('<p class="error-payment-note" style="color: red; padding: 10px; font-size: 18px;">Invalid card data or there is not enough money in your account</p>')
                            }
                            $('.loader-payment, .payment-from').removeClass('loading');
                        }
                    },
                    error: function (error) {
                        $('.loader-payment, .payment-from').removeClass('loading');
                        console.log(error);
                    }
                });
            }
        });
    },

    fieldsSeveralReceivers: () => {
        let storage = steps.getLocalStorageArr();
        let activeReceiverId;
        let mainCount = 1;
        const wrapperReceiversButtons = document.getElementById('wrapper-receivers-buttons');
        const wrapperReceiversButtonsResult = document.getElementById('wrapper-receivers-buttons-result');
        const firstId = String(new Date().getTime());
        $('#receivers').attr({
            'id': 'receiver-' + firstId,
            'data-id': firstId,
        });
        $('#receivers-remove').attr('id', firstId);
        steps.receivers = {};
        const RECEIVER_DEFAULT_DATA = {
            'receiver-name': '',
            'message': '',
            'from-name': '',
            'show-price': false,
        };
        steps.receivers[firstId] = {...RECEIVER_DEFAULT_DATA};
        steps.receiversFirstId = firstId;


        const receiverPanels = () => {
            $(document).on('click', '.panel-title', (e) => {
                const $target = $(e.target);
                $target.closest('.send-row').toggleClass('open').find('.panel-content').slideToggle(500);
            });
        };

        receiverPanels();

        const createReceiverButton = (id) => {
            if (wrapperReceiversButtons !== null) {
                const button = document.createElement('button');
                button.setAttribute('id', `btn-toggle-receiver-${id}`);
                button.setAttribute('class', 'btn-receiver btn-receiver__hidden');
                wrapperReceiversButtons.appendChild(button);
                button.addEventListener('click', () => toggleReceiver.call(null, id));
            }
        };

        const createReceiverButtonCopy = (id) => {
            if (wrapperReceiversButtonsResult !== null) {
                const button = document.createElement('button');
                button.setAttribute('id', `result-btn-toggle-receiver-${id}`);
                button.setAttribute('class', 'btn-receiver btn-receiver__hidden');
                wrapperReceiversButtonsResult.appendChild(button);
                button.addEventListener('click', () => toggleReceiver.call(null, id));
            }
        };

        const addReceiver = () => {
            createReceiverButton(firstId);
            createReceiverButtonCopy(firstId);
            $(document).on('click', '#add-button', () => {
                let counter = mainCount;
                if (counter < 10) {
                    let id = String(new Date().getTime());
                    let RECEIVER_NEW_DATA = {...RECEIVER_DEFAULT_DATA};

                    RECEIVER_NEW_DATA.message = steps.receivers[steps.receiversFirstId].message;
                    RECEIVER_NEW_DATA['from-name'] = steps.receivers[steps.receiversFirstId]['from-name'];
                    RECEIVER_NEW_DATA['show-price'] = steps.receivers[steps.receiversFirstId]['show-price'];

                    steps.receivers[id] = RECEIVER_NEW_DATA;
                    createReceiverButton(id);
                    createReceiverButtonCopy(id);
                    let list = $('.receivers-repeater > ol.list'),
                        listItem = $('.receivers-repeater > .list > li').last(),
                        cloneItem = listItem.clone(true, true).html();
                    const appendItem = list.append(`<li>${cloneItem}</li>`);
                    appendItem.find('li').last().find('input[type="text"]').attr({
                        'id': 'receiver-' + id,
                        'data-id': id,
                    });
                    appendItem.find('li').last().find('.remove').attr('id', id);

                    counter++;
                    if (counter === 10) $('#add-button').hide();
                }
                mainCount = counter;
            });
        }

        const removeReceiver = () => {
            $(document).on('click', 'button.remove', (e) => {
                let counter = mainCount;
                const id = $(e.target).attr('id');

                if (counter !== 1 && firstId !== id) {
                    const target = $(e.target);
                    delete steps.receivers[id];
                    target.parent().remove();
                    $(`#btn-toggle-receiver-${id}`).remove();
                    $(`#result-btn-toggle-receiver-${id}`).remove();
                    if (id === activeReceiverId) {
                        setDefaultReceiver();
                    }
                    counter--;
                    if (counter < 10) $('#add-button').show();
                    mainCount = counter;
                }
            });
        }

        const toggleReceiversButtons = (activatedId) => {
            $('.btn-receiver').removeClass('btn-receiver__active');
            $(`#btn-toggle-receiver-${activatedId}`).addClass('btn-receiver__active');
            $(`#result-btn-toggle-receiver-${activatedId}`).addClass('btn-receiver__active');
        };

        const setDefaultReceiver = () => {
            activeReceiverId = Object.keys(steps.receivers)[0];
            toggleReceiver(activeReceiverId);
        };

        const updateReceiverData = (id, part, value) => {
            steps.receivers[id][part] = value;
            updateUi(id, part, value);
        };

        const updateSvgElement = (part, value) => {
            let $input = $(`#${part}`);
            if (part === 'receiver-name') {
                $(`.template > div.svg #${part}-svg`).text(value);
                let x = $input.attr('data-x');
                let y = $input.attr('data-y');
                let color = $input.attr('data-color');
                let fontS = $input.attr('data-font-size');
                steps.svgTextMultiline(".step3 .template", `${part}-svg`, x, y, color, fontS);
                steps.svgTextMultiline(".template-result", `${part}-svg`, x, y, color, fontS);
            } else if (part === 'from-name') {
                $(`.template > div.svg #${part}-svg`).text(value);
                let x = $input.attr('data-x');
                let y = $input.attr('data-y');
                let color = $input.attr('data-color');
                let fontS = $input.attr('data-font-size');
                steps.svgTextMultiline(".step3 .template", `${part}-svg`, x, y, color, fontS);
                steps.svgTextMultiline(".template-result", `${part}-svg`, x, y, color, fontS);
            } else if (part === 'show-price') {
                const $checkbox = $(`#${part}`);
                if (value) {
                    $('.template > div.svg #show-price-svg').text($checkbox.attr('data-text') + $checkbox.attr('data-price') + $checkbox.attr('data-currency'));
                    // $('.template > div.svg #product-title-svg').text($checkbox.attr('data-product-title'));

                    let xP = $checkbox.attr('data-x-p');
                    let xT = $checkbox.attr('data-x-t');
                    let yP = $checkbox.attr('data-y-p');
                    let yT = $checkbox.attr('data-y-t');

                    let colorP = $checkbox.attr('data-color-p');
                    let colorT = $checkbox.attr('data-color-t');
                    let fontSp = $checkbox.attr('data-font-size-p');
                    let fontSt = $checkbox.attr('data-font-size-t');

                    steps.svgTextMultiline(".step3 .template", 'show-price-svg', xP, yP, colorP, fontSp);
                    steps.svgTextMultiline(".template-result", 'show-price-svg', xP, yP, colorP, fontSp);
                    // steps.svgTextMultiline(".step3 .template", 'product-title-svg', xT, yT, colorT, fontSt);
                    // steps.svgTextMultiline(".template-result", 'product-title-svg', xT, yT, colorT, fontSt);

                } else {
                    $('.template > div.svg #show-price-svg').text('');
                    // $('.template > div.svg #product-title-svg').text('');
                }
            } else if (part === 'message') {
                $('.template:not(.template-result) > div.svg #message-svg').text(value);
                $('.template-result > div.svg #message-svg').text(value);
                let x = $input.attr('data-x');
                let y = $input.attr('data-y');
                let color = $input.attr('data-color');
                let fontS = $input.attr('data-font-size');
                steps.svgTextMultiline(".step3 .template", 'message-svg', x, y, color, fontS);
                steps.svgTextMultiline(".template-result", 'message-svg', x, y, color, fontS);
            }
        };

        const creatTempTemplate = (id) => {
            setTimeout(function () {
                const temp = $('.template > div.svg').clone(true, true).html();
                if ($(`#${id}-temp`).length > 0) {
                    $(`#${id}-temp`).remove();
                    $('.prev-temp').append(`<div class="temp-svg" id="${id}-temp">${temp}</div>`);
                } else {
                    $('.prev-temp').append(`<div class="temp-svg" id="${id}-temp">${temp}</div>`);
                }
            }, 100);
        };

        const updateUi = (id, part, value, isTemplateCreating = false) => {
            if (!isTemplateCreating) {
                if (part === 'receiver-name') {
                    if (id === activeReceiverId) {
                        updateSvgElement('receiver-name', value);
                    }
                    return;
                }
            }

            updateSvgElement(part, value);
        };

        const updateInput = (part, value) => {
            if (part === 'receiver-name') {
                return;
            }

            if (part === 'show-price') {
                updateInputPrice(value);
                return;
            }

            if (part === 'message') {
                return;
            }

            updateInputElement(part, value);
        };

        const updateInputElement = (part, value) => {
            const element = document.getElementById(part);
            element.value = value;
        };

        const updateInputPrice = (value) => {
            const element = document.getElementById('show-price');

            element.checked = value;
        };

        const toggleReceiver = (id) => {
            toggleReceiversButtons(id);

            activeReceiverId = id;

            Object.entries(steps.receivers[activeReceiverId]).forEach(([part, value]) => {
                if (part == 'message') {
                    value = $('.wrapper-textarea .current-m').text();
                }
                updateUi(activeReceiverId, part, value);
                updateInput(part, value);
            });
        };

        addReceiver();
        removeReceiver();
        if ($('textarea.current-m').length > 0) setDefaultReceiver();

        $('.product-steps__item[data-steps-item="1"]').bind('click', () => {
            $('button.remove').trigger('click');
            $('.receivers-input').val('').trigger('input');
            $('.btn-receiver').addClass('btn-receiver__hidden').text('');
        });


        $(document).on('input', '.receivers-input', (e) => {
            const $input = $(e.target);
            updateReceiverData.call(null, $input.attr('data-id'), 'receiver-name', $input.val())
            if ($input.val() !== '') {
                $(`#btn-toggle-${$input.attr('id')}`).removeClass('btn-receiver__hidden').text($input.val());
                $(`#result-btn-toggle-${$input.attr('id')}`).removeClass('btn-receiver__hidden').text($input.val());
            } else {
                $(`#btn-toggle-${$input.attr('id')}`).addClass('btn-receiver__hidden').text($input.val());
                $(`#result-btn-toggle-${$input.attr('id')}`).addClass('btn-receiver__hidden').text($input.val());
            }
        });

        $(document).on('input', 'textarea.current-m', function (e) {
            const $input = $(e.target);
            if (this.value.length > this.maxlength) {
                $input.text($input.val());
                this.value = this.value.substring(0, this.maxlength);
                return
            }
            updateReceiverData.call(null, activeReceiverId, 'message', this.value);
        });

        $(".switcher-btn").bind("click", function () {
            setDefaultReceiver();
        });

        $(window).on('load', function () {
            if ($('textarea.current-m').length > 0) $('textarea.current-m').first().trigger('input');
        })

        $('.arrow-left').on('click', function () {
            $('textarea.current-m').trigger('input');
        });

        $('.arrow-right').on('click', function () {
            $('textarea.current-m').trigger('input');
        });

        $('form #from-name').on('input', function (e) {
            const $input = $(e.target);

            for (let key in steps.receivers) {
                updateReceiverData.call(null, key, 'from-name', $input.val());
            }
        });

        $('form #show-price').on('change', function (e) {
            const $checkbox = e.target;
            updateReceiverData.call(null, activeReceiverId, 'show-price', $checkbox.checked);
        });

        const createReceiversSend = (id, name, cloneItem, first = false) => {
            $('#for-several-receivers').append(`<div class="send-row new-item 2222" data-id="${id}">${cloneItem}</div>`);
            const current = $(`[data-id="${id}"]`);

            current.find('.title').text(name);
            current.find('[id="email-id"]').attr('id', `email-id-${id}`);
            current.find('[for="email-id"]').attr('for', `email-id-${id}`);
            current.find('[name="email-value-id"]').attr('name', `email-value-id-${id}`);
            current.find('[id="sms-id"]').attr('id', `sms-id-${id}`);
            current.find('[for="sms-id"]').attr('for', `sms-id-${id}`);
            current.find('[name="sms-value-id"]').attr('name', `sms-value-id-${id}`).each(function () {
                phoneCountryPrefix(this);
            });
            current.find('[id="whatsapp-id"]').attr('id', `whatsapp-id-${id}`);
            current.find('[for="whatsapp-id"]').attr('for', `whatsapp-id-${id}`);
            current.find('[name="whatsapp-value-id"]').attr('name', `whatsapp-value-id-${id}`).each(function () {
                phoneCountryPrefix(this);
            });
            current.find('[id="now-id"]').attr('id', `now-id-${id}`);
            current.find('[for="now-id"]').attr('for', `now-id-${id}`);
            current.find('[id="date-id"]').attr('id', `date-id-${id}`);
            current.find('[for="date-id"]').attr('for', `date-id-${id}`);
            current.find('[name="dispatch-time-id"]').attr('name', `dispatch-time-id-${id}`);
            current.find('.datapicker').addClass(`datapicker-${id}`);

            if ($(`.datapicker-${id}`).length) {
                const picker = datepicker(`.datapicker-${id}`, {
                    showAllDates: true,
                    customDays: customDays,
                    customMonths: customMonths,
                    onSelect: (instance, date) => {
                        $(`#date-id-${id}`).val(dateFormat(date, 'mm/dd/yyyy'));
                    },
                });
                picker.setMin(new Date());
            }

            if (first) {
                current.find('.panel-title').trigger('click');
            }
        }

        const createReceiversSendArr = (formArr) => {
            if (typeof formArr !== 'undefined') {
                const tempRow = $('#for-several-receivers .temp'),
                    cloneItem = tempRow.clone(true, true).html();
                $('.new-item').remove();
                const normalArr = [];

                $.each(formArr, function (id, value) {
                    normalArr.push({
                        id: id,
                        ...value
                    });
                });

                let firstTime = true;

                normalArr.forEach((value, i) => {
                    if (value['receiver-name'] !== '') {
                        createReceiversSend(value.id, value['receiver-name'], cloneItem, firstTime);
                        firstTime = false;
                    }
                });
            }
        }

        $('#form-step3').submit((e) => {
            let storage = steps.getLocalStorageArr();
            e.preventDefault();
            if (storage['type'] === 'For Several Receivers') {
                const data = {
                    'receivers': steps.receivers,
                    'from-name': e.target.querySelector('#from-name').value,
                };

                const form = document.getElementById("form-step3");
                if (!steps.validateFormFields(form)) {
                    // setDefaultReceiver();
                    $('[data-steps-item="3"]').addClass('active');
                    $('.steps-list__item').removeClass('show-step');
                    $(`.step4`).addClass('show-step');
                    steps.updateLocalStorage(4, 'step');

                    steps.updateLocalStorage(data, 'forms', 'form3');
                    let templateSvg = $('.template > div.svg').first().find('svg').clone(true, true);
                    templateSvg = steps.svgAddImportantTags(templateSvg.get(0));
                    $('.template-result > div.svg').html(templateSvg);


                    const storageUp = steps.getLocalStorageArr();

                    createReceiversSendArr(storageUp.forms.form3.receivers);
                }
            }
        });

        $('#form-step4').submit((e) => {
            e.preventDefault();
            const storage = steps.getLocalStorageArr();

            if (storage['type'] === 'For Several Receivers') {
                const form = document.getElementById("form-step4");
                const data = $('#form-step4').serializeArray().reduce(function (obj, item) {
                    obj[item.name] = item.value;
                    return obj;
                }, {});

                const storageUp = steps.getLocalStorageArr();
                let str = storageUp.forms.form3.receivers;

                const objItem = {
                    'receivers': [],
                    'sender-name': data['sender-name'],
                    'sender-phone': data['sender-phone'],
                };
                if (typeof str !== 'undefined') {
                    Object.entries(str).map(([part, value]) => {
                        Object.entries(steps.receivers[part]).forEach(async ([key, value]) => {
                            await updateUi(part, key, value, true);
                        });

                        let item = {
                            'id': part,
                            'dispatch-time': data[`dispatch-time-id-${part}`],
                            'email': data[`email-value-id-${part}`],
                            'sms': data[`sms-value-id-${part}`],
                            'whatsapp': data[`whatsapp-value-id-${part}`],
                            'template': $.trim($('.template-result > div.svg').clone(true, true).html()),
                        };
                        objItem['receivers'].push(item);
                    });
                } else {
                    str = [];
                    $('.default-item-row').each(function () {
                        let item = $(this).attr('data-id');
                        str.push(item);
                    });

                    Object.entries(str).map(([part, value]) => {
                        let item = {
                            'id': value,
                            'dispatch-time': data[`dispatch-time-id-${value}`],
                            'email': data[`email-value-id-${value}`],
                            'sms': data[`sms-value-id-${value}`],
                            'whatsapp': data[`whatsapp-value-id-${value}`],
                        };
                        objItem['receivers'].push(item);
                    });
                }

                if (!steps.validateFormCheckboxRows() && !steps.validateFormFields(form)) {
                    // let loggedIn = $('.logged-in').length > 0;
                    // if (!loggedIn) {
                    //     $("html, body").animate({scrollTop: 0}, {
                    //         easing: 'swing',
                    //         duration: 500,
                    //         complete: function () {
                    //             $('.js-trigger-modal.is-login-modal').trigger('click');
                    //         }
                    //     });
                    // }
                    $('.steps-list__item').removeClass('show-step');
                    // $(`.step5`).addClass('show-step');
                    steps.updateLocalStorage(5, 'step');
                    steps.banner.hide();
                    steps.updateLocalStorage(objItem, 'forms', 'form4');
                }

                redirectToCheckout(true);
            }
        });

        createReceiversSendArr(storage.forms.form3.receivers);
    },

    addTip: () => {
        $("body").on("click", ".js-add-tip-finish", function () {
            let tip = [
                {
                    'name': 'custom_price',
                    'value': $('.is-add-tip-input').val(),
                }
            ];
            const data = {
                action: 'woocommerce_ajax_add_to_cart',
                product_id: steps.getLocalStorageArr().id,
                product_sku: '',
                quantity: 1,
                variation_id: steps.getLocalStorageArr().vId,
                donation: steps.getLocalStorageArr().price,
                tip: tip,
                gift: steps.getUrlParameter('gift'),
            };

            if ($('.is-add-tip-input').val() > 0) {
                $.ajax({
                    type: 'post',
                    url: themeVars.ajaxUrl,
                    data: data,
                    beforeSend: () => {
                        $('.payment-from').hide();
                        $('.loader-payment, .payment-from').addClass('loading');
                    },
                    success: function (response) {
                        $('.payment-from').hide().html(response).fadeIn(300);
                        $('.loader-payment, .payment-from').removeClass('loading');
                        new tabs('.js-tab-payment');
                        new modal('.c-modal', '.l-modal-container');
                        steps.paymentFieldsValidation();

                        $('.js-add-tip').click(function () {
                            const addTipInput = $('.l-checkout__total .is-add-tip-input');
                            addTipInput.attr("disabled", !addTipInput.attr("disabled"));
                            addTipInput.toggleClass('is-active');

                            $(this).addClass('d-none');
                            $('.js-add-tip-finish').addClass('d-block');
                        });

                        $('.js-add-custom-price').click(function () {
                            $('.c-modal.is-add-tip input[name="add-tip"]').prop('checked', false);
                        });
                    },
                });
            }
        });
        $('#tip-form').submit((e) => {
            e.preventDefault();
            let dataValue = $(e.target).serializeArray();
            let tip;
            let tipValue;

            dataValue.forEach((obj, index) => {
                if (obj.name == 'add-tip' && obj.value != '') {
                    tipValue = Math.round(steps.getLocalStorageArr().price / 100 * obj.value);
                }
                if (obj.name == 'custom_price' && obj.value != '') {
                    tipValue = obj.value;
                }
            });

            tip = [
                {
                    'name': 'custom_price',
                    'value': tipValue,
                }
            ];

            const data = {
                action: 'woocommerce_ajax_add_to_cart',
                product_id: steps.getLocalStorageArr().id,
                product_sku: '',
                quantity: 1,
                variation_id: steps.getLocalStorageArr().vId,
                donation: steps.getLocalStorageArr().price,
                tip: tip,
                gift: steps.getUrlParameter('gift'),
            };

            $.ajax({
                type: 'post',
                url: themeVars.ajaxUrl,
                data: data,
                beforeSend: () => {
                    $(e.target).trigger("reset");
                    $(e.target).closest("#add-tip").find('.c-modal__close').trigger('click');
                    $('.payment-from').hide();
                    $('.loader-payment, .payment-from').addClass('loading');
                },
                success: function (response) {
                    $('.payment-from').hide().html(response).fadeIn(300);
                    $('.loader-payment, .payment-from').removeClass('loading');
                    new tabs('.js-tab-payment');
                    new modal('.c-modal', '.l-modal-container');
                    steps.paymentFieldsValidation();

                    $('.js-add-tip').click(function () {
                        const addTipInput = $('.l-checkout__total .is-add-tip-input');
                        addTipInput.attr("disabled", !addTipInput.attr("disabled"));
                        addTipInput.toggleClass('is-active');

                        $(this).addClass('d-none');
                        $('.js-add-tip-finish').addClass('d-block');
                    });

                    $('.js-add-custom-price').click(function () {
                        $('.c-modal.is-add-tip input[name="add-tip"]').prop('checked', false);
                    });
                },
            });
        });
    },

    init: () => {
        // steps.placeOrder();
        let id = $('[data-product-id]').attr('data-product-id');
        if (themeVars.isProduct) {
            id && steps.setLocalStorage(steps.state, id);
            steps.updateLocalStorage(id, 'id');
            steps.updateLocalStorage(1, 'step');
            steps.updateLocalStorage({}, 'forms', 'form2');
            steps.updateLocalStorage({}, 'forms', 'form3');
            steps.updateLocalStorage({}, 'forms', 'form4');
            steps.updateLocalStorage('', 'template');
            steps.updateLocalStorage('', 'type');
            steps.updateLocalStorage('', 'vId');
            steps.updateLocalStorage(document.querySelector('html').lang, 'lang');
        }
        const storage = steps.getLocalStorageArr();
        steps.svgChangeIds();
        steps.formatTabChange();
        steps.customSliderForTextarea();
        steps.switchCurrentTemplate();
        steps.onChangeInputLister();
        steps.addTip();

        if (storage['type'] === 'For Several Receivers') {
            $('.for-one').addClass('hidden-errors').hide();
            $('.for-several').removeClass('hidden-errors').show();
        } else {
            $('.for-one').removeClass('hidden-errors').show();
            $('.for-several').addClass('hidden-errors').hide();
        }

        steps.fieldsSeveralReceivers();
        $(`.step1`).fadeIn(500);
        steps.onStepsClick();
        steps.timepickerChanger();
        steps.onclickFromSubmit();
        steps.donationAmountValidate();
        steps.loadMore();
        steps.initModal();
        steps.showChangeCheckbox();
        steps.clickMainPopup();

        // const data = {
        //     action: 'woocommerce_ajax_add_to_cart',
        //     product_id: steps.getLocalStorageArr().id,
        //     product_sku: '',
        //     quantity: 1,
        //     variation_id: steps.getLocalStorageArr().vId,
        //     donation: steps.getLocalStorageArr().price,
        //     gift: steps.getUrlParameter('gift'),
        // };

        // $.ajax({
        //     type: 'post',
        //     url: themeVars.ajaxUrl,
        //     data: data,
        //     beforeSend: () => {
        //         $('.payment-from').hide();
        //         $('.loader-payment, .payment-from').addClass('loading');
        //     },
        //     success: function (response) {
        //         $('.payment-from').hide().html(response).fadeIn(300);
        //         $('.loader-payment, .payment-from').removeClass('loading');
        //         new tabs('.js-tab-payment');
        //         new modal('.c-modal', '.l-modal-container');
        //         steps.paymentFieldsValidation();
        //
        //         $('.js-add-tip').click(function () {
        //             const addTipInput = $('.l-checkout__total .is-add-tip-input');
        //             addTipInput.attr("disabled", !addTipInput.attr("disabled"));
        //             addTipInput.toggleClass('is-active');
        //
        //             $(this).addClass('d-none');
        //             $('.js-add-tip-finish').addClass('d-block');
        //         });
        //
        //         $('.js-add-custom-price').click(function () {
        //             $('.c-modal.is-add-tip input[name="add-tip"]').prop('checked', false);
        //         });
        //     },
        // });

        if (storage['template'] === 'default') {
            steps.defaultCard();
        }

        if ($('.datapicker-for-one').length) {
            const picker = datepicker('.datapicker-for-one', {
                showAllDates: true,
                customDays: customDays,
                customMonths: customMonths,
                onSelect: (instance, date) => {
                    $('#date').val(dateFormat(date, 'mm/dd/yyyy'));
                },
            });
            picker.setMin(new Date());
        }
    },
    getUrlParameter: (sParam) => {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    },

    svgTextMultiline: (step, id, xP = '50', yP = '', color = '', fontSize = '', align = 'middle', fontF = '"Rubik", sans-serif') => {
        const svg = document.querySelector(`${step} > .svg > svg`);
        if (svg === null) return;
        let x = xP;
        let posY = yP ? yP : 0;
        let width = svg.clientWidth / 1.2;

        let viewBox = svg.getAttribute('viewBox');
        let viewBoxArr = viewBox.split(/\s+|,/);
        const viewBoxWidht = viewBoxArr[2];
        const viewBoxHeight = viewBoxArr[3];
        const ratio = (viewBoxWidht / viewBoxHeight).toFixed(1);

        const element = document.querySelector(`${step} > .svg > svg #${id}`);
        let fontInline = element.getAttribute('font-size');
        let yInline = element.getAttribute('y');
        let fillInline = element.getAttribute('fill');
        let fontsizeFinal = fontInline ? fontInline : fontSize;
        let colorFinal = fillInline ? fillInline : color;
        let yPosFinal = yInline !== '0%' ? yInline : posY + '%';
        let y = fontsizeFinal ? fontsizeFinal : 15;


        if (fontsizeFinal) {
            element.style.fontSize = fontsizeFinal;
        }
        if (colorFinal) {
            element.style.fill = colorFinal;
        }
        if (align) {
            element.style.textAnchor = align;
        }
        if (fontF) {
            element.style.fontFamily = fontF;
        }
        if (yPosFinal) {
            element.setAttribute("y", yPosFinal);
        }

        if (id === 'message-svg' || id === 'partner-desc-svg') {
            element.style.opacity = '0';
        }

        let text = element.innerHTML;
        text = text.replace(/(<([^>]+)>)/gi, "");
        text = text.replace("  ", " ");
        const words = text.split(' ');

        let line = '';

        //change line Height
        if (id === 'message-svg' || id === 'partner-desc-svg') {

            width = id === 'message-svg' ? svg.clientWidth / 1.3 : svg.clientWidth / 1.4;

            if (fontsizeFinal > 4 && fontsizeFinal < 6) {
                y = 7;
            } else {
                y = fontsizeFinal * 1.4;
            }
        }

        element.innerHTML = '<tspan id="temp"></tspan >';

        let arrayText = [];

        for (let n = 0; n < words.length; n++) {
            let testLine = line + words[n] + ' ';
            let testElem = document.getElementById('temp');
            testElem.innerHTML = testLine;
            let metrics = testElem.getBoundingClientRect();
            let testWidth = metrics.width;

            if (testWidth > width && n > 0) {
                element.innerHTML += '<tspan x="' + x + '%' + '" dy="' + y + '">' + line + '</tspan>';
                if (id === 'message-svg' || id === 'partner-desc-svg') {
                    arrayText.push(line);
                }
                line = words[n] + ' ';

            } else {
                line = testLine;
            }
        }


        if (id === 'partner-desc-svg') {
            linesTimeout();
        } else if (id === 'message-svg') {
            linesTimeout(3.1);
        }

        function linesTimeout(yVertical = 2.8, yHorizontal = 3.8) {
            setTimeout(() => {

                arrayText.push(line);
                document.querySelectorAll(`${step} > .svg > svg .multiline-text-${id}`).forEach(e => e.remove());

                let textY = Number(yPosFinal.slice(0, -1));


                for (let i = 0; i < arrayText.length; i++) {

                    if (id === 'partner-desc-svg' && i >= 6) {
                        break;
                    }
                    let calcY = textY + i * yVertical + '%';

                    if (ratio > 1.3 && ratio < 1.5) {
                        calcY = textY + i * yHorizontal + '%'
                    }

                    let html = '<text x="50%" y="' + calcY + '" ' +
                        'fill="#000000" font-size="' + fontsizeFinal + '" ' +
                        'dominant-baseline="middle" text-anchor="middle" class="multiline-text-' + id + '">' + '<tspan x="' + x + '%' + '" dy="' + y + '">' + arrayText[i] + '</tspan> </text>';
                    svg.innerHTML += html;
                }
            }, 10)
        }


        element.innerHTML += '<tspan x="' + x + '%' + '" dy="' + y + '">' + line + '</tspan>';


        document.getElementById("temp").remove();
    }
}

if (themeVars.isProduct) {
    steps.init();
}

async function redirectToCheckout(check = false) {
    let getState = localStorage.getItem('localState');
    const storage = JSON.parse(getState);

    if (check) {
        let isReceiversHasCreds = false;

        if (storage.forms.form4.receivers) {
            isReceiversHasCreds = true;
            storage.forms.form4.receivers.forEach(receiver => {
                if (!receiver.email && !receiver.sms && !receiver.whatsapp) {
                    isReceiversHasCreds = false;
                }
            });
        }

        if (!isReceiversHasCreds) return;
    }

    $('.l-checkout').css('display', 'none');
    $('.steps-list__item.step5').addClass('show-step');
    $('.loader-payment, .payment-from').addClass('loading');

    if (storage['template'] !== 'default1') {
        steps.updateLocalStorage($('.template-result > div.svg').clone(true, true).html(), 'template');
    }
    steps.updateLocalStorage($('.product').hasClass('magic-gift'), 'productType');

    if (storage.type == 'For Several Receivers') {
        $.ajax({
            type: 'post',
            url: themeVars.ajaxUrl,
            data: {
                'action': 'update_cart_quantity',
                'receiversQuantity': storage.forms.form4.receivers.length,
            },
            success: function (response) {
                window.location = themeVars.checkoutPage;
            },
        });
    } else {
        window.location = themeVars.checkoutPage + window.location.search;
    }
}

const productBanners = document.querySelectorAll('.woocommerce-checkout .product-steps');
if (productBanners.length) {
    let storage = steps.getLocalStorageArr();

    if (storage.type == 'For Me') {
        productBanners[0].style.display = 'none';
        productBanners[1].style.display = 'flex';
    }
}