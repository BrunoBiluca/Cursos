$(function() {
    $('.j_loadstate').change(function() {
        var uf = $('.j_loadstate');
        var city = $('.j_loadcity');

        city.attr('disabled', 'true');
        uf.attr('disabled', 'true');
		
        city.html('<option value=""> Carregando cidades... </option>');

        $.post('../_cdn/ajax/city.php', {estado: $(this).val()}, function(cityes) {
            city.html(cityes).removeAttr('disabled');
            uf.removeAttr('disabled');
        });
    });
});