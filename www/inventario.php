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
    $query_sin_filtro = "SELECT * FROM fruta WHERE estado = 'ALTA'";
    $stmt1 = $connect->query($query_sin_filtro);


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
            <li class="breadcrumb-item active" aria-current="page">Inventario</li>
          </ol>
        </nav>
        <article class="col-12">
            <h4 class="display-6 text-center">Inventario</h4>
        </article>

        <article id="viewfru" class="col-12 bg-white h-100 p-3 bg-light border border-secondary rounded my-3 justify-content-center" style="--bs-border-opacity: .5;">       
        <!--    Selector de tipo de orden   -->
            <div id="verfruta" class="d-flex flex-column container my-3 shadow bg-secondary-subtle btn border border-secondary-subtle">
                <form method="POST" action="" class="my-3" class="order-1 justify-content-end">
                  <div id="ordbtn" class="input-group mb-3">
                    <select name="orden" id="orden" class="form-select w-25 flex-row">
                      <option value="sinorden">-</option>
                      <option value="fruta_asc">Código (Ascendente)</option>
                      <option value="fruta_desc">Código (Descendente)</option>
                      <option value="nombre_asc">Nombre (Ascendente)</option>
                      <option value="nombre_desc">Nombre (Descendente)</option>
                      <option value="cantidad_asc">Cantidad (Ascendente)</option>
                      <option value="cantidad_desc">Cantidad (Descendente)</option>
                    </select>
                    <input type="submit" value="Ordenar" class="btn btn-secondary">
                  </div>  
                </form>

                <div id="" class="table-responsive order-2">
                  <?php
                         
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $orden = $_POST["orden"];
  
                        $columna = "";
                        $tipo_orden = "";
  
                        switch ($orden) {
                          case "sinorden":
                            $columna = "codigo_fruta";
                            $tipo_orden = "ASC";
                            break;
                          case"fruta_asc":
                            $columna = "codigo_fruta";
                            $tipo_orden = "ASC";
                            break;
                          case "fruta_desc":
                            $columna = "codigo_fruta";
                            $tipo_orden = "DESC";
                            break;
                          case "nombre_asc":
                            $columna = "nombre";
                            $tipo_orden = "ASC";
                            break;
                          case "nombre_desc":
                            $columna = "nombre";
                            $tipo_orden = "DESC";
                            break;
                          case "cantidad_asc":
                            $columna = "stock";
                            $tipo_orden = "ASC";
                            break;
                          case "cantidad_desc":
                            $columna = "stock";
                            $tipo_orden = "DESC";
                            break;
                        }
  
                        //consulta con filtrado
                        $consulta = "SELECT * FROM fruta WHERE estado = 'ALTA' ORDER BY $columna $tipo_orden";
                        $stmt = $connect->query($consulta);

                      }
                    ?>
                  <table class="table table-striped table-secondary table-responsive table-hover">
                    <thead class="text-muted">
                        <th class="text-center">Código</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Kilos</th>
                        <th class="text-center">Más información</th>
                    </thead>
                    <tbody class="text-center">
                        <?php
                            if(!isset($_POST['orden'])){
                                //bucle que sacará todas las frutas cuando cargue la página web
                                while($row = $stmt1->fetch_array()){    
                                  echo "<tr>";
                                  echo     "<td>" . $row['codigo_fruta'] . "</td>"; 
                                  echo     "<td>" . $row['nombre'] . "</td>";
                                  echo     "<td>" . $row['stock'] . " kg</td>";
                                  echo     "<td><a id='' href='./includes/verstock.php?fruta=" . $row['codigo_fruta'] . "' role='button' class='btn btn-outline-secondary' data-toggle='modal'><i class='fas fa-eye'></i></a></td>";
                                  echo "</tr>";
                                }
                              }elseif(isset($_POST['orden'])){
                                //bucle que sacará todas las frutas con el filtro ya aplicado
                                while($row = $stmt->fetch_array()){    
                                  echo "<tr>";
                                  echo     "<td>" . $row['codigo_fruta'] . "</td>"; 
                                  echo     "<td>" . $row['nombre'] . "</td>";
                                  echo     "<td>" . $row['stock'] . " kg</td>";
                                  echo     "<td><a id='' href='./includes/verstock.php?fruta=" . $row['codigo_fruta'] . "' role='button' class='btn btn-outline-secondary' data-toggle='modal'><i class='fas fa-eye'></i></a></td>";
                                  echo "</tr>";
                                } 
                              }else{
                                echo "No se encontraron frutas";
                              }
                            ?>
                    </tbody>
                  </table>
                  
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
  <script>
  document.getElementById("enlaceModal").addEventListener("click", function(event) {
    event.preventDefault(); // Evita el comportamiento predeterminado del enlace

    var modal = new bootstrap.Modal(document.getElementById("miModal")); // Crea una instancia del modal
    modal.show(); // Muestra el modal
  });
</script>
</body>
<?php 
  $connect->close();
?>
</html>