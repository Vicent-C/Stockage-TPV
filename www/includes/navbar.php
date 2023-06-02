<!--     navbar    -->
<header class="col-12 bg-secondary mb-3 text-light">
    <nav class="navbar navbar-expand-lg bg-success">
      <div class="container-fluid">
        <a class="navbar-brand text-light" href="index.php">STOCKAGE TPV</a>
        <button class="navbar-toggler btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav px-2">
            <li class="nav-item">
              <a class="nav-link active text-light" aria-current="page" href="./index.php"><i class="fas fa-home"></i></a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Ventas
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item text-secondary" href="venta.php">Ver Facturas</a></li>
                <li><a class="dropdown-item text-secondary" href="nuevaventa.php">Nueva Venta</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Albaranes
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item text-secondary" href="albaran.php">Ver Albaranes</a></li>
                <li><a class="dropdown-item text-secondary" href="abastecer.php">Nuevo pedido</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Históricos
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item text-secondary" href="albaran.php">Albaranes</a></li>
                <li><a class="dropdown-item text-secondary" href="venta.php">Facturas</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="http://localhost:8000/"><i class="fas fa-database"></i><i> phpMyAdmin</i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="includes\logout.php"><i class="fas fa-sign-out-alt"></i></a>
            </li>
          </ul>
        </div>
      </div>
      
    </nav>
  </header>