/** global: grecaptcha */

(function (window, document) {
    'use strict';

    function reCaptchaInit() {
        var element = document.createElement('script'),
            target = document.querySelectorAll('script')[0],
            protocol = 'https:' == document.location.protocol ? 'https' : 'http';
        element.type = 'text/javascript';
        element.src = protocol + '://www.google.com/recaptcha/api.js?onload=reCaptchaOnloadCallback&render=explicit&hl='.concat(window.SS_LOCALE);
        target.parentNode.insertBefore(element, target);
    }

    function reCaptchaOnloadCallback() {
        var reCaptcha = document.querySelector('.g-recaptcha');

        if (reCaptcha.dataset.size === 'invisible') {
            reCaptchaForm().addEventListener('submit', reCaptchaFormOnSubmit);
        }

        grecaptcha.render(reCaptcha, reCaptcha.dataset);
    }

    function reCaptchaOnSubmit(token) {
        document.querySelector('#'.concat(window.ReCaptchaFormId, ' .g-recaptcha-response')).value = token;
        reCaptchaForm().submit();
    }

    function reCaptchaForm() {
        return document.querySelector('#'.concat(window.ReCaptchaFormId));
    }

    function reCaptchaFormOnSubmit(event) {
        event.preventDefault();
        grecaptcha.execute();
    }

    domReady(reCaptchaInit);

    window.reCaptchaOnloadCallback = reCaptchaOnloadCallback;
    window.reCaptchaOnSubmit = reCaptchaOnSubmit;
})(window, document);

