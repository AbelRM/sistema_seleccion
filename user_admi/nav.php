<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>
  <!-- Topbar Search -->

  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">


    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
      <?php

      $sql = "SELECT * FROM usuarios where dni=$dni";
      $datos = mysqli_query($con, $sql);
      $fila = mysqli_fetch_array($datos);
      ?>
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $fila['nombres'] . " " . $fila['ape_pat'] . " " . $fila['ape_mat']; ?></span>
        <img class="img-profile rounded-circle" src="img/user.png">

      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="#">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          Perfil
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#cerrarsesion">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Cerrar sesión
        </a>
      </div>
    </li>
    <li class="nav-item p-2">
      <a href="#" class="btn btn-primary square-btn-adjust" data-toggle="modal" data-target="#cerrarsesion">
        <i class="fas fa-power-off fa-2x"></i>
      </a>
    </li>
  </ul>
  <a href="#" type="button" data-toggle="modal" data-target="#cerrarsesion">
    <img class="img-profile rounded-circle" src="img/cerrar_sesion.png" style="width: 70%; height:auto;" alt="Cerrar sesión">
  </a>
  
</nav>