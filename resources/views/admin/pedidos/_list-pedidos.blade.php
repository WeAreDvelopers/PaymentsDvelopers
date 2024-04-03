
   <div class="row">
            <table class="table mt-1 arial14-font" id="pedidos_table">
                <thead class="cabecalho">
                    <tr>
                       
                        <th scope="col">Pedido</th>
                       
                        <th scope="col">Usuário</th>
                        <th scope="col">Produto</th>
                        <th scope="col">Valor</th>


                        <th scope="col">Ações</th>
                        
                    </tr>
                </thead>

                <!--BODY-->
                <tbody>
                @foreach($pedidos as $k => $ped)
                    <tr>
                       
                        <td>{{$ped->id}}</td>
                        <td>{{$ped->usuario->name ?? ''}}</td>
                        <td>{{$ped->produto->nome ?? ''}} </td>
                        <td>{{getMoney($ped->valor) ?? ''}}</td>

                        <td>
                                <a href="{{route('admin.pedidos.preview', $ped->id)}}" class="btn btn-icon-only btn-primary preview-pedido"> <i class="fa-solid fa-eye"></i> </a>
                                <a href="{{route('admin.pedidos.edit', $ped->id)}}" class="btn btn-icon-only btn-secondary"> <i class="fa-solid fa-pencil"></i> </a>
                                <a href="{{route('admin.pedidos.delete', $ped->id) }}" class="btn btn-icon-only btn-danger deletar-produtos"> <i class="fa-solid fa-trash"></i>           
                        </td>
                    </tr>
                @endforeach  
               </tbody>
            </table>
    </div>
            
    
          


