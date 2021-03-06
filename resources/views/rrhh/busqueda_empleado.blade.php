@extends('layouts.app')
@section('content')
@include('layouts.menu_rrhh')
<script src="{{ asset('otros/datatable/jquery.dataTables.min.js') }}" defer></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>  
<div class="container">
    <p></p>
    <div class="page-header">
        <h2>ABM Usuario Empleados</h2>
    </div>
      <p></p>
       
     <div class="container"><br>
<!--Alerta si hubo modificacion de usuario-->
        @isset($msj)
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"  align="center">
                        <span aria-hidden="true">&times;</span>
                    </button> {{ $msj }}
                </div>
                    <script type="text/javascript">window.setTimeout(function() {$(".alert").fadeTo(300, 0).slideUp(400, function(){$(this).remove(); });}, 4000);
                    </script>
            @unset($msj);
        @endisset
     

<<<<<<< HEAD
<div class="container-fluid">

  <div class="page-header">
      <h2>ABM usuario Empleados</h2>
  </div>

    @isset($msj)
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ $msj }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
    @endisset

    @isset($error)
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ $error }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
    @endisset

  <table class="table table-sm compact" border="1" id="table">
     <thead class="thead-dark">
        <tr>
           <th>Cédula</th>
           <th>Nombres</th>
           <th>Apellidos</th>
           <th>Correo</th>
           <th>Estado</th>
           <th>Actualizar datos</th>
       </tr>
      </thead>
  </table>

  <a href="alta_empleado" button class="btn btn-primary">Alta de Empleado</a>
  <!--Javascript de Datatables-->
  <script type="text/javascript">
       $(document).ready(function ()  {
       var datatable = $('#table').DataTable
       ({
          processing: true,
          serverSide: true,
          ajax: '{{ url('rrhh/datatable') }}',
          "lengthMenu": [[7, 25, 50, -1], [7, 25, 50, "All"]],
          "language": {
                          "sProcessing":     "Procesando...",
                          "sLengthMenu":     "Mostrar _MENU_ registros",
                          "sZeroRecords":    "No se encontraron resultados",
                          "sEmptyTable":     "Ningún dato disponible en esta tabla",
                          "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                          "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                          "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                          "sInfoPostFix":    "",
                          "sSearch":         "Buscar:",
                          "sUrl":            "",
                          "sInfoThousands":  ",",
                          "sLoadingRecords": "Cargando...",
                          "oPaginate": {
                              "sFirst":    "Primero",
                              "sLast":     "Último",
                              "sNext":     "Siguiente",
                              "sPrevious": "Anterior"
                          },
                          "oAria": {
                              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                          }
                      },
                    createdRow: function ( row, data, index ) {
                                if ( data.estado == 0 ) {
                                  $('td', row).eq(4).addClass('text-danger').text('Inactivo');
                                  $('td', row).eq(5).html("<button type='button' class='modif btn btn-info btn-block'>Actualizar</button>");

                                } else {
                                  $('td', row).eq(4).addClass('text-success').text('Activo');
                                  $('td', row).eq(5).html("<button type='button' class='modif btn btn-info btn-block'>Actualizar</button>");
                                }
                              },
          columns: [
                          { data: 'cedula', name: 'cedula' },
                          { data: 'nombres', name: 'nombres' },
                          { data: 'apellidos', name: 'apellidos'},
                          { data: 'correo', name: 'correo'},
                          { data: 'estado', name: 'estado'},
                          {"defaultContent": "<button type='button' class='modif btn btn-info btn-block'>Actualizar</button>"},
                   ]
      });

          /*Javascript para captura de la cedula y redirección a la ruta para modificación*/
=======
    <!--Estructura de columnas para Datatables-->
    <table class="table table-sm compact" border="1" id="table">
        <a href="alta_empleado" button class="btn btn-success">Alta de Empleado</a>
        <thead class="thead-dark" >
            <tr>
                <th>Cédula</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Celular</th>
                <th>Estado</th>
                <th>Accion</th>
            </tr>  
        </thead>  
>>>>>>> fe3a6fd3e9ee6c1656a95444b90d95f0c08ae895

<!--Javascript de Datatables-->                
        <script type="text/javascript">
                    $(document).ready(function ()
                    {var datatable = $('#table').DataTable
                      ({processing: true,
                        serverSide: true,
                        ajax: '{{ url('rrhh/datatable') }}',
                        "language":
                         {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "Ningún dato disponible en esta tabla",
                            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)","sInfoPostFix":    "",
                            "sSearch":         "Buscar:",
                            "sUrl":            "",
                            "sInfoThousands":  ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {"sFirst":    "Primero","sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"},
                            "oAria": {"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"}},
                                createdRow: function ( row, data, index ) 
                                    {
                                        if( data.estado == 0 ) {$('td', row).eq(5).addClass('text-danger').text('Inactivo');}
                                        else {$('td', row).eq(5).addClass('text-success').text('Activo');}
                                     },
                                         columns: 
                                         [
                                             { data: 'cedula', name: 'cedula' },
                                             { data: 'nombres', name: 'nombres' },
                                             { data: 'apellidos', name: 'apellidos'},
                                             { data: 'correo', name: 'correo'},
                                             { data: 'cel', name: 'cel'},
                                             { data: 'estado', name: 'estado'},
                                             {"defaultContent": "<button type='button' class='modif btn btn-warning'>Editar<span class='glyphicon glyphicon-edit'></span> </button>"},
                                          ]
                        });
                      /*Javascript para captura de la cedula y redirección a la ruta para modificación*/
                      $('#table').on('click', 'button.modif', function(){var data = datatable.row( $(this).closest('tr') ).data();var cedula=( data['cedula']);window.location.href = '{{url("rrhh/modificacion_empleado")}}'+'/'+cedula;});
                      /*Javascript para captura de la cedula y redirección a la ruta para alta de empleado*/
                      $('#table').on('click', 'button.alt', function(){var data = datatable.row( $(this).closest('tr') ).data();window.location.href = '{{url("rrhh/alta_empleado")}}';});
                    /*Cierre de llave de javascript del datatables*/
                    });
            </script>
@endsection