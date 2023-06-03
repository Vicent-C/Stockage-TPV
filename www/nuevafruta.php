<?php
// recordar la variable de sesión
session_start();
include './includes/conn.php';
//verificar que se ha creado la variable de sesión.
if(!isset($_SESSION['login']) || $_SESSION['login'] !== TRUE){
    header('location:login.php');
    exit;

}
$username = $_SESSION['Usuario'];
    //inicializar la variable que mostrará el mensaje al enviar los datos
    $mensaje = " ";


    // validar la existencia del botón para envíar los datos
    if(isset($_POST['enviar'])){

      $nombre = $connect->real_escape_string($_POST['nombre']);
      $precio_kilo = $connect->real_escape_string($_POST['precio']);
      $origen = $connect->real_escape_string($_POST['origen']);
      $temporada = $connect->real_escape_string($_POST['temporada']);
      $clase = $connect->real_escape_string($_POST['clase']);

     
          
      //comprobar si existe la fruta

      $comprobar_fruta = "SELECT * FROM fruta WHERE nombre = '$nombre'";
      $comprobando = $connect->query($comprobar_fruta);
      
      //insertar los datos en la base de datos
      $insertar = "INSERT INTO fruta (nombre, precio, origen, temporada, clase, stock, estado) VALUES('$nombre',$precio_kilo,'$origen','$temporada','$clase',0,'ALTA')";
      
      $result =" ";
      if($comprobando->num_rows > 0){
        $mensaje.='<div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong>No se añadió la fruta.</strong>Ya existe una fruta con este nombre.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
          ';
      }elseif($comprobando->num_rows == 0){
        $guardar = $connect->query($insertar);
        $mensaje.='<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Fruta añadida.</strong> Se ha añadido la fruta satisfactoriamente.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
        ';
      }else{
        $mensaje.='<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error al añadir.</strong>Se ha producido un error al añadir la fruta.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
        ';
      }

      
    }

?>
<!DOCTYPE html>
<html id="htmlpr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Stockage TPV</title>
  <link href="./css/style.css" rel="stylesheet" type="text/css" />
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
  include 'includes/navbar.php';
  ?>
  
  <!--      CONTENIDO      -->
  <main id="mainpr" class="contenedor content col-12">
    <section class="container-fluid col-lg-10 col-md-10 col-sm-10 justify-content-center">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="./frutas.php">Ver Frutas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Nueva fruta</li>
          </ol>
        </nav>
        <article class="col-12">
          <h4 class="display-6 text-center">Añadir nueva fruta</h4>
        </article>
        <article id="viewfru" class="col-12 bg-white h-100 p-3 bg-light border border-secondary rounded my-3 d-flex justify-content-center" style="--bs-border-opacity: .5;">
          <!-- Añadir nueva fruta -->
          
            <div id="newfruta" class="container my-3 shadow bg-secondary-subtle btn border border-secondary-subtle">
              
              <form id="newfru" class="container col-8 my-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <!-- Formulario para añadir la fruta -->              
                <div class="row">
                  <div class="mb-3 col-lg-6 col-sm-12 text-start">
                    <label for="formGroupExampleInput" class="form-label">Nombre de la fruta</label>
                    <input id="formGroupExampleInput" type="text" name="nombre" class="form-control" placeholder="Manzana" required>
                  </div>

                  <div class="mb-3 col-lg-6 col-sm-12 text-start">
                    <label for="formGroupExampleInput" class="form-label">Precio/kg €</label>
                    <input id="formGroupExampleInput" type="number" step="0.01" min="0.70" name="precio" class="form-control" required>
                  </div>
                  
                  <div class="mb-3 col-lg-6 col-sm-12 text-start">
                    <label for="formGroupExampleInput" class="form-label">Origen</label>
                    <input id="formGroupExampleInput" type="text" name="origen" class="form-control" placeholder="España" required>
                  </div>

                  <div class="mb-3 col-lg-6 col-sm-12 text-start">
                    <label for="formGroupExampleInput" class="form-label">Temporada</label>
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
                  
                  <div class="mb-3 col-lg-12 col-sm-12">
                    <button type="submit" class="btn btn-secondary" name="enviar">Añadir fruta</button>
                  </div>
                  <div class="mb-3 col-lg-12 col-sm-12">
                    <?php 
                        echo $mensaje;
                    ?>
                  </div>
                </div>
                
              </form>

            </div>

        </article>
    </section>

  </main>
  <?php 
    include 'includes/footer.php';
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