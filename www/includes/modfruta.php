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
$estado = " ";
// Consultar la fruta a modificar
$consulta = "SELECT * FROM fruta WHERE codigo_fruta = '$id'";
$resultado = $connect->query($consulta);
$fruta = $resultado->fetch_array();

// Verificar si se ha enviado el formulario de modificación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los valores ingresados en el formulario
    $nombre = $connect->real_escape_string($_POST['nombre']);
    $precio_unidad = $connect->real_escape_string($_POST['precio']);
    $origen = $connect->real_escape_string($_POST['origen']);
    $temporada = $connect->real_escape_string($_POST['temporada']);
    $clase = $connect->real_escape_string($_POST['clase']);
    $estado = $connect->real_escape_string($_POST['estado']);
    // Actualizar la fruta en la base de datos
    $consulta = "UPDATE fruta SET nombre = '$nombre', precio = '$precio_unidad', origen = '$origen', temporada = '$temporada', clase = '$clase', estado = '$estado' WHERE codigo_fruta = '$id'";
    $actualizar = $connect->query($consulta);

    // Redirigir al usuario de vuelta a la lista de frutas
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
            <li class="breadcrumb-item"><a href="./../frutas.php">Ver Frutas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Modificar <?php echo $fruta['nombre']; ?></li>
          </ol>
        </nav>
        <article class="col-12">
            <h4 class="display-6 text-center">Modificar  <?php echo $fruta['nombre']; ?></h4>
        </article>
        
        <article id="viewfru" class="col-12 bg-white h-100 p-3 bg-light border border-secondary rounded my-3 justify-content-center" style="--bs-border-opacity: .5;">       
        <!--    Selector de tipo de orden   -->
                <div id="modfruta" class="d-flex flex-column container my-3 shadow bg-warning-subtle btn border border-secondary-subtle">

                    <form id="" class="table-responsive order-2" action="" method="post">
                    <div class="table-responsive">
                      <table class="table table-striped table-warning table-responsive table-hover">
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
                                        <td><?php echo $fruta['estado']; ?></td>
                                    </tr>

                            </tbody>
                      </table>
                    </div>
                        <div class="row container">
                            <div class="mb-3 col-lg-6 col-sm-12 text-start">
                              <label for="formGroupExampleInput" class="form-label">Nombre de la fruta</label>
                              <input id="formGroupExampleInput" type="text" name="nombre" class="form-control" placeholder="Manzana" required value="<?php echo $fruta['nombre']; ?>">
                            </div>

                            <div class="mb-3 col-lg-6 col-sm-12 text-start">
                              <label for="formGroupExampleInput" class="form-label">Precio por unidad</label>
                              <input id="formGroupExampleInput" type="number" step="0.01" name="precio" class="form-control" required value="<?php echo $fruta['precio']; ?>">
                            </div>

                            <div class="mb-3 col-lg-6 col-sm-12 text-start">
                              <label for="formGroupExampleInput" class="form-label">Origen</label>
                              <input id="formGroupExampleInput" type="text" name="origen" class="form-control" placeholder="España" required value="<?php echo $fruta['origen']; ?>">
                            </div>

                            <div class="mb-3 col-lg-6 col-sm-12 text-start">
                              <label for="formGroupExampleInput" class="form-label">Temporada</label>
                              <?php ?>
                              <select name="temporada" class="form-select flex-row" required>
                                <option selected>- Indicar temporada -</option>
                                <option value="Perenne">Perenne</option>
                                <option value="Invierno">Invierno</option>
                                <option value="Primavera">Primavera</option>
                                <option value="Verano">Verano</option>
                                <option value="Otoño">Otoño</option>
                              </select>
                            </div>

                            <div class="mb-3 col-lg-6 col-sm-12 text-start">
                              <label for="formGroupExampleInput" class="form-label">Clase</label>
                              <select name="clase" class="form-select flex-row" required>
                                <option selected>- Indicar clase -</option>
                                <option value="Bayas">Bayas</option>
                                <option value="Cítricos">Cítricos</option>
                                <option value="Cucurbitáceos">Cucurbitáceos</option>
                                <option value="Exóticos">Exóticos</option>
                                <option value="Fruta dulce">Fruta dulce</option>
                                <option value="Frutos secos">Frutos secos</option>
                              </select>
                            </div>
                            <div class="mb-3 col-lg-6 col-sm-12 text-start">
                              <label for="formGroupExampleInput" class="form-label">Estado</label>
                              <select name="estado" class="form-select flex-row" required>
                                <option selected value="ALTA">ALTA</option>
                                <option value="BAJA">BAJA</option>
                              </select>
                            </div>
                            <div class="mb-3 col-lg-12 col-sm-12">
                              <button type="submit" class="btn btn-secondary" name="enviar">Enviar</button>
                            </div>
                            <div class="mb-3 col-lg-12 col-sm-12">
                              <?php 
                                  //echo $mensaje;
                              ?>
                            </div>
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
</body>
<?php 
  $connect->close();
?>
</html>