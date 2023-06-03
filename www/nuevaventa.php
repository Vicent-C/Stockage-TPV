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
$mensaje = " ";
// Consulta para obtener todas las frutas
$sql_frutas = "SELECT * FROM fruta WHERE kilos > 0";
$result_frutas = $connect->query($sql_frutas);
$factura_id = " " ;


// Insertar una nueva factura y obtener su ID
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nueva_venta"])) {
    $crear_cliente = "INSERT INTO cliente VALUES(default)";
    $connect->query($crear_cliente);
    $sql_factura = "INSERT INTO factura (cliente) VALUES ((SELECT MAX(id) FROM cliente))";
    $connect->query($sql_factura);
    $factura_id = $connect->insert_id;

    // Guardar el ID del albarán en una variable de sesión
    $_SESSION["factura_id"] = $factura_id;
    
// Consulta para obtener el último ID de cliente
$sql_clientes = "SELECT MAX(id) AS ID FROM cliente";
$clientes = $connect->query($sql_clientes);
$cliente_result = $clientes->fetch_assoc();
$cliente_id = $cliente_result['ID'];
}


// Insertar una nueva línea de factura por cada fruta seleccionada
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["realizar_venta"])) {
  // Verificar si se ha creado un nuevo pedido
  if (isset($_SESSION["factura_id"])) {
      $factura_id = $_SESSION["factura_id"];
      $frutas = $_POST["frutas"];
      $cantidades = $_POST["cantidades"];

      $stockSuficiente = true; // Variable para controlar si hay suficiente stock

      for ($i = 0; $i < count($frutas); $i++) {
          $fruta_id = $frutas[$i];
          $cantidad = $cantidades[$i];

          // Obtener el stock disponible de la fruta actual
          $sql_stock_actual = "SELECT stock FROM fruta WHERE codigo_fruta = $fruta_id";
          $result_stock_actual = $connect->query($sql_stock_actual);
          $row_stock_actual = $result_stock_actual->fetch_assoc();
          $stock_actual = $row_stock_actual['stock'];

          // Verificar si la cantidad a vender supera el stock disponible
          if ($cantidad > $stock_actual) {
              $stockSuficiente = false; // No hay suficiente stock
              break; // Salir del bucle en caso de error
          }

          // Insertar la línea de albarán
          $sql_linea = "INSERT INTO lineas_factura (kilos, precio_kilo, factura, fruta) VALUES ($cantidad, (SELECT precio FROM fruta WHERE codigo_fruta = $fruta_id), $factura_id, $fruta_id)";
          $connect->query($sql_linea);

          // Actualizar la cantidad de fruta en stock
          $sql_stock = "UPDATE fruta SET stock = stock - $cantidad WHERE codigo_fruta = $fruta_id";
          $connect->query($sql_stock);
      }

      if ($stockSuficiente) {
          unset($_SESSION["factura_id"]);
          header("location: ./nuevaventa.php");
      } else {
         $mensaje .= '<div class="alert alert-warning alert-dismissible fade show" role="alert">
         <strong>No se ha podido realizar la venta.</strong> La fruta con código "' . $fruta_id . '" no tiene suficiente stock .
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>';
      }
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
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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
            <li class="breadcrumb-item"><a href="./venta.php">Facturas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Nueva venta</li>
          </ol>
        </nav>

        
        <article class="col-12">
            <h4 class="display-6 text-center">Hacer nueva venta</h4>
        </article>

        <article id="viewfru" class="col-12 bg-white h-100 p-3 bg-light border border-secondary rounded my-3 justify-content-center" style="--bs-border-opacity: .5;">       

            <div id="verfruta" class="d-flex flex-column container my-3 shadow bg-secondary-subtle btn border border-secondary-subtle">
              <p>Primero debes crear una nueva venta, de lo contrario no se tramitará la venta correctamente.</p>
              <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" class=" table-responsive">
                  <label for="cliente">cliente:</label>
                  <input type="number" value="<?php echo $cliente_id; ?>" readonly style="width:50px; text-align:center;">
                  
                  <input type="hidden" name="nueva_venta" value="1">
                  <input class="btn btn-success" type="submit" value="Crear nueva venta">
              </form>
              <div class="table-responsive">
                    <?php
                      // Mostrar las frutas existentes
                      if ($result_frutas->num_rows > 0) {
                          echo "<h2>Frutas disponibles</h2>";
                          echo "<form method='POST' action='" . $_SERVER["PHP_SELF"] . "'>";
                          echo "<table class='table table-striped table-secondary table-responsive table-hover'>";
                          echo "<thead class='text-muted'>";
                          echo "<tr><th>Código fruta</th><th>Fruta</th><th>Precio/kg €</th><th>Stock/kg</th><th>Kilos</th></tr>";
                          echo "</thead>";                  
                          while ($row = $result_frutas->fetch_assoc()) {
                             echo "<tr>";
                              echo "<td>".$row["codigo_fruta"]."</td>";
                              echo "<td>".$row["nombre"]."</td>";
                              echo "<td>".$row['precio']." €</td>";
                              echo "<td>".$row["stock"]." kg</td>";
                              echo "<td><input type='number' step='0.01' name='cantidades[]' min='0' value='0'></td>";
                              echo "<input type='hidden' name='frutas[]' value='".$row["codigo_fruta"]."'>";
                              echo "</tr>";
                          }
                        
                          echo "</table>";
                          echo "<br>";
                          echo $mensaje;
                          echo "<br>";
                          echo "Factura ID: <input type='text' name='factura_id' value='$factura_id' readonly>";
                          echo "<br>";

                          echo "<input class='btn btn-success my-3' type='submit' name='realizar_venta' id='realizar_venta' value='Realizar Venta'>";
                          echo "</form>";
                      }
                    ?>
                  </div>
                  <!-- Formulario para cancelar el pedido actual -->
                  <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                      <input type="hidden" name="cancelar_pedido" value="1">
                      <input type="hidden" name="factura_id" value="<?php echo $factura_id; ?>">
                      <input class="btn btn-danger my-3" type="submit" value="Cancelar Venta" id="cancelar_venta">
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