@extends('layouts.app')
@include('layouts.menu_oficial')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
<h3 align="center">BUSQUEDA DE DATOS DE EMPRESA</h1>
{{-- <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script> --}}

<link rel="stylesheet" type="text/css" href="{{asset('otros/datatable/jquery.dataTables.min.css')}}" >
<script src="{{ asset('otros/datatable/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('otros/datatable/dataTables.buttons.min.js') }}" defer></script>
<script src="{{ asset('otros/datatable/jszip.min.js') }}" defer></script>
<script src="{{ asset('otros/datatable/pdfmake.min.js') }}" defer></script>
<script src="{{ asset('otros/datatable/vfs_fonts.js') }}" defer></script>
<script src="{{ asset('otros/datatable/buttons.html5.min.js') }}" defer></script>
<script src="{{ asset('otros/datatable/buttons.print.min.js') }}" defer></script>

<div class="container">
    <br>
<!--Alerta si hubo modificacion de usuario-->
               @isset($errorpersona)
                    <div class="alert alert-danger" role="alert">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"  align="center"><span aria-hidden="true">&times;</span></button> {{ $errorpersona }}</div>
                   <script type="text/javascript">
                       window.setTimeout(function() {
                                $(".alert").fadeTo(300, 0).slideUp(400, function(){
                                    $(this).remove();
                                });
                            }, 20000);
                   </script>
                   @unset($errorpersona);
                @endisset


                @isset($erroruser)
                    <div class="alert alert-danger" role="alert">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"  align="center"><span aria-hidden="true">&times;</span></button> {{ $erroruser }}</div>
                   <script type="text/javascript">
                       window.setTimeout(function() {
                                $(".alert").fadeTo(300, 0).slideUp(400, function(){
                                    $(this).remove();
                                });
                            }, 20000);
                   </script>
                   @unset($erroruser);
                @endisset

                @isset($msjcargado)
                    <div class="alert alert-success" role="alert">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"  align="center"><span aria-hidden="true">&times;</span></button> {{ $msjcargado }}</div>
                   <script type="text/javascript">
                       window.setTimeout(function() {
                                $(".alert").fadeTo(300, 0).slideUp(400, function(){
                                    $(this).remove();
                                });
                            }, 20000);
                   </script>
                   @unset($msjcargado);
                @endisset

               @isset($msjbaja)
                    <div class="alert alert-danger" role="alert">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"  align="center"><span aria-hidden="true">&times;</span></button> {{ $msjbaja }}</div>
                   <script type="text/javascript">
                       window.setTimeout(function() {
                                $(".alert").fadeTo(300, 0).slideUp(400, function(){
                                    $(this).remove();
                                });
                            }, 20000);
                   </script>
                   @unset($msjbaja);
                @endisset

                    @isset($msjactivado)
                    <div class="alert alert-success" role="alert">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"  align="center"><span aria-hidden="true">&times;</span></button> {{ $msjactivado }}</div>
                   <script type="text/javascript">
                       window.setTimeout(function() {
                                $(".alert").fadeTo(300, 0).slideUp(400, function(){
                                    $(this).remove();
                                });
                            }, 20000);
                   </script>
                   @unset($msjactivado);
                @endisset

<!--Boton de Alta de empresa nivel 1-->
            <a href="alta_empresa" button class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i>Alta de Empresa</button></a>
            <p></p>
<!--Estructura de columnas para Datatables-->
            <table class="table table-bordered" id="table">

               <thead>
                  <tr>
                     <th>Cédula</th>
                     <th>Nombres</th>
                     <th>Apellidos</th>
                     <th>Correo</th>
                     <th>Estado</th>
                     <th>Acciones</th>
                 </tr>
  <!--Javascript de Datatables-->
<script type="text/javascript">
     $(document).ready(function ()  {
     var datatable = $('#table').DataTable
     ({
       dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ],
        processing: true,
        serverSide: true,
        ajax: '{{ url('oficial/datatableempresa') }}',
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
                                $('td', row).eq(5).html("<button type='button' class='modif btn btn-info'>Editar<span class='glyphicon glyphicon-edit'></span> </button>"+" "+"<button type='button' class='act btn btn-success'>Activar<span class='glyphicon glyphicon-circle-arrow-up'></span> </button>");

                              } else {
                                $('td', row).eq(4).addClass('text-success').text('Activo');
                                $('td', row).eq(5).html("<button type='button' class='modif btn btn-info'>Editar<span class='glyphicon glyphicon-edit'></span> </button>"+" "+"<button type='button' class='baj btn btn-danger'>Desactivar<span class='glyphicon glyphicon-circle-arrow-down'></span> </button>");
                              }
                            },
        columns: [
                        { data: 'cedula', name: 'cedula' },
                        { data: 'nombres', name: 'nombres' },
                        { data: 'apellidos', name: 'apellidos'},
                        { data: 'correo', name: 'correo'},
                        { data: 'estado', name: 'estado'},
                        {"defaultContent": "<button type='button' class='modif btn btn-success'>Editar<span class='glyphicon glyphicon-edit'></span> </button>"+" "+"<button type='button' class='baj btn btn-danger'>Baja<span class='glyphicon glyphicon-circle-arrow-down'></span> </button>"},
                 ]

    });

            /*Javascript para captura de la cedula y redirección a la ruta para modificación*/

            $('#table').on('click', 'button.modif', function(){
                var data = datatable.row( $(this).closest('tr') ).data();
                     var cedula=( data['cedula']);
                     window.location.href = '{{url("oficial/modificacion_empresa")}}'+'/'+cedula;
            });

            /*Javascript para captura de la cedula y redirección a la ruta para baja de empleado*/
            $('#table').on('click', 'button.baj', function(){
                var data = datatable.row( $(this).closest('tr') ).data();
                     var cedula=( data['cedula']);
                     window.location.href = '{{url("oficial/desactivar_empresa")}}'+'/'+cedula;
            });

            /*Javascript para captura de la cedula y redirección a la ruta para baja de empleado*/
            $('#table').on('click', 'button.act', function(){
                var data = datatable.row( $(this).closest('tr') ).data();
                     var cedula=( data['cedula']);
                     window.location.href = '{{url("oficial/activar_empresa")}}'+'/'+cedula;
            });

/*Cierre de llave de javascript del datatables*/
});
</script>

@endsection