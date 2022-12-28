<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ url('/')}}" class="brand-link">
    <img src="{{ url('/storage/logo.png')}}"
         alt="AdminLTE Logo"
         class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">{{ config('app.name')}}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>  
        </li>

        @can('inputs.index')
        <li class="nav-item">
          <a href="{{ route('activities.index') }}" class="nav-link">
            <i class="nav-icon far fa-keyboard"></i>
            <p>
              Kegiatan
            </p>
          </a>
        </li>  
        @endcan
        
        @can('spmks.index')
        <li class="nav-item">
          <a href="{{ route('spmk.index') }}" class="nav-link">
            <i class="nav-icon far fa-file-alt"></i>
            <p>
              STMK/SPMK
            </p>
          </a>
        </li> 
        @endcan
        
        @can('monitors.index')
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-calendar-alt"></i>
            <p>
              Monitoring
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('monitors.agenda') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Agenda</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('monitors.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Available</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('monitors.week') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Perperiode
                </p>
              </a>
            </li>  
          </ul>
        </li>
        @endcan
        
        @can('ikus.index')
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-file"></i>
            <p>
              Laporan
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('iku.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>IKU</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('extrajp.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Kelebihan Jamlat</p>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a href="{{ route('profile.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Profile WI</p>
              </a>
            </li> --}}
          </ul>
        </li>
        @endcan
        
        @role('super admin|admin kegiatan')
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Master Data
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @can('trainers.index')
            <li class="nav-item">
              <a href="{{ route('trainers.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pengajar</p>
              </a>
            </li>  
            @endcan
          
            @can('codes.index')
            <li class="nav-item">
              <a href="{{ route('codes.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Kode Kegiatan</p>
              </a>
            </li> 
            @endcan
            @can('ikus.target')
            <li class="nav-item">
              <a href="{{ route('iku.target') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Target IKU</p>
              </a>
            </li> 
            @endcan
          </ul>
        </li>   
        @endrole
        
        @role('super admin')
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Setting
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          @can('users.index')
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('users.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Users</p>
              </a>
            </li>
          </ul>
          @endcan
          
          @can('permissions.index')
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('permissions.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Permissions</p>
              </a>
            </li>
          </ul>  
          @endcan
          
          @can('roles.index')
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('roles.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Roles</p>
              </a>
            </li>
          </ul>  
          @endcan
          
        </li> 
        @endrole
                
        <li class="nav-item">
          <a href="{{ route('logout') }}" class="nav-link"  onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
            <i class="nav-icon fas fa-power-off"></i>
            <p>Sign Out</p>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>






