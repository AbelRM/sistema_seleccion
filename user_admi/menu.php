<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <div class="p-2 d-flex justify-content-center">
      <a href="index.php?dni=<?php echo $dato_desencriptado;?>"><img src="img/logo_diresa.png" style="max-width: 100%; height: auto;" alt="Logo de DIRESA TACNA"></a>
    </div>
  
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      CONVOCATORIAS
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConvo" aria-expanded="true" aria-controls="collapseConvo">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Convocatoria</span>
      </a>
      <div id="collapseConvo" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Acciones:</h6>
          <a class="collapse-item" href="listado_convocatorias.php?dni=<?php echo $dato_desencriptado ?>">Listado de convocatorias</a>
          <a class="collapse-item" href="nueva_convocatoria.php?dni=<?php echo $dato_desencriptado ?>">Nueva convocatoria</a>
          
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCom" aria-expanded="true" aria-controls="collapseCom">
        <i class="fas fa-fw fa-cog"></i>
        <span>Direccion Ejecutiva</span>
      </a>
      <div id="collapseCom" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Acciones:</h6>
          <a class="collapse-item" href="direccion_ejec.php?dni=<?php echo $dato_desencriptado ?>">Direccion Ejecutiva</a>
          <a class="collapse-item" href="nuevadireccionejec.php?dni=<?php echo $dato_desencriptado ?>">Nueva Direccion Ejecutiva</a>
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCom" aria-expanded="true" aria-controls="collapseCom">
        <i class="fas fa-fw fa-cog"></i>
        <span>Comisión</span>
      </a>
      <div id="collapseCom" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Acciones:</h6>
          <a class="collapse-item" href="#">Listado de comisiones</a>
          <!-- <a class="collapse-item" href="#">Nueva</a> -->
        </div>
      </div>
    </li>

    
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Evaluación
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEva" aria-expanded="true" aria-controls="collapseEva">
        <i class="fas fa-fw fa-cog"></i>
        <span>Evaluación postulante</span>
      </a>
      <div id="collapseEva" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Procesos:</h6>
          <a class="collapse-item" href="lista_convo.php?dni=<?php echo $dato_desencriptado ?>">Eva. totales</a>
          <a class="collapse-item" href="#">Cards</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRes" aria-expanded="true" aria-controls="collapseRes">
        <i class="fas fa-fw fa-cog"></i>
        <span>Resultados totales</span>
      </a>
      <div id="collapseRes" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Resultados:</h6>
          <a class="collapse-item" href="#">Buttons</a>
          <a class="collapse-item" href="#">Cards</a>
        </div>
      </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
  <!-- End of Sidebar -->