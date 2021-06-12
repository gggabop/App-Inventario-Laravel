<aside class="fondo main-sidebar sidebar-info elevation-4 rounded-right" style="overflow-x:hidden">
    <style>
      .fondo{
        background: #F2F2F2;
      }
      .fondo2{
        background: #4F5D75;
      }
      .fondo2:hover{
        background: #2B2D42;
        transition: 300ms;
      }
      .brand-link{
        background: #4F5D75;
        color: #F8F9FA !important;
      }
      .brand-link:hover{
        background: #2B2D42;
        transition: 300ms;
      }
      .d-block{
        color: #F8F9FA !important;
      }
      .nav-link{
        color: #495057 !important;
      }
      .nav-item{
        border-radius: 10px;
      }
      .nav-item:hover{
        background: #343A40 !important;
        border-radius: 6px;
        transition: 700ms;
      }
      .nav-link:hover{
        color: #F8F9FA !important;
        transition: 300ms;
      }
    </style>
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
      <img src="{{url('/')}}/{{$blog[0]["icono"]}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="small brand-text font-weight-light">"Mana Azur Hashem"</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition"><div class="os-resize-observer-host"><div class="os-resize-observer observed" style="left: 0px; right: auto;"></div></div><div class="os-size-auto-observer" style="height: calc(100% + 1px); float: left;"><div class="os-resize-observer observed"></div></div><div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 296px;"></div><div class="os-padding"><div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;"><div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
      <!-- Sidebar user (optional) -->
      <div class="fondo2 user-panel mt-3 pb-3 mb-3 d-flex elevation-2 rounded-sm">
        <div class="image">

          @foreach ($administradores as $element)

            @if ($_COOKIE["email_login"] == $element->email)
              
              @if ($element->foto == "")

                 <img src="{{url('/')}}/vistas/img/admin.png" class="img-circle mt-3 elevation-2" alt="User Image">

              @else

                <img src="{{url('/')}}/{{$element->foto}}" class="img-circle mt-3 elevation-2" alt="User Image">

              @endif


            @endif
           
         @endforeach 



         
        
        </div>
        <div class="mt-3 info">
          
          <a href="#" class="d-block">
            
          @foreach ($administradores as $element)

            @if ($_COOKIE["email_login"] == $element->email)
               {{$element->name}}
            @endif
           
         @endforeach 

          </a>

        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          @foreach ($administradores as $element)

            @if ($_COOKIE["email_login"] == $element->email)
               
                @if ($element->rol == "administrador")
                
                   <!--=====================================
                    Botón Sistema
                  ======================================-->

                  <li class="nav-item">
                    <a href="{{ url("/") }}" class="nav-link">
                      <i class="nav-icon fas fa-home"></i>
                      <p>Sistema</p>
                    </a>
                  </li>

                  <!--=====================================
                  Botón Administradores
                  ======================================-->

                  <li class="nav-item">
                    <a href="{{ url("/administradores") }}" class="nav-link">
                      <i class="nav-icon fas fa-users-cog"></i>
                      <p>Administradores</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ url("/backup") }}" class="nav-link">
                      <i class="nav-icon far fa-file"></i>
                      <p>Respaldo</p>
                    </a>
                  </li>

                @endif

            @endif

            @if ($_COOKIE["email_login"]==$element->email)
            @if ($element->rol == "administrador" || $element->rol == "inventario")
              <!--=====================================
          Botón Distribuidores
          ======================================-->

          <li class="nav-item">
            <a href="{{ url("/distribuidores") }}" class="nav-link">
              <i class="nav-icon fas fa-people-carry"></i>
              <p>Distribuidores</p>
            </a>
          </li>

          <!--=====================================
          Botón Productos
          ======================================-->

          <li class="nav-item">
            <a href="{{ url("/productos") }}" class="nav-link">
              <i class="nav-icon fas fa-archive"></i>
              <p>Productos</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url("/reportes") }}" class="nav-link">
              <i class="nav-icon fas fa-folder-open"></i>
              <p>Reportes</p>
            </a>
          </li>
          @endif
          @endif

          @endforeach 
          <!--=====================================
          Botón Opiniones
          ======================================-->

          <li class="nav-item">
            <a href="{{ url("/entregas") }}" class="nav-link">
              <i class="nav-icon fas fa-shipping-fast"></i>
              <p>Entregas</p>
            </a>
          </li>

          <!--=====================================
          Botón Banner
          ======================================-->

          <li class="nav-item">
            <a href="{{ url("/salidas") }}" class="nav-link">
              <i class="nav-icon fas fa-comments-dollar"></i>
              <p>Salidas</p>
            </a>
          </li>

          
          <!--=====================================
          Botón Anuncios
          ======================================-->


        </ul>

      </nav>
      <!-- /.sidebar-menu -->
    </div></div></div><div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="height: 21.4131%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar-corner"></div></div>
    <!-- /.sidebar -->
    <style>
      .nav{
        color: black !important;
      }
    </style>
  </aside>