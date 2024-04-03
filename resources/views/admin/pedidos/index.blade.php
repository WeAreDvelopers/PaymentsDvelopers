@extends('layouts.app')

@section('assets')

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<!-- CSS Modal Pedido-->
<link href="{{asset('css/modal-pedido.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
   
        <div class="card">
            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-7 ps-4 my-2">
                        <h4>Pedidos</h4>          
                    </div>
                   
                    <div class="col-5 my-2 pe-4 text-end">
                    <a href="{{route('admin.pedidos.new')}}" class="btn btn-primary " type="button" 
                     >Cadastrar</a>
                    </div>
                </div>

                <div id="lista-Produtos">
                    @include('admin.pedidos._list-pedidos')
                </div> 
           </div>
        </div>

<!-- Modal Pedido-->

    <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal-pedidos">

        <div class="modal-dialog" >
            <div class="modal-content">
               
                <div class="modal-body">
               

                </div>
              
            </div>
        </div>
    </div>



    </div>
</div>





@endsection

@section('scripts')
<script>

// DATA TABLE
    $('#pedidos_table').DataTable({
        
        "lengthMenu": [5, 10, 20],
        "pageLength": 8,
        "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
    }
    });

// Preview
    $("body").on('click','.preview-pedido',function() {
       
       event.preventDefault(); // Impede o comportamento padrão do link
       var url = $(this).attr('href'); // Pega a route{id} EDIT -> DELETE
       console.log(url);

       $.ajax({
           url: url,
           type: "GET",

           success: function(response) {
               
               $("#modal-pedidos").html(response);
               $("#modal-pedidos").modal('show')
           },       
       });
   });


// CADASTRAR
    $("body").on('submit','#cadastrar-produtos', function(e) {

    e.preventDefault();
    var formData = $(this).serialize();
    console.log(formData);

    $("#msg-error").addClass('d-none');

    $.ajax({
        url: '{{route("admin.produtos.store")}}',
        type: "POST",
        data: formData,
        
        success: function(response) {
        console.log(response);

            $('#descricao').val('');
            $('#grupoSelect').val('');
            $('#categoriaSelect').val('');
            $('#valor').val('');

            $('#lista-Produtos').html(response);

            $('#produtos_table').DataTable({
                "lengthMenu": [5, 10, 20],
                "pageLength": 5,
                "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"}
            });
        },

        error: function(response) {
        
        $("#msg-error ul").html('');
        var errors = $.parseJSON(response.responseText);
            $.each(errors.errors, function (k, v) {
                
                $("#msg-error ul").append('<li class="text-white">'+v+'</li>')
            });
            $("#msg-error").removeClass('d-none')     
        },      
    });

    });

// EDITAR
    $("body").on('click','.editar-produtos',function() {
       
        event.preventDefault(); // Impede o comportamento padrão do link
        var url = $(this).attr('href'); // Pega a route{id} EDIT -> DELETE
        console.log(url);

        $.ajax({
            url: url,
            type: "GET",

            success: function(response) {
                
                $("#edit-produtos").html(response);
                $("#collapse-Produto").collapse('hide');
                $("#collapse-Produto2").collapse('show');
            },       
        });
    });

// ATUALIZAR
$("body").on('submit','#atualizar-produtos', function(e) {

    e.preventDefault();
    var formData = $(this).serialize();
    console.log(formData);

    $("#msg-error").addClass('d-none');

    $.ajax({

        url: $(this).attr('action'),  
        type: "POST",                
        data: formData,
        
        success: function(response) {
            
            console.log(response);

            $('#descricao').val('');
            $('#grupoSelect').val('');
            $('#categoriaSelect').val('');

            $('#lista-Produtos').html(response);
            $("#collapse-Produto2").collapse('hide');

            $('#produtos_table').DataTable({
                "lengthMenu": [5, 10, 20],
                "pageLength": 5,
                "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"}
            });

        }, 

        error: function(response) {
            
            $("#msg-error ul").html('');
            var errors = $.parseJSON(response.responseText);
                $.each(errors.errors, function (k, v) {
                    
                    $("#msg-error ul").append('<li class="text-white">'+v+'</li>')
                });
                $("#msg-error").removeClass('d-none')     
        },      
    });
    });

// DELETAR
$("body").on('click', '.deletar-produtos', function (event) {

    event.preventDefault(); // Prevents the default behavior of the link
    var url = $(this).attr('href'); // Gets the route{id} EDIT -> DELETE
    console.log(url);

    swal({
        title: `Você tem certeza que deseja apagar as informações?`,
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            
            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {

                    $("#lista-Produtos").html(response);

                    $('#produtos_table').DataTable({
                        "lengthMenu": [5, 10, 20],
                        "pageLength": 5,
                        "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"}
                    });
                },
            });
        }
    });
    

});


</script>
@endsection







  