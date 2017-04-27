//Art Reset
$('.htmlchars img').each(function() {
    var width = $('.htmlchars').innerWidth();
    $(this).removeAttr('width').removeAttr('height').css('max-width',width);
});

$('.htmlchars iframe').each(function() {
    var url = $(this).attr("src");
    var char = "?";
    if (url.indexOf("?") != -1) {
        var char = "&";
    }

    var iw = $(this).width();
    var ih = $(this).height();
    var width = $('.htmlchars').width();
    var height = (width * ih) / iw;
    $(this).attr({'width': width, 'height': height + 'px', 'src': url + char + 'wmode=transparent'});
});

//Monta o Slide
$('.main-slider .slidecount').cycle({
    fx: 'fade',
    speed: 1000,
    timeout: 3000,
    pager: '.slidenav'
});

//Inicia a shadowbox
Shadowbox.init();
