/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../scss/app.scss';
import './fontawesome';

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

function windowH() {
    const wH = $(window).height();
    $('.sidenav').css({height: wH});
    $('.surcontainer').css({height: wH});
}
windowH();

$("[data-toggle=popover]")
    .popover({html:true})

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});
