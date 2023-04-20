const $ = window.jQuery;

window.addEventListener('DOMContentLoaded', () => {
    const checkoutForm = document.querySelector('.checkout.woocommerce-checkout');
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', (e) => {
            localStorage.setItem('billingName', e.target.querySelector('#sender-name').value);
        });
    }
});

const isThankYouPage = $('body').hasClass('page-template-template-thank-you');
if (isThankYouPage) {
    const params = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
    });

    let getState = localStorage.getItem('localState');
    const storage = JSON.parse(getState);


    if (params.order_id && storage) {
        let sender_name = storage.forms.form4['sender-name'];
        let sender_phone = storage.forms.form4['sender-phone'];
        let receivers = storage.forms.form4.receivers;
        let merged = {...storage.forms.form3, ...storage.forms.form4};
        let productType = storage.productType;

        let template;
        if (storage['type'] === 'For Me') {
            template = '';
            sender_name = '';
        } else {
            template = storage['template'];
        }

        if (storage['type'] === 'For One Receiver') {
            sender_name = storage.forms.form3["receiver-name"];
        }

        if (storage['type'] === 'For Several Receivers') {
            for (let i = 0; i < receivers.length; i++) {
                const id = receivers[i].id;
                const receiverName = storage.forms.form3.receivers;

                if (receiverName) {
                    receivers[i].name = receiverName[id]['receiver-name'];
                }
            }
        }

        if (storage['time_send'] != 'now') {
            const sendDate = new Date(storage['time_send']);
            sendDate.setMinutes(sendDate.getTimezoneOffset());
            storage['time_send'] = (sendDate.getMonth() + 1) + '/' + sendDate.getDate() + '/' + sendDate.getFullYear() + ' ' + sendDate.getHours() + ':00';
        }

        $.ajax({
            type: 'POST',
            url: themeVars.ajaxUrl,
            cache: false,
            crossDomain: true,
            data: {
                'action': 'ajax_order',
                'orderId': params.order_id,
                'template': $.trim(template),
                'receivers': receivers,
                'type_send': storage['type'],
                'sender_name': sender_name,
                'sender_phone': sender_phone,
                'steps_fields': merged,
                'magic_gift': productType,
                'lang': storage['lang'],
                'amount': storage['price'],
                'time_send': storage['time_send'],
                'billing_name': localStorage.getItem('billingName'),
            },
            beforeSend: function () {
                localStorage.removeItem('localState');
                localStorage.removeItem('billingName');
            },
            success: get_content,
            error: error => console.log(error),
        });
    } else {
        get_content();
    }

    function get_content() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);

        const data = {
            action: "thank_you_content",
            order_id: params.order_id,
            //page_id: 835,
            orderKey: urlParams.get('key'),
        };

        $.ajax({
            url: themeVars.ajaxUrl,
            data: data,
            type: "POST",
            success: (response) => {
                $(".thank_you_cards_box").html(response);
            }
        })
    }
}