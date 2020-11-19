jQuery(document).on('submit', '#formLog', function(event) {
    event.preventDefault();

    jQuery.ajax({
            url: 'logica/loguear.php',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function() {
                $('.btninicio').val('Validando...');
            }
        })
        .done(function(respuesta) {
            console.log(respuesta);
            if (!respuesta.error) {
                if (respuesta.rol == 'SuperAdmin') {
                    location.href = 'homeSuperAdmin.php';
                } else if (respuesta.rol == 'Admin') {
                    location.href = 'homeAdmin.php';
                } else if (respuesta.rol == 'Usuario') {
                    location.href = 'homeUsuario.php';
                }
            } else {
                $('.error').slideDown('slow');
                setTimeout(function() {
                    $('.error').slideUp('slow');
                }, 3500);
                $('.btninicio').val('Iniciar Sesion');
            }
        })
        .fail(function(resp) {
            alertify.error('Usuario o Contraseña Incorrecta');
        })
        .always(function() {
            console.log("complete");
        });
});