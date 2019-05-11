'use strict';

function contentLoaded(fn) {
    var done = false,
        top = true,
        doc = window.document,
        root = doc.documentElement,
        add = doc.addEventListener ? 'addEventListener' : 'attachEvent',
        rem = doc.addEventListener ? 'removeEventListener' : 'detachEvent',
        pre = doc.addEventListener ? '' : 'on',
        init = function init(e) {
            if (e.type == 'readystatechange' && doc.readyState != 'complete') return;
            (e.type == 'load' ? window : doc)[rem](pre + e.type, init, false);
            if (!done && (done = true)) fn.call(window, e.type || e);
        },
        poll = function poll() {
            try {
                root.doScroll('left');
            } catch (e) {
                setTimeout(poll, 50);
                return;
            }

            init('poll');
        };

    if (doc.readyState == 'complete') {
        fn.call(window, 'lazy');
    } else {
        if (doc.createEventObject && root.doScroll) {
            top = !window.frameElement;

            if (top) {
                poll();
            }
        }

        doc[add](pre + 'DOMContentLoaded', init, false);
        doc[add](pre + 'readystatechange', init, false);
        window[add](pre + 'load', init, false);
    }
}

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
        document.querySelector('#'.concat(window.ReCaptchaFormId)).addEventListener('submit', reCaptchaFormOnSubmit);
    }

    grecaptcha.render(reCaptcha, reCaptcha.dataset);
}

function reCaptchaOnSubmit(token) {
    document.querySelector('#'.concat(window.ReCaptchaFormId, ' .g-recaptcha-response')).value = token;
    document.querySelector('#'.concat(window.ReCaptchaFormId)).submit();
}

function reCaptchaFormOnSubmit(event) {
    event.preventDefault();
    grecaptcha.execute();
}

contentLoaded(reCaptchaInit);
