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
$cif = $_GET['cif'];
//declarar variables vacías
$razon_social = " ";
$email = " ";
$telefono = " ";
$dirección = " ";
$mapa = " ";
$descripcion = " ";
$estado = " ";
// Consultar la fruta a modificar
$consulta = "SELECT * FROM proveedor WHERE cif = '$cif'";
$resultado = $connect->query($consulta);
$proveedor = $resultado->fetch_array();
// Verificar si se ha enviado el formulario de modificación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los valores ingresados en el formulario
    $razon_social = $connect->real_escape_string($_POST['razon_social']);
    $email = $connect->real_escape_string($_POST['email']);
    $telefono = $connect->real_escape_string($_POST['telefono']);
    $dirección = $connect->real_escape_string($_POST['dirección']);
    $mapa = $connect->real_escape_string($_POST['mapa']);
    $descripcion = $connect->real_escape_string($_POST['descripcion']);
    $estado = $connect->real_escape_string($_POST['estado']);
    // Actualizar la fruta en la base de datos
    $consulta = "UPDATE proveedor SET razon_social = '$razon_social', email = '$email', telefono = '$telefono', dirección = '$dirección', mapa = '$mapa', descripcion = '$descripcion', estado = '$estado' WHERE cif = '$cif'";
    $actualizar = $connect->query($consulta);
    // Redirigir al usuario de vuelta a la lista de frutas
    header('Location: ./../proveedor.php');
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
            <li class="breadcrumb-item"><a href="./../proveedor.php">Proveedores</a></li>
            <li class="breadcrumb-item active" aria-current="page">Modificar <?php echo $proveedor['cif']; ?></li>
          </ol>
        </nav>
        <article class="col-12">
            <h4 class="display-6 text-center">Modificar  <?php echo $proveedor['cif']; ?></h4>
        </article>
        
        <article id="viewfru" class="col-12 bg-white h-100 p-3 bg-light border border-secondary rounded my-3 justify-content-center" style="--bs-border-opacity: .5;">       
        <!--    Selector de tipo de orden   -->
                <div id="modfruta" class="d-flex flex-column container my-3 shadow bg-secondary-subtle btn border border-secondary-subtle">

                <form id="newfru" class="container col-8 my-3" action="" method="post">
                <!-- Formulario para añadir la fruta -->              
                <div class="row">
                     

                  <div class="mb-3 col-lg-6 col-sm-12 text-start">
                    <label for="formGroupExampleInput" class="form-label">Razón social</label>
                    <input id="formGroupExampleInput" type="text" name="razon_social" class="form-control" placeholder="Empresa SL" required value="<?php echo $proveedor['razon_social']; ?>">
                  </div>

                  <div class="mb-3 col-lg-6 col-sm-12 text-start">
                    <label for="formGroupExampleInput" class="form-label">Teléfono</label>
                    <input id="formGroupExampleInput" type="tel" name="telefono" class="form-control" placeholder="+34 960 000 000" required value="<?php echo $proveedor['telefono']; ?>">
                  </div>
                  
                  <div class="mb-3 col-lg-6 col-sm-12 text-start">
                    <label for="formGroupExampleInput" class="form-label">Correo electrónico</label>
                    <input id="formGroupExampleInput" type="email" name="email" class="form-control" placeholder="business@mail.com" required value="<?php echo $proveedor['email']; ?>">
                  </div>
                  <div class="mb-3 col-lg-6 col-sm-12 text-start">
                    <label for="formGroupExampleInput" class="form-label">Dirección</label>
                    <input id="formGroupExampleInput" type="text" name="dirección" class="form-control" placeholder="C/ domicilio social, 1, 46700, Ciudad" required value="<?php echo $proveedor['dirección']; ?>">
                  </div>

                  <div class="mb-3 col-lg-6 col-sm-12 text-start">
                    <label for="formGroupExampleInput" class="form-label">Mapa</label>
                    <input id="formGroupExampleInput" type="text" name="mapa" class="form-control" placeholder="Iframe de mapa" required value="<?php echo htmlspecialchars($proveedor['mapa']);?>">
                  </div>
                  <div class="mb-3 col-lg-6 col-sm-12 text-start">
                    <label for="formGroupExampleInput" class="form-label">Descripción</label>
                    <input name="descripcion" class="form-control text-align-top" placeholder="Descripción" id="floatingTextarea2" value="<?php echo $proveedor['descripcion']; ?>">
                  </div>
                  <div class="mb-3 col-lg-6 col-sm-12 text-start">
                    <label for="formGroupExampleInput" class="form-label">Estado</label>
                    <select name="estado" class="form-select flex-row">
                      <option selected value="ALTA">ALTA</option>
                      <option value="BAJA">BAJA</option>
                    </select>
                  </div>
                  <p>Cuando añadas el mapa introduce el siguiente fragmento de código al final de la etiqueta iframe.<pre><code>&lt;iframe class="card-img-top"&gt;&lt;/iframe&gt;</code></pre></p>
                  <div class="mb-3 col-lg-12 col-sm-12">
                    <button type="submit" class="btn btn-secondary" name="enviar">Enviar</button>
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