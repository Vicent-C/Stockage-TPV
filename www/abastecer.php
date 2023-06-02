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
// Consulta para obtener todas las frutas
$sql_frutas = "SELECT * FROM fruta WHERE estado = 'ALTA'";
$result_frutas = $connect->query($sql_frutas);
$albaran_id = " " ;
// Consulta para obtener todos los proveedores
$sql_proveedores = "SELECT * FROM proveedor WHERE estado='ALTA'";
$result_proveedores = $connect->query($sql_proveedores);



// Insertar un nuevo albarán y obtener su ID
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nuevo_pedido"])) {
    $proveedor_id = $_POST["proveedor"];
    $sql_albaran = "INSERT INTO albaran (proveedor) VALUES ('$proveedor_id')";
    $connect->query($sql_albaran);
    $albaran_id = $connect->insert_id;

    // Guardar el ID del albarán en una variable de sesión
    $_SESSION["albaran_id"] = $albaran_id;
}

// Insertar una nueva línea de albarán por cada fruta seleccionada
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["realizar_pedido"])) {
    // Verificar si se ha creado un nuevo pedido
    if (isset($_SESSION["albaran_id"])) {
        $albaran_id = $_SESSION["albaran_id"];
        $frutas = $_POST["frutas"];
        $cantidades = $_POST["cantidades"];

        for ($i = 0; $i < count($frutas); $i++) {
            $fruta_id = $frutas[$i];
            $cantidad = $cantidades[$i];



            // Insertar la línea de albarán
            $sql_linea = "INSERT INTO lineas_albaran (kilos, precio_kilo, albaran, fruta) VALUES ($cantidad, (SELECT precio -0.30 AS precio_kilo FROM fruta WHERE codigo_fruta = $fruta_id), $albaran_id, $fruta_id)";
            $connect->query($sql_linea);

            // Actualizar la cantidad de fruta en stock
            $sql_stock = "UPDATE fruta SET stock = stock + $cantidad WHERE codigo_fruta = $fruta_id";
            $connect->query($sql_stock);
        }

        // Limpiar la variable de sesión del ID del albarán
        unset($_SESSION["albaran_id"]);
        header("location: ./abastecer.php");
    }
}

// Eliminar un albarán y sus líneas asociadas
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cancelar_pedido"])) {
    // Verificar si se ha creado un nuevo pedido
    if (isset($_SESSION["albaran_id"])) {
        $albaran_id = $_SESSION["albaran_id"];

        // Eliminar las líneas de albarán asociadas
        $sql_lineas = "DELETE FROM lineas_albaran WHERE albaran = $albaran_id";
        $connect->query($sql_lineas);

        // Eliminar el albarán
        $sql_albaran = "DELETE FROM albaran WHERE num_albaran = $albaran_id";
        $connect->query($sql_albaran);

        // Limpiar la variable de sesión del ID del albarán
        unset($_SESSION["albaran_id"]);
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
            <li class="breadcrumb-item"><a href="./albaran.php">Albaranes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Nuevo pedido</li>
          </ol>
        </nav>
        <article class="col-12">
            <h4 class="display-6 text-center">Hacer nuevo pedido</h4>
        </article>

        <article id="viewfru" class="col-12 bg-white h-100 p-3 bg-light border border-secondary rounded my-3 justify-content-center" style="--bs-border-opacity: .5;">       

            <div id="verfruta" class="d-flex flex-column container my-3 shadow bg-secondary-subtle btn border border-secondary-subtle">
              <p>Primero debes crear un nuevo pedido, de lo contrario no se tramitará el pedido correctamente.</p>
              <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                  <label for="proveedor">Proveedor:</label>
                  <select name="proveedor" id="proveedor">
                      <?php
                      if ($result_proveedores->num_rows > 0) {
                          while ($row = $result_proveedores->fetch_assoc()) {
                              echo "<option value='".$row["cif"]."'>".$row["razon_social"]."</option>";
                          }
                      }
                      ?>
                  </select>
                  <input type="hidden" name="nuevo_pedido" value="1">
                  <input class="btn btn-success" type="submit" value="Crear nuevo pedido">
              </form>

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
                              $precio = $row['precio']-0.08;
                              echo "<tr>";
                              echo "<td>".$row["codigo_fruta"]."</td>";
                              echo "<td>".$row["nombre"]."</td>";
                              echo "<td>".$precio." €</td>";
                              echo "<td>".$row["stock"]." kg</td>";
                              echo "<td><input type='number' step='0.01' name='cantidades[]' min='0' value='0'></td>";
                              echo "<input type='hidden' name='frutas[]' value='".$row["codigo_fruta"]."'>";
                              echo "</tr>";
                          }
                        
                          echo "</table>";
                          echo "<br>";
                          echo "Albarán ID: <input type='text' name='albaran_id' value='$albaran_id' readonly>";
                          echo "<br>";
                          echo "<input class='btn btn-success my-3' type='submit' name='realizar_pedido' id='realizar_pedido' value='Realizar Pedido'>";
                          echo "</form>";
                      }
                    ?>

                  <!-- Formulario para cancelar el pedido actual -->
                  <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                      <input type="hidden" name="cancelar_pedido" value="1">
                      <input type="hidden" name="albaran_id" value="<?php echo $albaran_id; ?>">
                      <input class="btn btn-danger my-3" type="submit" value="Cancelar Pedido" id="cancelar_pedido">
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