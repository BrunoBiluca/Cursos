var $ = require('jquery');

module.exports = function printTerms(terms) {
    $('body>dl').empty();
    $.each(terms, function () {
        $('<dt>').text(this.term).appendTo('body>dl');
        $('<dd>').text(this.defined).appendTo('body>dl');
    });
    $('dt').off('dblclick').dblclick(function() {
        $.ajax({
            url: '/dictionary-api/' + $(this).text(),
            type: 'DELETE',
            success: printTerms
        });
    });
};