/** global: grecaptcha */

(function (window, document) {
    'use strict';

    function init() {
        var element = document.createElement('script'),
            target = document.querySelectorAll('script')[0];
        element.type = 'text/javascript';
        element.src = httpProtocol() + '://www.google.com/recaptcha/api.js?onload=reCaptchaOnloadCallback&render=explicit&hl='.concat(window.SS_LOCALE);
        target.parentNode.insertBefore(element, target);
    }

    function httpProtocol() {
        return 'https:' == document.location.protocol ? 'https' : 'http';
    }

    function callback() {
        var reCaptcha = document.querySelector('.g-recaptcha');

        if (reCaptcha.dataset.size === 'invisible') {
            form().addEventListener('submit', formOnSubmit);
        }

        grecaptcha.render(reCaptcha, reCaptcha.dataset);
    }

    function submit(token) {
        document.querySelector('#'.concat(window.ReCaptchaFormId, ' .g-recaptcha-response')).value = token;
        form().submit();
    }

    function form() {
        return document.querySelector('#'.concat(window.ReCaptchaFormId));
    }

    function formOnSubmit(event) {
        event.preventDefault();
        grecaptcha.execute();
    }

    domReady(init);

    window.reCaptchaOnloadCallback = callback;
    window.reCaptchaOnSubmit = submit;
})(window, document);

