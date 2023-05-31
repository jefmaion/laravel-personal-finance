<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
      <div class="avatar"><img src="{{ asset('dark') }}/img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div>
      <div class="title">
        <h1 class="h5">Mark Stephen</h1>
        <p>Web Designer</p>
      </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">
            <li class=""><a href="#"> <i class="fa fa-home" aria-hidden="true"></i> Home </a></li>
            <li class="{{ (\Request::is('transaction*')) ? 'active' : '' }}"><a href="{{ route('transaction.index') }}"> <i class="fa fa-list" aria-hidden="true"></i> Lançamentos </a></li>
            <li class="{{ (\Request::is('category*')) ? 'active' : '' }}"><a href="{{ route('category.index') }}"> <i class="fa fa-list" aria-hidden="true"></i> Categorias </a></li>
            <li class="{{ (\Request::is('account*')) ? 'active' : '' }}"><a href="{{ route('account.index') }}"> <i class="fa fa-money" aria-hidden="true"></i> Contas </a></li>
            <li class="{{ (\Request::is('payment*')) ? 'active' : '' }}"><a href="{{ route('payment.index') }}"> <i class="fa fa-credit-card" aria-hidden="true"></i> Formas de Pagamento </a></li>
            {{-- <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Cadastros </a>
              <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                <li><a href="#">Categorias</a></li>
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
              </ul>
            </li> --}}
            {{-- <li><a href="login.html"> <i class="icon-logout"></i>Login page </a></li> --}}
    {{-- </ul><span class="heading">Extras</span>
    <ul class="list-unstyled">
      <li> <a href="#"> <i class="icon-settings"></i>Demo </a></li>
      <li> <a href="#"> <i class="icon-writing-whiteboard"></i>Demo </a></li>
      <li> <a href="#"> <i class="icon-chart"></i>Demo </a></li>
    </ul> --}}
  </nav>