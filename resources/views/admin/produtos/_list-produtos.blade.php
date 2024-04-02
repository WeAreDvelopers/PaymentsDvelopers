
   <div class="row">
            <table class="table mt-1 arial14-font" id="produtos_table">
                <thead class="cabecalho">
                    <tr>
                       
                        <th scope="col">Descriçao</th>
                       
                        <th scope="col">Valor</th>
                        <th scope="col">Link</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>
                        
                    </tr>
                </thead>

                <!--BODY-->
                <tbody>
                @foreach($produtos as $k => $prod)
                    <tr>
                       
                        <td>{{$prod->descricao ?? ''}}</td>
                        <td>
                            <a href="{{route('site.pagamento',['token'=>$prod->token])}}" target="_blank" class="btn btn-sm btn-primary">
                                Link</a>
                        </td>
                        
                        <td>{{getMoney($prod->valor) ?? ''}}</td>

                <!-- TOGGLE SWITCH -->
                    @if($prod->status == 'ativo')
                          <td>
                              <label class="switch">
                                <input type="checkbox" checked class="status-produto" data-id="{{$prod->id}}">
                                <span class="slider round"></span>
                              </label>
                          </td>
                     @else    
                           <td>
                              <label class="switch">
                                <input type="checkbox" class="status-produto" data-id="{{$prod->id}}">
                                <span class="slider round"></span>
                              </label>
                          </td> 
                    @endif
                            <td>
                                <a href="{{route('admin.produtos.edit', $prod->id)}}" class="btn btn-icon-only btn-secondary"> <i class="fa-solid fa-pencil"></i> </a>
                                <a href="{{route('admin.produtos.delete', $prod->id) }}" class="btn btn-icon-only btn-danger deletar-produtos"> <i class="fa-solid fa-trash"></i>           
                            </td>
                    </tr>
                @endforeach  
               </tbody>
            </table>
    </div>
            
    
          


