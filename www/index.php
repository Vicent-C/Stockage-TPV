<?php
// recordar la variable de sesión
session_start();
//Incluir el archivo de conexión a la base de datos.
include './includes/conn.php';
//verificar que se ha creado la variable de sesión.
if(!isset($_SESSION['login']) || $_SESSION['login'] !== TRUE){
    header('location:login.php');
    exit;
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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body id="bodypr" class="vh-100 bg-secondary-subtle">
  <?php 
  //Incluir el archivo del navbar
  include 'includes/navbar.php';
  ?>
  <!--      CONTENIDO PRINCIPAL     -->
  <main id="mainpr" class=" contenedor content col-12">
    <section class="container-fluid col-lg-10 col-md-10 col-sm-10 justify-content-center">
      <article class="col-12">
        <h3 class="display-6 text-center">Dashboard</h3>
      </article>
      <article class=" container bg-light border border-secondary rounded mt-1 mb-3" style="--bs-border-opacity: .5;">
        <div id="sectdiv" class="col-md">
          <div class="row row-cols-md mx-auto justify-content-center">
            <a href="./frutas.php" id="divbutton" class="shadow col-sm m-2 bg-primary-subtle btn border border-primary-subtle" style="--bs-border-opacity: .5;"><i class="fas fa-apple-alt"></i>Ver Frutas</a>
            <a href="proveedor.php" id="divbutton" class="shadow col-sm m-2 bg-secondary-subtle btn border border-secondary-subtle" style="--bs-border-opacity: .5;"><i class="fa-solid fa-truck-field"></i>Ver Proveedores</a>
            <a href="nuevaventa.php" id="divbutton" class="shadow col-sm m-2 bg-dark-subtle btn border border-dark-subtle" style="--bs-border-opacity: .5;"><i class="fas fa-store-alt me-2"></i> Realizar Venta</a>
          </div>
        </div>
     
        <div id="sectdiv" class="col-md">
          <div class="row row-col-md mx-auto justify-content-center">
            <a href="venta.php" id="divbutton" class="shadow col-sm m-2 bg-success-subtle btn border border-success-subtle" style="--bs-border-opacity: .5;"><i class="fas fa-chart-line"></i>Histórico de Ventas</a>
            <a href="./inventario.php" id="divbutton" class="shadow col-sm m-2 bg-info-subtle btn border border-info-subtle" style="--bs-border-opacity: .5;"><i class="fas fa-cubes"></i>Inventario</a>
            <a href="./albaran.php" id="divbutton" class="shadow col-sm m-2 bg-danger-subtle btn border border-danger-subtle" style="--bs-border-opacity: .5;"><i class="fas fa-chart-bar"></i>Histórico albarán</a>
          </div>
        </div>

      </article>
      <article class="container bg-light border border-secondary rounded mt-1 mb-3" style="--bs-border-opacity: .5;">
        <div class="row col-md">
          <div class="col-lg-6 mx-auto">
            <!--  Este espacio es para las gráficas -->
            <canvas id="grafica" class="shadow col-sm m-2 bg-danger-subtle btn border border-danger-subtle" style="--bs-border-opacity: .5;"></canvas>

            <?php
            // Obtener los datos de albaranes
            $queryAlbaranes = "SELECT albaran, fecha_entrada, SUM(precio_kilo*kilos) AS precio FROM lineas_albaran JOIN albaran WHERE lineas_albaran.albaran=albaran.num_albaran AND kilos > 0 GROUP BY albaran";
            $resultadoAlbaranes = $connect->query($queryAlbaranes);

            // Preparar los datos para la gráfica
            $labels = array();
            $dataAlbaranes = array();
            $dataFacturas = array();

            // Obtener los datos de albaranes
            while ($filaAlbaranes = $resultadoAlbaranes->fetch_array()) {
                $labels[] = $filaAlbaranes['fecha_entrada'];
                $dataAlbaranes[] = round($filaAlbaranes['precio'],2);;
            }
            ?>
            <script>
            // Preparar los datos para la gráfica
            var labels = <?php echo json_encode($labels); ?>;
            var dataAlbaranes = <?php echo json_encode($dataAlbaranes); ?>;
            var dataFacturas = <?php echo json_encode($dataFacturas); ?>;

            // Crear la gráfica utilizando Chart.js
            var ctx = document.getElementById('grafica').getContext('2d');
            var grafica = new Chart(ctx, {
                type: 'line', // Tipo de gráfica de barras
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Precio €',
                        data: dataAlbaranes,
                        borderColor:'rgba(255, 29, 29, 0.5)', //Color de las líneas
                        backgroundColor: 'rgba(255, 29, 29, 1)', // Color de las barras de albaranes
                    }]
                },
                options: {
                 responsive: true,
                     plugins: {
                       legend: {
                         position: 'top',
                       },
                       title: {
                         display: true, //Mostrar título en la gráfica
                         text: 'Datos de albaranes' //Nombre del título
                       }
                     }
                  }
            });
            </script>
          </div>

          <div class="col-lg-6 mx-auto">
            <!--  Este espacio es para las gráficas -->
            <canvas id="grafica_facturas" class="shadow col-sm m-2 bg-success-subtle btn border border-success-subtle" style="--bs-border-opacity: .5;"></canvas>

            <?php


            // Obtener los datos de albaranes
            $queryFacturas = "SELECT factura, fecha_salida, SUM(precio_kilo*kilos) AS precio FROM lineas_factura JOIN factura WHERE lineas_factura.factura=factura.num_factura AND kilos > 0 GROUP BY factura";
            $resultadoFacturas = $connect->query($queryFacturas);

            // Preparar los datos para la gráfica
            $labels = array();
            $dataFacturas = array();
            $dataFacturas = array();

            // Obtener los datos de albaranes
            while ($filaFactura = $resultadoFacturas->fetch_array()) {
                $labels[] = $filaFactura['fecha_salida'];
                $dataFacturas[] = round($filaFactura['precio'],2);
            }

            ?>

            <script>
            // Preparar los datos para la gráfica
            var labels = <?php echo json_encode($labels); ?>;
            var dataFacturas = <?php echo json_encode($dataFacturas); ?>;
            var dataFacturas = <?php echo json_encode($dataFacturas); ?>;

            // Crear la gráfica utilizando Chart.js
            var ctx = document.getElementById('grafica_facturas').getContext('2d');
            var grafica = new Chart(ctx, {
                type: 'line', // Tipo de gráfica de barras
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Precio €',
                        data: dataFacturas,
                        borderColor:'rgba(78, 205, 99, 0.5)',
                        backgroundColor: 'rgba(78, 205, 99, 1)', // Color de las barras de albaranes
                    }]
                },
                options: {
                 responsive: true,
                     plugins: {
                       legend: {
                         position: 'top',
                       },
                       title: {
                         display: true,
                         text: 'Datos de Ventas'
                       }
                     }
                  }     
            });
            </script>
          </div>
        </div>
      </article>
    </section>
  </main>
  <?php 
  //Incluir archivo para el footer de la página
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
//Cerramos la conexión a la base de datos
  $connect->close();
?>
</html>