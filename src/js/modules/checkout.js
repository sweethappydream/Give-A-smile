const $ = window.jQuery;

$('body').on('click','li.wc_payment_method',function (){
    $(this).addClass('is-active');
    $('li.wc_payment_method').not($(this)).removeClass('is-active');
});

let checkoutForm = $('form.woocommerce-checkout');

if (checkoutForm.length){
    checkoutForm.submit(function (e){
        e.preventDefault();

        return false;
    });
}

const tipTable = $('.l-checkout__total .product-tip');
if (tipTable.length) {
    const body = $('body');
    const productPrice = parseInt($('.l-checkout__total-body .woocommerce-Price-amount.amount bdi').text());
    const totalPrice = parseInt($('.l-checkout__total-bottom .woocommerce-Price-amount.amount bdi').text());
    const productQuantity = parseInt($('.l-checkout__total-body .product-quantity').text().replace(/^\D+/g, ''));
    const mainTipsInput = tipTable.find('.product-total input');
    const currency = $('.l-checkout__total-bottom .woocommerce-Price-currencySymbol');

    if (localStorage.getItem('tip')) {
        mainTipsInput.val(localStorage.getItem('tip'));
        changeTotal();
    }

    body.on('click', '.l-checkout__total .product-tip .tip-add', function () {
        const thisTable = $(this).parents('.product-tip');
        $(this).removeClass('show');

        thisTable.find('.tip-finish').addClass('show');
        mainTipsInput[0].readOnly = false;
        mainTipsInput.focus();
    });

    body.on('click', '.l-checkout__total .product-tip .tip-finish', function () {
        const thisTable = $(this).parents('.product-tip');
        const total = mainTipsInput;
        const error = thisTable.find('.tip-error');

        if (total.val() >= 1) {
            $(this).removeClass('show');
            thisTable.find('.tip-add').addClass('show');
            total[0].readOnly = true;
            total.addClass('edited');
            error.removeClass('show');
            changeTotal();
        } else {
            error.addClass('show');
        }
    });
    
    
    
    // tips popup function
    const tipForm = $('#tip-form');
    if (tipForm.length) {
        const tipFormLabels = tipForm.find('label');
        const tiFormInput = tipForm.find('.u-btn');

        if (tipFormLabels.length) {
            tipFormLabels.on('click', function () {
                const inputId = $(this).attr('for');
                const inputVal = tipForm.find('#' + inputId).val();

                tiFormInput.val(Math.floor(totalPrice * inputVal / 100));
            });
        }

        tipForm.on('submit', e => {
            e.preventDefault();
            if (tiFormInput.val() >= 1) {
                mainTipsInput.val(tiFormInput.val());

                tiFormInput.closest("#add-tip").find('.c-modal__close').trigger('click');
                changeTotal();
            }
        });
    }

    function changeTotal() {
        const total = $('.l-checkout__total-bottom').find('.woocommerce-Price-amount.amount bdi');

        let allPrice = productPrice * productQuantity + parseInt(mainTipsInput.val());
        let coupone = $('#coupon');
        let maxCouponeValue = coupone.attr('data-coupon-amount');

        if(maxCouponeValue){
            if(maxCouponeValue > allPrice){
                coupone.find('.magic-discount').text(allPrice + ' ₪');
                total.text(0);
            } else{
                coupone.find('.magic-discount').text(maxCouponeValue + ' ₪');
                total.text(allPrice - maxCouponeValue);
            }
        }else{
            total.text(allPrice);
        }

        total.append(currency);
        localStorage.setItem('tip', mainTipsInput.val());
    }
}

if (themeVars.isProduct) {
    localStorage.removeItem('tip');
}