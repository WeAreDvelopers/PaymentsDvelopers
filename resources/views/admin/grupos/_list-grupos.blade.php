
   <div class="row">
            <table class="table mt-1 arial14-font" id="grupos_table">
                <thead class="cabecalho">
                    <tr>
                       
                        <th scope="col">Descriçao</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>
                        
                    </tr>
                </thead>

                <!--BODY-->
                <tbody>
                @foreach($grupos as $k => $item)
                    <tr>
                       
                        <td>{{$item->descricao}}</td>

                <!-- TOGGLE SWITCH -->
                    @if($item->status == 'ativo')
                          <td>
                              <label class="switch">
                                <input type="checkbox" checked class="status-grupo" data-id="{{$item->id}}">
                                <span class="slider round"></span>
                              </label>
                          </td>
                     @else    
                           <td>
                              <label class="switch">
                                <input type="checkbox" class="status-grupo" data-id="{{$item->id}}">
                                <span class="slider round"></span>
                              </label>
                          </td> 
                    @endif
                            <td>
                                <a href="{{route('admin.grupos.edit', $item->id)}}" class="btn btn-icon-only btn-secondary editar-grupos"> <i class="fa-solid fa-pencil"></i> </a>
                                <a href="{{route('admin.grupos.delete', $item->id) }}" class="btn btn-icon-only btn-danger deletar-grupos"> <i class="fa-solid fa-trash"></i>           
                            </td>
                    </tr>
                @endforeach  
               </tbody>
            </table>
    </div>
            
    
          


