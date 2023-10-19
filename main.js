$(document).ready(function(){
    var ajax_url = "functions.php"

    //Se envian los datos del formulario al archivo functions.php para ser validados y almacenados en la base de datos
    $('form').submit(function(e){
        e.preventDefault();
        var user_name = $('#name').val();
        var user_nickname = $('#nickname').val();
        var rut = $('#rut').val();
        var email = $('#email').val();
        var region = $('#region').val();
        var commune = $('#commune').val();
        var candidate = $('#candidate').val();
        var web = $('#web').is(':checked') ? 1 : 0;
        var tv = $('#tv').is(':checked') ? 1 : 0;
        var social_media = $('#social_media').is(':checked') ? 1 : 0;
        var friend = $('#friend').is(':checked') ? 1 : 0;

        $.ajax({
            type: 'POST',
            url: ajax_url,
            data: {
                user_name: user_name,
                user_nickname: user_nickname,
                rut: rut,
                email: email,
                region: region,
                commune: commune,
                candidate: candidate,
                web: web,
                tv: tv,
                social_media: social_media,
                friend: friend,
                action: 'add_record'
            },
            dataType: "json",
            success: function(data) {
                alert(data.message)
                $('#name').val('');
                $('#nickname').val('');
                $('#rut').val('');
                $('#email').val('');
                $('#region').val('');
                $('#commune').val('');
                $('#candidate').val('');
                $('#web').prop('checked', false);
                $('#tv').prop('checked', false);
                $('#social_media').prop('checked', false);
                $('#friend').prop('checked', false);
            },
        });
    });

    //Se envía la Región seleccionada al archivo function.php para consultar las comunas asociadas a dicha región para modificar el 
    //combo box de Comuna, para mostrar unicamente las comunas pertenecientes a la región seleccionada
    $('#region').on('change', function() {
        var region = $('#region').val();
        var commune = $('#commune');

        $.ajax({
            type: 'POST',
            url: ajax_url,
            dataType: 'json',
            data: {
                'action': 'search_commune',
                'region': region,
            },
            beforeSend: function() {
                commune.empty();
                var default_option = $('<option></option>').attr('value', '').text('Seleccione su Comuna');
                commune.append(default_option);
                commune.prop("disabled", true);
            },
            success: function(response) {
                if (response.success) {
                    var data = response.message;
                    $.each(data, function(index, value) {
                        var option = $('<option></option>').attr('value', value.id).text(value.commune_name);
                        commune.append(option);
                    });
                }
            },
            complete: function() {
                commune.prop("disabled", false);
            }

        }); 
    });
});




