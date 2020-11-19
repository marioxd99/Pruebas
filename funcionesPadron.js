function motrarAmbosSexos() {
    alert("AMBOS");
    document.getElementByName('ambosSexos').style.display = "block";
    document.getElementByName('tablaHombre').style.display = "none";
    document.getElementByName('tablaMujeres').style.display = "none";
}

function mostrarHombres() {
    document.getElementByName('tablaHombre').style.display = "block";
    document.getElementByName('ambosSexos').style.display = "none";
    document.getElementByName('tablaMujeres').style.display = "none";
}

function mostrarMujeres() {
    document.getElementByName('ambosSexos').style.display = "block";
    document.getElementByName('tablaHombre').style.display = "none";
    document.getElementByName('tablaMujeres').style.display = "none";
}



function agregardatos(edades, castilla, albacete, ciudadreal, cuenca, guadalajara, toledo) {

    cadena = "edades=" + edades +
        "&CastillaLaMancha=" + castilla + "&Albacete=" + albacete + "&CiudadReal=" + ciudadreal + "&Cuenca=" + cuenca +
        "&Guadalajara=" + guadalajara + "&Toledo=" + toledo;

    $.ajax({
        type: "POST",
        url: "operacionesPadron/agregarDatos.php",
        data: cadena,
        success: function(r) {
            if (r == 1) {
                alertify.success("Agregado con exito :)");
            } else {
                alertify.error("Fallo el servidor :(");
            }
        }
    });

}

function agregaform(datos) {

    d = datos.split('||');

    $('#idpersona').val(d[0]);
    $('#edadesu').val(d[1]);
    $('#castillau').val(d[2]);
    $('#albaceteu').val(d[3]);
    $('#ciudadrealu').val(d[4]);
    $('#cuencau').val(d[5]);
    $('#guadalajarau').val(d[6]);
    $('#toledou').val(d[7]);


}

function actualizaDatos() {

    id = $('#idpersona').val();
    edades = $('#edadesu').val();
    castilla = $('#castillau').val();
    albacete = $('#albaceteu').val();
    ciudadreal = $('#ciudadrealu').val();
    cuenca = $('#cuencau').val();
    guadalajara = $('#guadalajarau').val();
    toledo = $('#toledou').val();

    cadena = "id=" + id + "&edades=" + edades +
        "&CastillaLaMancha=" + castilla + "&Albacete=" + albacete + "&CiudadReal=" + ciudadreal + "&Cuenca=" + cuenca +
        "&Guadalajara=" + guadalajara + "&Toledo=" + toledo;

    console.log(cadena)
    $.ajax({
        type: "POST",
        url: "operacionesPadron/actualizaDatos.php",
        data: cadena,
        success: function(r) {
            if (r == 1) {
                alertify.success("Actualizado con exito :)");
            } else {
                alertify.error("Fallo el servidor :(");
            }
        }
    });

}

function preguntarSiNo(id) {
    alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este registro?',
        function() { eliminarDatos(id) },
        function() { alertify.error('Operacion Cancelada') });
}

function eliminarDatos(id) {

    cadena = "id=" + id;

    $.ajax({
        type: "POST",
        url: "operacionesPadron/eliminarDatos.php",
        data: cadena,
        success: function(r) {
            if (r == 1) {
                alertify.success("Eliminado con exito!");
            } else {
                alertify.error("Fallo el servidor :(");
            }
        }
    });
}