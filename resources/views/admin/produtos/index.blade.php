@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
   
        <div class="card">
            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-7 ps-4 my-2">
                        <h4>Produtos</h4>          
                    </div>
                   
                    <div class="col-5 my-2 pe-4 text-end">
                    <a href="{{route('admin.produtos.new')}}" class="btn btn-primary " type="button" 
                     >Cadastrar</a>
                    </div>
                </div>

                <div id="lista-Produtos">
                    @include('admin.produtos._list-produtos')
                </div> 
           </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>


// TOGGLE SWITCH
$("body").on('change', '.status-produto', function () {
 
    var id = $(this).data('id');
    var status = $(this).is(":checked") ? 'ativo' : 'inativo';

    $.ajax({
        url: '{{ route("admin.produtos.status") }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            id: id,
            status: status,
        },
        success: function (response) {
           console.log(response);
        }
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

                    window.location.reload();

                },
            });
        }
    });
    

});


</script>
@endsection







  