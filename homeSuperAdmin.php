<?php
session_start();
$usuario = $_SESSION['usuario']['nombre'];
$rolUsuario = $_SESSION['usuario']['rol'];
if ($usuario == null || $usuario == '') {
  header("location: index.php");
  die();
}
if($rolUsuario == 'Admin'){
  header("location: homeAdmin.php");
}
if($rolUsuario == 'Usuario'){
  header("location: homeUsuario.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Pagina Principal</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <link rel="stylesheet" href="css/paginaPrincipal.css">
  <link rel="icon" href="https://cutt.ly/UgKY2Lh">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="alertifyjs/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="alertifyjs/css/themes/default.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">


  <script src="js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
  <script src="funcionesPadron.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script src="alertifyjs/alertify.js"></script>

</head>

<body>
  <header class="enca">
    <div class="wrapper">
      <div class="logo">
        <a style="color: white;" href="homeSuperAdmin.php"> Castilla La Mancha</a>
      </div>
    </div>
    <nav>
      <?php
      $usuario = strtoupper($usuario);
      echo "<a style='color:white;font-size: 20px;text-align:center;margin-bottom:0;'>Bienvenido $usuario<sub> <i>$rolUsuario</i></sub></a>";
      ?>
      <a href="adminSuper.php">Administrar Usuarios</a>
      <a href="logica/logout.php">Cerrar Sesión</a>
    </nav>
  </header>

  <!--Efecto Parallax -->
  <section>
    <img src="img/lagunas.jpg" alt="" id="bg">
    <img src="img/primeraCapa.png" alt="" id="rocas">
    <h2 id="textPadron">Datos del Padrón</h2>
  </section>
  <!--Efecto Parallax -->
  <script type="text/javascript">
    let bg = document.getElementById("bg");
    let rocas = document.getElementById("rocas");
    let text = document.getElementById("textPadron");

    window.addEventListener('scroll', function() {
      var value = window.scrollY;

      bg.style.top = value + 0.5 + 'px';
      rocas.style.top = -value * 0.15 + 'px';
      text.style.top = value * 1 + 'px';
    })
  </script>

  <?php
  $conex = mysqli_connect("localhost", "root", "mario", "registro");
  ?>


  <button type="button" class="btn btn-primary" style="margin-left:570px;text-align:center" onclick="mostrarAmbosSexos();">Ambos Sexos</button>
  <button type="button" class="btn btn-primary" onclick="mostrarHombres();">Hombres</button>
  <button type="button" class="btn btn-primary" onclick="mostrarMujeres();">Mujeres</button>

  <!--Tabla Principal -->
  <div id="ambosSexos" class="row p-4">
    <div class="col-sm-12">
      <caption>
        <button style="margin-bottom:15px;" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistro">
          Agregar nuevo &nbsp;
          <i class="fas fa-plus-square"></i>
        </button>
      </caption>
      <h2 style="float:right;color:black;margin-right:600px;margin-top:20px;">Ambos Sexos</h2>
      <table id="tablax" class="table table-striped table-bordered  mt-2 table-sm">
        <thead>
          <td style="background:#42552b;color:white;">Edades</td>
          <td style="background:#42552b;color:white;">Castilla La Mancha</td>
          <td style="background:#42552b;color:white;">Albacete</td>
          <td style="background:#42552b;color:white;">Ciudad Real</td>
          <td style="background:#42552b;color:white;">Cuenca</td>
          <td style="background:#42552b;color:white;">Guadalajara</td>
          <td style="background:#42552b;color:white;">Toledo</td>
          <td style="background:#42552b;color:white;">Editar</td>
          <td style="background:#42552b;color:white;">Eliminar</td>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT id,edades,CastillaLaMancha,Albacete,CiudadReal,Cuenca,Guadalajara,Toledo FROM padron";
          $result = mysqli_query($conex, $sql);
          while ($ver = mysqli_fetch_row($result)) {
            $datos = $ver[0] . "||" . $ver[1] . "||" . $ver[2] . "||" . $ver[3] . "||" . $ver[4] . "||" . $ver[5] . "||" . $ver[6] . "||" . $ver[7];

          ?>
            <tr>
              <td><?php echo $ver[1] ?></td>
              <td><?php echo $ver[2] ?></td>
              <td><?php echo $ver[3] ?></td>
              <td><?php echo $ver[4] ?></td>
              <td><?php echo $ver[5] ?></td>
              <td><?php echo $ver[6] ?></td>
              <td><?php echo $ver[7] ?></td>
              <td>
                <button class="btn btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')">
                  <i class="far fa-edit"></i>
                </button>
              </td>
              <td>
                <button class="btn btn-danger"><i class="far fa-times-circle" onclick="preguntarSiNo(<?php echo $ver[0] ?>)"></i></button>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <!--Tabla Hombres -->
  <div style="display:none;" id="tablaHombre" class="row p-4">
    <div class="col-sm-12">
      <caption>
        <button style="margin-bottom:15px;" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistro">
          Agregar nuevo &nbsp;
          <i class="fas fa-plus-square"></i>
        </button>
      </caption>
      <h2 style="float:right;color:black;margin-right:600px;margin-top:20px;">Hombres</h2>
      <table style="width:100%" id="tablaHombres" class="table table-striped table-bordered  mt-2 table-sm">
        <thead>
          <td style="background:#42552b;color:white;">Edades</td>
          <td style="background:#42552b;color:white;">Castilla La Mancha</td>
          <td style="background:#42552b;color:white;">Albacete</td>
          <td style="background:#42552b;color:white;">Ciudad Real</td>
          <td style="background:#42552b;color:white;">Cuenca</td>
          <td style="background:#42552b;color:white;">Guadalajara</td>
          <td style="background:#42552b;color:white;">Toledo</td>
          <td style="background:#42552b;color:white;">Editar</td>
          <td style="background:#42552b;color:white;">Eliminar</td>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT id,edades,CastillaLaMancha,Albacete,CiudadReal,Cuenca,Guadalajara,Toledo FROM padronhombres";
          $result = mysqli_query($conex, $sql);
          while ($ver = mysqli_fetch_row($result)) {
            $datos = $ver[0] . "||" . $ver[1] . "||" . $ver[2] . "||" . $ver[3] . "||" . $ver[4] . "||" . $ver[5] . "||" . $ver[6] . "||" . $ver[7];

          ?>
            <tr>
              <td><?php echo $ver[1] ?></td>
              <td><?php echo $ver[2] ?></td>
              <td><?php echo $ver[3] ?></td>
              <td><?php echo $ver[4] ?></td>
              <td><?php echo $ver[5] ?></td>
              <td><?php echo $ver[6] ?></td>
              <td><?php echo $ver[7] ?></td>
              <td>
                <button class="btn btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')">
                  <i class="far fa-edit"></i>
                </button>
              </td>
              <td>
                <button class="btn btn-danger"><i class="far fa-times-circle" onclick="preguntarSiNo(<?php echo $ver[0] ?>)"></i></button>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <!--Tabla Mujeres -->
  <div style="display:none;" id="tablaMujeres" class="row p-4">
    <div class="col-sm-12">
      <caption>
        <button style="margin-bottom:15px;" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistro">
          Agregar nuevo &nbsp;
          <i class="fas fa-plus-square"></i>
        </button>
      </caption>
      <h2 style="float:right;color:black;margin-right:620px;margin-top:20px;">Mujeres</h2>
      <table  style="width:100%" id="tablaMujer" class="table table-striped table-bordered  mt-2 table-sm">
        <thead>
          <td style="background:#42552b;color:white;">Edades</td>
          <td style="background:#42552b;color:white;">Castilla La Mancha</td>
          <td style="background:#42552b;color:white;">Albacete</td>
          <td style="background:#42552b;color:white;">Ciudad Real</td>
          <td style="background:#42552b;color:white;">Cuenca</td>
          <td style="background:#42552b;color:white;">Guadalajara</td>
          <td style="background:#42552b;color:white;">Toledo</td>
          <td style="background:#42552b;color:white;">Editar</td>
          <td style="background:#42552b;color:white;">Eliminar</td>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT id,edades,CastillaLaMancha,Albacete,CiudadReal,Cuenca,Guadalajara,Toledo FROM padronmujeres";
          $result = mysqli_query($conex, $sql);
          while ($ver = mysqli_fetch_row($result)) {
            $datos = $ver[0] . "||" . $ver[1] . "||" . $ver[2] . "||" . $ver[3] . "||" . $ver[4] . "||" . $ver[5] . "||" . $ver[6] . "||" . $ver[7];

          ?>
            <tr>
              <td><?php echo $ver[1] ?></td>
              <td><?php echo $ver[2] ?></td>
              <td><?php echo $ver[3] ?></td>
              <td><?php echo $ver[4] ?></td>
              <td><?php echo $ver[5] ?></td>
              <td><?php echo $ver[6] ?></td>
              <td><?php echo $ver[7] ?></td>
              <td>
                <button class="btn btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')">
                  <i class="far fa-edit"></i>
                </button>
              </td>
              <td>
                <button class="btn btn-danger"><i class="far fa-times-circle" onclick="preguntarSiNo(<?php echo $ver[0] ?>)"></i></button>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <script type="text/javascript">
    function mostrarAmbosSexos() {
      document.getElementById("ambosSexos").style.display = "block";
      document.getElementById("tablaHombre").style.display = "none";
      document.getElementById("tablaMujeres").style.display = "none";
    }

    function mostrarHombres() {
      document.getElementById("tablaHombre").style.display = "block";
      document.getElementById("ambosSexos").style.display = "none";
      document.getElementById("tablaMujeres").style.display = "none";
    }

    function mostrarMujeres() {
      document.getElementById("ambosSexos").style.display = "none";
      document.getElementById("tablaHombre").style.display = "none";
      document.getElementById("tablaMujeres").style.display = "block";
    }
  </script>

  <!--Modal para registros nuevos -->
  <div class="modal fade" id="modalRegistro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Agrega nuevos datos</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table>
            <thead>
              <td style="margin:15px;text-align:center;"><label for="">Edades</label></td>
              <td style="margin:15px;text-align:center;"><label for="">Castilla La Mancha</label></td>
              <td style="margin:15px;text-align:center;"><label for="">Albacete</label></td>
              <td style="padding:5px;text-align:center;"><label for="">Ciudad Real</label></td>
              <td style="padding:5px;text-align:center;"><label for="">Cuenca</label></td>
              <td style="padding:5px;text-align:center;"><label for="">Guadalajara</label></td>
              <td style="padding:5px;text-align:center;"><label for="">Toledo</label></td>
            </thead>
            <tbody>
              <tr>
                <td style="padding:5px;"><input type="number" name="" id="edadesA" class="form-control input-sm"></td>
                <td style="padding:5px;"><input type="number" name="" id="castillaA" class="form-control input-sm"> </td>
                <td style="padding:5px;"><input type="number" name="" id="albaceteA" class="form-control input-sm"> </td>
                <td style="padding:5px;"><input type="number" name="" id="ciudadrealA" class="form-control input-sm"></td>
                <td style="padding:5px;"><input type="number" name="" id="cuencaA" class="form-control input-sm"> </td>
                <td style="padding:5px;"><input type="number" name="" id="guadalajaraA" class="form-control input-sm"> </td>
                <td style="padding:5px;"><input type="number" name="" id="toledoA" class="form-control input-sm"></td>
              </tr>
            </tbody>
          </table>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="guardarnuevo">
            Agregar
          </button>
        </div>
      </div>
    </div>
  </div>

  <!--Modal para editar registros -->
  <div class="modal fade" id="modalEdicion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Actualizar Datos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="text" hidden="" id="idpersona" name="">
          <label for="">Edades</label>
          <input type="text" name="" id="edadesu" class="form-control input-sm">
          <label for="">Castilla La Mancha</label>
          <input type="number" name="" id="castillau" class="form-control input-sm">
          <label for="">Albacete</label>
          <input type="number" name="" id="albaceteu" class="form-control input-sm">
          <label for="">Ciudad Real</label>
          <input type="number" name="" id="ciudadrealu" class="form-control input-sm">
          <label for="">Cuenca</label>
          <input type="number" name="" id="cuencau" class="form-control input-sm">
          <label for="">Guadalajara</label>
          <input type="number" name="" id="guadalajarau" class="form-control input-sm">
          <label for="">Toledo</label>
          <input type="number" name="" id="toledou" class="form-control input-sm">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" id="actualizadatos" data-dismiss="modal">
            Actualizar
          </button>
        </div>
      </div>
    </div>
  </div>

  <script src="js/rellax.min.js"></script>
  <script src="js/index.js"></script>
</body>

</html>

<script type="text/javascript">
  $(document).ready(function() {
    $('#guardarnuevo').click(function() {
      edades = $('#edadesA').val();
      castilla = $('#castillaA').val();
      albacete = $('#albaceteA').val();
      ciudadreal = $('#ciudadrealA').val();
      cuenca = $('#cuencaA').val();
      guadalajara = $('#guadalajaraA').val();
      toledo = $('#toledoA').val();
      agregardatos(edades, castilla, albacete, ciudadreal, cuenca, guadalajara, toledo);
    });

    $('#actualizadatos').click(function() {
      actualizaDatos();
    });

   
     $('#tablax').DataTable({
      lengthMenu: [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, 'All']
      ],
      language: {
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
          "copy": "Copiar",
          "colvis": "Visibilidad"
        }
      }
    });

    $('#tablaHombres').DataTable({
      lengthMenu: [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, 'All']
      ],
      language: {
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
          "copy": "Copiar",
          "colvis": "Visibilidad"
        }
      }
    });

    $('#tablaMujer').DataTable({
      lengthMenu: [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, 'All']
      ],
      language: {
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
          "copy": "Copiar",
          "colvis": "Visibilidad"
        }
      }
    });
  });
</script>