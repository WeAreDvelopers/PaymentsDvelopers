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
                        <h4>Leads</h4>          
                    </div>
                   
                    <div class="col-5 my-2 pe-4 text-end">
                    <a href="#" class="btn btn-primary " type="button" 
                     >Cadastrar</a>
                    </div>
                </div>

                <div id="lista-Pedidos">
                    @include('admin.leads._list-leads')
                </div> 
           </div>
        </div>


            

    </div>
</div>


@endsection

@section('scripts')
<script>

// DATA TABLE
    $('#leads_table').DataTable({
        
        "lengthMenu": [5, 10, 20],
        "pageLength": 8,
        "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
    }
    });


// DELETAR
$("body").on('click', '.deletar-leads', function (event) {
alert('ssssssssssss')
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







  