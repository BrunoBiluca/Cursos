var $ = require("jquery");
var printTerms = require("./lib/printTerms");

$(document).ready(function () {

    $.getJSON('/dictionary-api', printTerms);
    $('form').submit(e => {
        e.preventDefault();
        $.post('/dictionary-api', {term: $('#term').val(), defined: $('#defined').val()}, printTerms);
        document.forms[0].reset();
    });

    alert("Hello's World");

});
