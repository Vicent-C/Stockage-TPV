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
    //consulta para cuando se carga la página
    $query = "SELECT * FROM proveedor";
    $stmt = $connect->query($query); 

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
    <section class="container-fluid col-lg-10 col-md-10 col-sm-10">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./index.php">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Proveedores</li>
          </ol>
        </nav>
        <article class="col-12">
            <h4 class="display-6 text-center">Proveedores</h4>
        </article>

        <article class="col-12 bg-white h-100 p-3 bg-light border border-secondary rounded my-3 justify-content-center" style="--bs-border-opacity: .5;">       
        <!--    Selector de tipo de orden   -->
            <div id="" class="d-flex flex-column container my-3 shadow bg-secondary-subtle btn border border-secondary-subtle">
            <a href="./nuevoproveedor.php" class="align-self-end btn btn-success my-3"><i class="fas fa-plus"></i> Nueva alta</a>
            <p><i>Los proveedores no se pueden eliminar para mantener bajo custodia la información de estos, y la actividad realizada con pedidos y precios de frutas.</i></p>

                <div id="" class="d-flex flex-row row justify-content-center order-2 d-inline ">
                        <?php
                            //bucle que sacará todas las frutas cuando cargue la página web
                            
                            while($row = $stmt->fetch_array()){  ?>  
                                <div class="card border border-secondary text-start m-3" style="width: 25rem;">
                                  <?php echo $row['mapa']; ?>
                                  <div class="card-body">
                                    <h5 class="card-title text-center"><?php echo $row['razon_social']; ?></h5>
                                    <hr class="text-secondary">
                                    <p class="card-text"><?php echo $row['descripcion']; ?></p>
                                  </div>
                                  <ul class="list-group list-group-flush text-start">
                                    <li class="list-group-item"><i class="fa-solid fa-id-card-clip text-secondary me-1"></i> <?php echo $row['cif'];?></li>
                                    <li class="list-group-item"><i class="fa-solid fa-phone text-secondary me-1"></i> <?php echo $row['telefono'];?></li>
                                    <li class="list-group-item"><i class="fa-solid fa-envelope text-secondary me-1"></i> <?php echo $row['email'];?></li>
                                    <li class="list-group-item"><i class="fa-solid fa-location-dot text-secondary me-1"></i> <?php echo $row['dirección'];?></li>
                                    <li class="list-group-item"><i class="fas fa-info text-secondary me-1"></i> <?php echo $row['estado'];?></li>
                                    <li class="list-group-item text-end"><a href="./includes/modproveedor.php?cif=<?php echo $row['cif']?>" class="btn btn-outline-success mx-2"><i class="fas fa-edit"></i></a><a href="#Eliminar" class="btn btn-danger disabled"><i class="fas fa-trash"></i></a></li>
                                  </ul>
                                  
                                </div>
                           <?php } ?>
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