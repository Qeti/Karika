"use strict";

/**
 * Put the browser history in its own module so it can be accessed anywhere in the
 * application.
 */

import createBrowserHistory from 'history/lib/createBrowserHistory'

export default createBrowserHistory({
});