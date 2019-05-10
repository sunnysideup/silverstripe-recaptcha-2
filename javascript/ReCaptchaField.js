'use strict';

function reCaptchaOnloadCallback() {
    var reCaptcha = document.querySelector('.g-recaptcha');
    var form = reCaptcha.closest('form');

    if (reCaptcha.dataset.size === 'invisible') {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            grecaptcha.execute();
        });
    }

    grecaptcha.render(reCaptcha, reCaptcha.dataset);
}

function reCaptchaOnSubmit(token) {
    var tokenField = document.querySelector('.g-recaptcha-response');
    var form = tokenField.closest('form');
    tokenField.value = token;
    form.submit();
}
