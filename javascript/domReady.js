'use strict';

function domReady(fn) {
    var fns = [],
        loaded = domLoaded();

    domAddEventListener(fns, loaded);
    domHandleCallback(loaded, fns, fn);
}

function domLoaded() {
    return (document.documentElement.doScroll ? /^loaded|^c/ : /^loaded|^i|^c/).test(document.readyState);
}

function domAddEventListener(fns, loaded) {
    var listener;

    if (!loaded) {
        document.addEventListener('DOMContentLoaded', listener = function () {
            document.removeEventListener('DOMContentLoaded', listener);
            loaded = true;
            while (listener = fns.shift()) {
                listener();
            }
        })
    }
}

function domHandleCallback(loaded, fns, fn) {
    if (loaded) {
        setTimeout(fn, 0);
    } else {
        fns.push(fn);
    }
}
