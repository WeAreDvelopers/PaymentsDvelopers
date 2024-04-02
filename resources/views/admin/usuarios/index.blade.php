@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-7 ps-4 my-2">
                        <h4>Usuários</h4>          
                    </div>
                   
                    <div class="col-5 my-2 pe-4 text-end">
                    <a class="btn btn-primary tooglegeCollapse" type="button" 
                       data-target="#collapse-User">Cadastrar</a>
                    </div>
                </div>

           <!-- Collapse Cadastrar -->
            <div class="row col-12 mx-auto">   
                <div class="collapse" id="collapse-User">
                    <div class="card shadow mx-4 mb-4">
                        <div class="card-body " id="cadastro-usuarios">
                  <!--      <a href="#" class="tooglegeCollapse float-right" data-target="#collapse-User"><i class="fas fa-times"></i></a> -->
                            @include('admin.usuarios.cadastrar')
                        </div>
                    </div>
                </div>
            </div>
       <!-- Collapse Editar -->
            <div class="row col-12 mx-auto">   
                <div class="collapse" id="collapse-User2">
                    <div class="card shadow mx-4 mb-4">
                        <div class="card-body " id="edit-usuarios">
                  <!--      <a href="#" class="tooglegeCollapse float-right" data-target="#collapse-User"><i class="fas fa-times"></i></a> -->
                            @include('admin.usuarios.cadastrar')
                        </div>
                    </div>
                </div>
            </div>

                <div id="lista-Usuarios">
                    @include('admin.usuarios._list-usuarios')
                </div> 
           </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>

// DATA TABLE
    $('#usuarios_table').DataTable({
        
        "lengthMenu": [5, 10, 20],
        "pageLength": 8,
        "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
    }
    });

// TOGGLE SWITCH
$("body").on('change', '.status-user', function () {
    var id = $(this).data('id');
    var status = $(this).is(":checked") ? 'ativo' : 'inativo';

    $.ajax({
        url: '{{ route("admin.usuarios.status") }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            id: id,
            status: status,
        },
        success: function (response) {
            $("#lista-Usuarios").html(response);
        }
    });
});

// CADASTRAR
    $("body").on('submit','#cadastrar-usuarios', function(e) {

    e.preventDefault();
    var formData = $(this).serialize();
    console.log(formData);

    $("#msg-error").addClass('d-none');

    $.ajax({
        url: '{{route("admin.usuarios.store")}}',
        type: "POST",
        data: formData,
        
        success: function(response) {
        console.log(response);

            $('#name').val('');
            $('#email').val('');
            
            $('#lista-Usuarios').html(response);

            $('#usuarios_table').DataTable({
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
    $("body").on('click','.editar-usuarios',function() {
       
        event.preventDefault(); // Impede o comportamento padrão do link
        var url = $(this).attr('href'); // Pega a route{id} EDIT -> DELETE
        console.log(url);

        $.ajax({
            url: url,
            type: "GET",

            success: function(response) {
                
                $("#edit-usuarios").html(response);
                $("#collapse-User2").collapse('show');
            },       
        });
    });

// ATUALIZAR
$("body").on('submit','#atualizar-usuarios', function(e) {

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

            $('#name').val('');
            $('#email').val('');  
            $('#lista-Usuarios').html(response);
            $("#collapse-User2").collapse('hide');

            $('#usuarios_table').DataTable({
        
                "lengthMenu": [5, 10, 20],
                "pageLength": 8,
                "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
            }
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
$("body").on('click', '.deletar-usuarios', function (event) {

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

                    $("#lista-Usuarios").html(response);

                    $('#usuarios_table').DataTable({
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







  