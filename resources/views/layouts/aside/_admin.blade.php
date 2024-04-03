<li class="nav-item">
          <a class="nav-link  active" href="">
           
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link  " href="{{route('admin.pedidos.index')}}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-bag-shopping"></i>
            </div>
            <span class="nav-link-text ms-1">Pedidos</span>
          </a>
        </li>


        <li class="nav-item">  
          <a class="nav-link  " href="{{route('admin.produtos.index')}}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-cubes"></i>
            </div>
            <span class="nav-link-text ms-1">Produtos</span>
          </a>
        </li>

        <li class="nav-item">  
          <a class="nav-link  " href="{{route('admin.cupons.index')}}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-percent"></i>
            </div>
            <span class="nav-link-text ms-1">Cupons</span>
          </a>
        </li>

        <li class="nav-item">  
          <a class="nav-link  " href="{{route('admin.usuarios.index')}}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-users"></i>
            </div>
            <span class="nav-link-text ms-1">Usuários</span>
          </a>
        </li>
        <li class="nav-item">  
          <a class="nav-link  " href="{{route('admin.empresas.edit',['id'=>Auth::user()->id_empresa])}}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-users"></i>
            </div>
            <span class="nav-link-text ms-1">Empresa</span>
          </a>
        </li>
        <li class="nav-item">  
          <a class="nav-link  " href="{{route('admin.integracoes.index')}}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-brands fa-connectdevelop"></i>
            </div>
            <span class="nav-link-text ms-1">Integrações</span>
          </a>
        </li>
        @if(Auth::check())
    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-primary my-3 w-90">Logout</button>
    </form>
    @endif
      
       