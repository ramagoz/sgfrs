@extends('layouts.app')
@section('content')
@include('layouts.menu_oficial')

<link rel="stylesheet" type="text/css" href="{{asset('otros/datatable/jquery.dataTables.min.css')}}" >
<script src="{{ asset('otros/datatable/jquery.dataTables.min.js') }}" defer></script>

<div class="container">

    <div class="page-header">
        <h2>Registros de Auditoria</h2>
    </div>

    <table class="table table-sm compact" border="1" id="table">
        <thead class="thead-dark">
          <tr>
             <th>Fecha y hora</th>
             <th>Cedula</th>
             <th>Rol</th>
             <th>IP</th>
             <th>Operación</th>
             <th>Descripción</th>
         </tr>
        </thead>
    </table>

    <!--Javascript de Datatables-->
    <script type="text/javascript">
         $(document).ready(function ()  {
         var datatable = $('#table').DataTable
         ({
            processing: true,
            serverSide: true,
            ajax: '{{ url('oficial/datatableauditoria') }}',
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
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
            "order": [
            [ 0, "desc" ],
                        ],
            columns: [
                            { data: 'fecha_hora', name: 'fecha_hora' },
                            { data: 'cedula', name: 'cedula'},
                            { data: 'rol', name: 'rol'},
                            { data: 'ip', name: 'ip'},
                            { data: 'operacion', name: 'operacion'},
                            { data: 'descripcion', name: 'descripcion'},
                     ]
        });

    /*Cierre de llave de javascript del datatables*/
    });
    </script>


</div>

@endsection