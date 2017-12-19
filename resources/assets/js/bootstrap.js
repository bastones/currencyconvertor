/**
 * Lodash Library
 */
window._ = require('lodash');

/**
 * jQuery Library
 */
window.$ = window.jQuery = require('jquery');

/**
 * Bootstrap Library
 */
require('bootstrap');

/**
 * Axios Library
 */
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * CSRF Token
 */
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found.');
}
