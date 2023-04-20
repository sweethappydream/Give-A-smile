const $ = window.jQuery;

$('.js-check-giftcard').submit((e) => {
    e.preventDefault();
    const $selectProject = $('#projects-gift');
    let giftcard_id = $('.js-check-giftcard input').val();
    let data = {
        action: 'check_giftcard',
        giftcard_id: giftcard_id,
    };

    $.ajax({
        type: 'post',
        url: themeVars.ajaxUrl,
        data: data,
        success: function (response) {
            let valCard = response;

            if (response === '0' || !response) {
                valCard = 0;
            }

            if (valCard != 0) {
                $('.js-check-giftcard .u-btn').hide();
                $('.js-check-giftcard-answer').show();
                $('.c-price > span.amount').html(valCard);
                $('.js-check-giftcard-answer--error').hide();

                // hide/show btn select projects if card has a cost > 0
                if (valCard == 0) {
                    $selectProject.hide();
                } else {
                    let href = $selectProject.attr('href');
                    $selectProject.attr('href', href + '?gift=' + giftcard_id)
                    $selectProject.show();
                }
            } else {
                $('.js-check-giftcard-answer--error').show();
            }
        },
    });
});

$('.js-check-giftcard-cancel-code').on('click', function (e) {
    e.preventDefault();
    const $selectProject = $('#projects-gift');
    const href = $selectProject.attr('href');

    $selectProject.attr('href', href.split('?')[0]);

    $('.js-check-giftcard .u-btn').show();
    $('.js-check-giftcard-answer').hide();
});
