<?php
// recordar la variable de sesión
session_start();
include 'conn.php';
//verificar que se ha creado la variable de sesión.
if(!isset($_SESSION['login']) || $_SESSION['login'] !== TRUE){
    header('location:./../login.php');
    exit;

}
$username = $_SESSION['Usuario'];
// Obtener el ID de la fruta
$id = $_GET['fruta'];

// Consultar la fruta
$consulta = "SELECT * FROM fruta WHERE codigo_fruta = $id";
$resultado = $connect->query($consulta);
$stock = $resultado->fetch_array();
/*
$obtener_nombre = "SELECT num_albaran FROM albaran WHERE num_albaran = $id";
$nombre_obt = $connect->query($obtener_nombre);
$nombre = $nombre_obt->fetch_array();
*/
?>
<!DOCTYPE html>
<html id="htmlpr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Stockage TPV</title>
  <link href="./../css/style.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-fkJS/Z+1bIP/hMBCkM78P4p4Px4o4Hn8aW9Aop1tS/ydLQrlS3oWw3qg3EdiV86C0QepLGyV7SXuq3IFpVzrHw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bad+Script">
  <link rel="icon" type="image/png" href="/img/Logo.ico"/>
</head>

<body id="bodypr" class="vh-100 bg-secondary-subtle">
<?php 
  include 'navbar_includes.php';
  ?>
  
  <!--      CONTENIDO      -->
  <main id="mainpr" class="contenedor content col-12">
    <section class="container-fluid col-lg-10 col-md-10 col-sm-10">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./../index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="./../inventario.php">Inventario</a></li>
            <li class="breadcrumb-item active" aria-current="page">Inventario de <?php echo $stock['nombre']; ?></li>
          </ol>
        </nav>
        <article class="col-12">
            <h4 class="display-6 text-center">Inventario de <?php echo $stock['nombre']; ?></h4>
        </article>
        
        <article id="viewfru" class="col-12 bg-white h-100 p-3 bg-light border border-secondary rounded my-3 justify-content-center" style="--bs-border-opacity: .5;">       
        <!--    Selector de tipo de orden   -->
                <div id="modfruta" class="d-flex flex-column container my-3 shadow bg-secondary-subtle btn border border-secondary-subtle">

                    <form id="" class="table-responsive order-2" action="" method="post">
                    <div class="table-responsive">
                      <table class="table table-striped table-secondary table-responsive table-hover">
                            <thead>
                                <tr>
                                    <th>Código de fruta</th>
                                    <th>Fruta</th>
                                    <th>Kilos</th>
                                    <th>Precio/KG</th>
                                    <th><b>Total €</b></th>
                                </tr>
                            </thead>
                            <tbody>

                                    <tr>
                                        <td><?php echo $stock['codigo_fruta']; ?></td>
                                        <td><?php echo $stock['nombre']; ?></td>
                                        <td><?php echo $stock['stock']; ?></td>
                                        <td><?php echo $stock['precio']; ?>€</td>
                                        <td><?php 
                                      $total=$stock['stock']*$stock['precio'];
                                      echo $total;
                                    ;?> €</td>
                                    </tr>

                            </tbody>
                      </table>
                    </div>
                        <div class="row container">

                        </div>
                    </form>
                </div>    
        </article>
    </section>

  </main>
  <?php 
  include 'footer.php';
?>
  <script src="https://kit.fontawesome.com/d38f67bab1.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
    integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
    integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
    crossorigin="anonymous"></script>
  <script src="script.js"></script>
  <script src="https://replit.com/public/js/replit-badge-v2.js" theme="dark" position="bottom-right"></script>
</body>
<?php 
  $connect->close();
?>
</html>