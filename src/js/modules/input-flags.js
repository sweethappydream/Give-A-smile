const $ = window.jQuery;
import intlTelInput from 'intl-tel-input';

// const phone = $('input[name=sms-value]');
// const watsapp = $('input[name=whatsapp-value]');

const smsInputs = [...document.querySelectorAll("input[name*=sms-value]")];
if (smsInputs.length)
    smsInputs.forEach(input => phoneCountryPrefix(input));

const whatsappInput = [...document.querySelectorAll("input[name*=whatsapp-value]")];
if (whatsappInput.length)
    whatsappInput.forEach(input => phoneCountryPrefix(input));

function phoneCountryPrefix(input) {
    if (input) {
        let phoneCountry = intlTelInput(input, {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.18/js/utils.js",
            preferredCountries: ["il", 'us']
        });

        input.addEventListener("input", function () {
            this.value = phoneCountry.getNumber(intlTelInputUtils.numberFormat.E164);
        });
    }
}

export default phoneCountryPrefix;
