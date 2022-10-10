<li class="nav-item">
    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
    </a>
</li>

<!-- Notifications Dropdown Menu -->
      
    <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="far fa-bell"></i>
      <span class="badge badge-warning navbar-badge"> olá</span>
    </a>
    @if (Auth::user()->tenant_id == 1)
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <span class="dropdown-header"></span>
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item">
        <i class="fas fa-envelope mr-2"></i> Você recebeu {{count(Auth::user()->notificationsAdmin())}} novas mensagens
        <span class="float-right text-muted text-sm"></span>
      </a>
    @else
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <span class="dropdown-header"></span>
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item">
        <i class="fas fa-envelope mr-2"></i> Você recebeu {{count(Auth::user()->notificationsTenant())}} novas mensagens
        <span class="float-right text-muted text-sm"></span>
    @endif    
      @if (Auth::user()->tenant_id == 1)
      <div class="dropdown-divider"></div>
      <a href="{{route('admin.mensagem.index')}}" class="dropdown-item dropdown-footer">Visualizar Mensagens</a>
    </div>
      @else
      <div class="dropdown-divider"></div>
      <a href="{{route('tenant.mensagem.index')}}" class="dropdown-item dropdown-footer">Visualizar Mensagens</a>
    </div> 
      @endif   
  </li>   
  

  
