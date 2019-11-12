@extends('layouts.app')
@include('layouts.menu_oficial')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}

<h3 align="center">AUDITORIA</h1>

<head>
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

<style type="text/css">
  div.container {
        width: 90%;
    }
</style>

</head>

<div class="container">
<!--Estructura de columnas para Datatables-->
            <table class="table table-bordered" id="table">

               <thead>
                  <tr>
                     <th>Id</th>
                     <th>Fecha y Hora</th>
                     <th>Cedula</th>
                     <th>Rol</th>
                     <th>IP</th>
                     <th>Operación</th>
                     <th>Descripción</th>
                 </tr>
</div>
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
        ajax: '{{ url('oficial/datatableauditoria') }}',
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
                        { data: 'id_auditoria', name: 'id_auditoria' },
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

@endsection