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
// Obtener el ID de la fruta a modificar desde el parámetro de la URL
$id = $_GET['codigo_fruta'];

//declarar variables vacías
$nombre = " ";
$precio_unidad = " ";
$origen = " ";
$temporada = " ";
$clase = " ";
// Consultar la fruta a modificar
$consulta = "SELECT * FROM fruta WHERE codigo_fruta = '$id'";
$resultado = $connect->query($consulta);
$fruta = $resultado->fetch_array();

// Verificar si se ha enviado el formulario para eliminar el registro
if(isset($_POST['continuar'])){
    //Actualizar la fruta y poner stock a 0 además se pone estado en "BAJA"
    $baja = "UPDATE fruta SET stock=0, estado='BAJA' WHERE codigo_fruta='$id'";
    $dar_baja = $connect->query($baja);
    header('Location: ./../frutas.php');
    exit;
}

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-fkJS/Z+1bIP/hMBCkM78P4p4Px4o4Hn8aW9Aop1tS/ydLQrlS3oWw3qg3EdiV86C0QepLGyV7SXuq3IFpVzrHw==" crossorigin="anonymous" referrerpolicy="no-referrer">
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
            <li class="breadcrumb-item"><a href="./../frutas.php">Ver Frutas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Baja de <?php echo $fruta['nombre']; ?></li>
          </ol>
        </nav>
        <article class="col-12">
            <h4 class="display-6 text-center">Dar de baja el registro de <?php echo $fruta['nombre'];?></h4>
        </article>
        
        <article id="viewfru" class="col-12 bg-white h-100 p-3 bg-light border border-secondary rounded my-3 justify-content-center" style="--bs-border-opacity: .5;">       
        <!--    Selector de tipo de orden   -->
                <div id="modfruta" class="d-flex flex-column container my-3 shadow bg-secondary-subtle btn border border-secondary-subtle">
                    <div>
                        <h4>¿Quieres dar de baja <strong><?php echo $fruta['nombre'];?></strong> de las frutas del inventario?</h4>
                        <p>Si la das de baja no podrás realizar transacciones con esta fruta hasta que la vuelvas a dar de alta.</p>
                        <p><em>Al dar de baja la fruta esta pasará a estar en estado "BAJA" y el stock pasará a 0.</em></p>
                    </div>
                    <form id="" class="table-responsive order-2" action="" method="post">
                    <div class="table-responsive">
                      <table class="table table-striped table-secondary table-responsive table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Precio/kg €</th>
                                    <th>Origen</th>
                                    <th>Temporada</th>
                                    <th>Clase</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>

                                    <tr>
                                        <td><?php echo $fruta['codigo_fruta']; ?></td>
                                        <td><?php echo $fruta['nombre']; ?></td>
                                        <td><?php echo $fruta['precio']; ?>€</td>
                                        <td><?php echo $fruta['origen']; ?></td>
                                        <td><?php echo $fruta['temporada']; ?></td>
                                        <td><?php echo $fruta['clase']; ?></td>
                                        <td><i><?php echo $fruta['estado']; ?></i></td>
                                    </tr>

                            </tbody>
                      </table>
                    
                    </div>  
                    <div class="p-3">
                        <a class="btn btn-secondary me-2" href="./../frutas.php">Cancelar</a>
                        <button class="btn btn-danger ms-2" name="continuar" type="submit"><i class="fa fa-exclamation-triangle"></i><span class=""> Dar de baja</span></button>
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
  <script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
  </script>
</body>
<?php 
  $connect->close();
?>
</html>
