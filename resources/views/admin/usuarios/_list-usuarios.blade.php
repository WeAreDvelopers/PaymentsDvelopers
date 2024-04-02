
   <div class="row">
            <table class="table mt-1 arial14-font" id="usuarios_table">
                <thead class="cabecalho">
                    <tr>
                       
                        <th scope="col">Nome</th>
                        <th scope="col">Perfil</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>
                        
                    </tr>
                </thead>

                <!--BODY-->
                <tbody>
                @foreach($usuarios as $k => $item)
                    <tr>
                       
                        <td>{{$item->name}}</td>
                        <td>{{$item->role}}</td>
                        <td>{{$item->email}}</td>

                <!-- TOGGLE SWITCH -->
                    @if($item->status == 'ativo')
                          <td>
                              <label class="switch">
                                <input type="checkbox" checked class="status-user" data-id="{{$item->id}}">
                                <span class="slider round"></span>
                              </label>
                          </td>
                     @else    
                           <td>
                              <label class="switch">
                                <input type="checkbox" class="status-user" data-id="{{$item->id}}">
                                <span class="slider round"></span>
                              </label>
                          </td> 
                    @endif
                            <td>
                                <a href="{{route('admin.usuarios.edit', $item->id)}}" class="btn btn-icon-only btn-secondary editar-usuarios"> <i class="fa-solid fa-pencil"></i> </a>
                                <a href="{{route('admin.usuarios.delete', $item->id) }}" class="btn btn-icon-only btn-danger deletar-usuarios"> <i class="fa-solid fa-trash"></i>           
                            </td>
                    </tr>
                @endforeach  
               </tbody>
            </table>
    </div>
            
    
          


