'use strict';

function domReady(fn) {
    var fns = [],
        listener,
        doc = typeof document === 'object' && document,
        hack = doc && doc.documentElement.doScroll,
        domContentLoaded = 'DOMContentLoaded',
        loaded = doc && (hack ? /^loaded|^c/ : /^loaded|^i|^c/).test(doc.readyState);

    if (!loaded && doc) {
        doc.addEventListener(domContentLoaded, listener = function () {
            doc.removeEventListener(domContentLoaded, listener);
            loaded = 1;
            while (listener = fns.shift()) {
                listener();
            }
        })
    }

    if (loaded) {
        setTimeout(fn, 0);
    } else {
        fns.push(fn);
    }
}
