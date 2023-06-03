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

      $cif = $connect->real_escape_string($_POST['cif']);
      $razon_social = $connect->real_escape_string($_POST['razon_social']);
      $email = $connect->real_escape_string($_POST['email']);
      $telefono = $connect->real_escape_string($_POST['telefono']);
      $dirección = $connect->real_escape_string($_POST['dirección']);
      $mapa = $connect->real_escape_string($_POST['mapa']);
      $descripcion = $connect->real_escape_string($_POST['descripcion']);
     
          
      //comprobar si existe la fruta

      $comprobar_fruta = "SELECT * FROM proveedor WHERE cif = '$cif'";
      $comprobando = $connect->query($comprobar_fruta);
      
      //insertar los datos en la base de datos
      $insertar = "INSERT INTO proveedor(cif, razon_social, email, telefono, dirección, mapa, descripcion) VALUES('$cif', '$razon_social', '$email', '$telefono', '$dirección', '$mapa', '$descripcion')";
      
      $result =" ";
      if($comprobando->num_rows > 0){
        $mensaje.='<div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong>No se dió de alta el proveedor.</strong> Ya existe una proveedor con este CIF.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
          ';
      }elseif($comprobando->num_rows == 0){
        $guardar = $connect->query($insertar);
        $mensaje.='<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Proveedor dado de alta.</strong> Se ha añadido la fruta satisfactoriamente.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
        ';
      }else{
        $mensaje.='<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error al añadir.</strong> Se ha producido un error al dar de alta al proveedor.
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
            <li class="breadcrumb-item"><a href="./proveedor.php">Proveedores</a></li>
            <li class="breadcrumb-item active" aria-current="page">Alta proveedor</li>
          </ol>
        </nav>
        <article class="col-12">
          <h4 class="display-6 text-center">Nueva alta de proveedor</h4>
        </article>
        <article id="viewfru" class="col-12 bg-white h-100 p-3 bg-light border border-secondary rounded my-3 d-flex justify-content-center" style="--bs-border-opacity: .5;">
          <!-- Añadir nueva fruta -->
          
            <div id="newfruta" class="container my-3 shadow bg-secondary-subtle btn border border-secondary-subtle">
              
              <form id="newfru" class="container col-8 my-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <!-- Formulario para añadir la fruta -->              
                <div class="row">
                    <div class="mb-3 col-lg-6 col-sm-12 text-start">
                    <label for="formGroupExampleInput" class="form-label">CIF</label>
                    <input id="formGroupExampleInput" type="text" name="cif" class="form-control" placeholder="A00000000" required>
                  </div>    

                  <div class="mb-3 col-lg-6 col-sm-12 text-start">
                    <label for="formGroupExampleInput" class="form-label">Razón social</label>
                    <input id="formGroupExampleInput" type="text" name="razon_social" class="form-control" placeholder="Empresa SL" required>
                  </div>

                  <div class="mb-3 col-lg-6 col-sm-12 text-start">
                    <label for="formGroupExampleInput" class="form-label">Teléfono</label>
                    <input id="formGroupExampleInput" type="tel" name="telefono" class="form-control" placeholder="+34 960 000 000" required>
                  </div>
                  
                  <div class="mb-3 col-lg-6 col-sm-12 text-start">
                    <label for="formGroupExampleInput" class="form-label">Correo electrónico</label>
                    <input id="formGroupExampleInput" type="email" name="email" class="form-control" placeholder="business@mail.com" required>
                  </div>
                  <div class="mb-3 col-lg-6 col-sm-12 text-start">
                    <label for="formGroupExampleInput" class="form-label">Dirección</label>
                    <input id="formGroupExampleInput" type="text" name="dirección" class="form-control" placeholder="C/ domicilio social, 1, 46700, Ciudad" required>
                  </div>

                  <div class="mb-3 col-lg-6 col-sm-12 text-start">
                    <label for="formGroupExampleInput" class="form-label">Mapa</label>
                    <input id="formGroupExampleInput" type="text" name="mapa" class="form-control" placeholder="Iframe de mapa" required>
                    
                  </div>
                  <div class="mb-3 col-lg-6 col-sm-12 text-start">
                    <label for="formGroupExampleInput" class="form-label">Descripción</label>
                    <input name="descripcion" class="form-control text-align-top" placeholder="Descripción" id="floatingTextarea2"></input>
                  </div>
                  <p>Cuando añadas el mapa introduce el siguiente fragmento de código al final de la etiqueta iframe.<pre><code>&lt;iframe class="card-img-top"&gt;&lt;/iframe&gt;</code></pre></p>
                  <div class="mb-3 col-lg-12 col-sm-12">
                    <button type="submit" class="btn btn-secondary" name="enviar">Dar de alta</button>
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