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
    $consulta = "SELECT factura.num_factura, factura.fecha_salida, lineas_factura.kilos, lineas_factura.precio_kilo, factura.cliente 
    FROM factura 
    JOIN lineas_factura ON factura.num_factura = lineas_factura.factura WHERE lineas_factura.kilos > 0 GROUP BY lineas_factura.factura";
$stmt1 = $connect->query($consulta);
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
            <li class="breadcrumb-item active" aria-current="page">Facturas</li>
          </ol>
        </nav>
        <article class="col-12">
            <h4 class="display-6 text-center">Facturas </h4>
        </article>

        <article id="viewfru" class="col-12 bg-white h-100 p-3 bg-light border border-secondary rounded my-3 justify-content-center" style="--bs-border-opacity: .5;">       
        <!--    Selector de tipo de orden   -->
            <div id="verfruta" class="d-flex flex-column container my-3 shadow bg-success-subtle btn border border-success-subtle">
            <a href="nuevaventa.php" class="align-self-end btn btn-success my-3"><i class="fas fa-plus"></i> Nueva venta</a>
              <div class=" table-responsive">
                  <table class="table table-striped table-success table-responsive table-hover">
                  
                    <thead class="text-muted">
                        <th class="text-center">Nº Factura</th>
                        <th class="text-center">Cliente</th>
                        <th class="text-center">Fecha de salida</th>
                        <th class="text-center">Kilos</th>
                        <th class="text-center">Total + IVA incl. €</th>
                        <th class="text-center">Info</th>
                    </thead>
                    <tbody class="">
                        <?php
                          //Declarar variables para evitar errores
                          $precioUnid = 0;
                          $cantidadUnid = 0;
                          $totalPrecio = 0;
                          if($stmt1->num_rows>0){
                            //bucle que sacará todas las frutas cuando cargue la página web
                            
                            while($row = $stmt1->fetch_array()){
                              //Calcular precios  
                              $precioUnid = $row['precio_kilo'];
                              $cantidadUnid = $row['kilos'];
                              $subtotal = $precioUnid * $cantidadUnid;
                              $totalPrecio = $subtotal;
                              
                              // Consulta para obtener el precio total sumando los resultados de las líneas con el mismo número de albarán
                              $consultaSuma = "SELECT SUM(lineas_factura.kilos * lineas_factura.precio_kilo) AS total
                                               FROM lineas_factura
                                               WHERE lineas_factura.factura = " . $row['num_factura'];
                              $stmtSuma = $connect->query($consultaSuma);
                              $rowSuma = $stmtSuma->fetch_array();

                              // Consulta para obtener la suma de las cantidades de unidades de las líneas con el mismo número de albarán
                              $consultaSumaCantidades = "SELECT SUM(lineas_factura.kilos) AS total_cantidades
                              FROM lineas_factura
                              WHERE lineas_factura.factura = " . $row['num_factura'];
                              $stmtSumaCantidades = $connect->query($consultaSumaCantidades);
                              $rowSumaCantidades = $stmtSumaCantidades->fetch_array();
                              $totalCantidades = $rowSumaCantidades['total_cantidades'];

                              // Actualizar el valor de $cantidadUnid con la suma de las cantidades de unidades
                              $cantidadUnid = $totalCantidades;
                              if ($rowSuma['total']) {
                                $totalPrecio += $rowSuma['total'];
                              }
                              echo "<tr>";
                              echo     "<td>" . $row['num_factura'] . "</td>"; 
                              echo     "<td>" . $row['cliente'] . "</td>";
                              echo     "<td>" . $row['fecha_salida'] . "</td>";
                              echo     "<td>" . $cantidadUnid . " uds</td>";
                              echo     "<td>" . round($rowSuma['total'],2) . " €</td>";
                              echo     "<td><a id='' href='./includes/verfactura.php?factura=" . $row['num_factura'] . "' role='button' class='btn btn-outline-secondary' data-toggle='modal'><i class='fa-sharp fa-solid fa-circle-info'></i></a></td>";
                              echo "</tr>";
                            }
                          
                          }else{
                            echo "<tr>";
                            echo "<td colspan='6'>No se encontraron facturas disponibles</td>";
                            echo "<tr>";
                          }
                         ?>
                </tbody>
              </table>
              </div>
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
  <script src="script.js"></script>
  <script src="https://replit.com/public/js/replit-badge-v2.js" theme="dark" position="bottom-right"></script>
</body>
<?php 
  $connect->close();
?>
</html>