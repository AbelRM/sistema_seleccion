<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <div class="p-2 d-flex justify-content-center">
      <img src="img/logo_diresa.png" style="max-width: 100%; height: auto;" alt="Logo de DIRESA TACNA">
    </div>
    
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

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
          <a class="collapse-item" href="listado_convocatorias.php?dni=<?php echo $dni ?>">Listado convocatorias</a>
          <a class="collapse-item" href="ficha_wizard.php?dni=<?php echo $dni ?>">Ficha única de datos</a>
          
        </div>
      </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCom" aria-expanded="true" aria-controls="collapseCom">
        <i class="fas fa-fw fa-cog"></i>
        <span>Mis convocatorias</span>
      </a>
      <div id="collapseCom" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Acciones:</h6>
          <a class="collapse-item" href="#">Listado</a>
          <a class="collapse-item" href="#">Postular</a>
        </div>
      </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->