// require('./bootstrap');
// window.$ = require('jquery');
try {
    require('bootstrap');
    window.$ = window.jQuery = require('jquery');
    require('datatables');
} catch (e) {
}
