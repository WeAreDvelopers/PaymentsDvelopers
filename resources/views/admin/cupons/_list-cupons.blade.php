
   <div class="row">
            <table class="table mt-1 arial14-font" id="categorias_table">
                <thead class="cabecalho">
                    <tr>
                       
                        <th scope="col">Código</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>
                        
                    </tr>
                </thead>

                <!--BODY-->
                <tbody>
                @foreach($cupons as $k => $cupom)
                    <tr>
                       
                        <td>{{$cupom->codigo ?? ''}}</td>
                        <td class="text-center">{{$cupom->qtd}}/{{$cupom->pedidos->count()}}</td>

               
                <td>
                   {{getMoney($cupom->valor)}}
                </td>
                <td>{{$cupom->tipo}}</td>
                          <td>
                          <div class="form-check form-switch">
                                        <input class="form-check-input status-categoria"
                                         type="checkbox" name="status" role="switch" 
                                          value="ativo"
                                          data-id="{{$cupom->id}}"
                                          @if($cupom->status == 'ativo')
                                            checked
                                            @endif
                                            >
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Ativo</label>
                                    </div>

                            
                          </td>
                   
                            <td>
                                <a href="{{route('admin.cupons.edit', $cupom->id)}}" class="btn btn-icon-only btn-secondary editar-categorias"> <i class="fa-solid fa-pencil"></i> </a>
                                <a href="{{route('admin.cupons.delete', $cupom->id) }}" class="btn btn-icon-only btn-danger deletar-categorias"> <i class="fa-solid fa-trash"></i>           
                            </td>
                    </tr>
                @endforeach  
               </tbody>
            </table>
    </div>
            
    
          


