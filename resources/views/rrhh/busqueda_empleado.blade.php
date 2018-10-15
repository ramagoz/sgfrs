@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
@include('layouts.menu_rrhh')
    
<html >
<head>
   
        <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<style type="text/css">
  div.container {
        width: 65%;
    }
  </style>
    
</head>

    <h3 align="center">BUSQUEDA DE EMPLEADO</h1>
    <p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>
        <div class="container">
            <a href="alta_empleado" button class="btn btn-success"><i class="glyphicon glyphicon-plus"></i>Alta de Usuario</button></a>
            <table class="table table-bordered" id="table">
                
               <thead>
                  <tr>
                     <th>Cédula</th>
                     <th>Nombres</th>
                     <th>Apellidos</th>
                     <th>Correo</th>
                     <th>Acciones</th>
                 </tr>
                          
           
         
<script type="text/javascript">
     $(document).ready(function ()  {
     var datatable = $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url('rrhh/datatable') }}',
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
        columns: [
                        { data: 'cedula', name: 'cedula' },
                        { data: 'nombres', name: 'nombres' },
                        { data: 'apellidos', name: 'apellidos'},
                        { data: 'correo', name: 'correo'},
                        {"defaultContent": "<button type='button' class='modif btn btn-success'>Editar<span class='glyphicon glyphicon-edit'></span> </button>"+" "+"<button type='button' class='baj btn btn-danger'>Baja<span class='glyphicon glyphicon-circle-arrow-down'></span> </button>"},
                        
                       
                        
                    ]


    });
 
$('#table').on('click', 'button.modif', function(){
    var data = datatable.row( $(this).closest('tr') ).data();
         var cedula=( data['cedula']);
         window.location.href = '{{url("rrhh/modificacion_empleado")}}'+'/'+cedula;

 

});
$('#table').on('click', 'button.baj', function(){
    var data = datatable.row( $(this).closest('tr') ).data();
         var cedula=( data['cedula']);
         window.location.href = '{{url("rrhh/baja_empleado")}}'+'/'+cedula;

 

});

});


</script>

</body>
</html>
@endsection

