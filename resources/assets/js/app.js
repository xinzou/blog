/**
 * Created by simon on 15-12-15.
 */
window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');
$( document ).ready(function() {
    console.log($.fn.tooltip.Constructor.VERSION);
});