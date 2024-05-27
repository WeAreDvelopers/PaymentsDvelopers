
   <div class="row">
            <table class="table mt-1 arial14-font" id="leads_table">
                <thead class="cabecalho">
                    <tr> 
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Telefone</th>

                        <th scope="col">Ações</th>
                        
                    </tr>
                </thead>
                <!--BODY-->
                <tbody>

                @foreach($leads as $k => $lead)
                    <tr>
                       
                        <td>{{$lead->nome}}</td>
                        <td>{{$lead->email}}</td>
                        <td>{{$lead->cpf}}</td>
                        <td>{{$lead->telefone}}</td>

                        <td>
                           <!--     <a href="#" class="btn btn-icon-only btn-primary preview-pedido"> <i class="fa-solid fa-eye"></i> </a> -->
                                <a href="#" class="btn btn-icon-only btn-secondary"> <i class="fa-solid fa-pencil"></i> </a>
                                <a href="{{route('admin.leads.delete', $lead->id) }}" class="btn btn-icon-only btn-danger deletar-leads"> <i class="fa-solid fa-trash"></i>           
                        </td>
                    </tr>
                @endforeach  
               </tbody>
            </table>
    </div>
            
    
          


