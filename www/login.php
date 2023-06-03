<?php
session_start();
//incluir el archivo de conexión
$mensaje=" ";
$userok=" ";
$passok=" "; 
  include './includes/conn.php';

  //comprobar los datos cuando se utilice el botón entrar
if(isset($_POST['bentrar'])){
  //añadir el valor recogido por los campos del form
  $ruser = $connect->real_escape_string($_POST['usuario']);
  $rpass = $connect->real_escape_string(md5($_POST['password']));
  //realizar consulta de prueba para mostrar el usuario que coincida con los datos recogidos
  $consulta = "SELECT * FROM empleado WHERE Usuario = '$ruser' AND Password = '$rpass';";
  //validar los datos recogidos
  if($resultado = $connect->query($consulta)){
    //recorrer el array conseguido con la consulta y verificar cada línea mientras sigan habiendo en el array
    while($row = $resultado->fetch_array()){
      //Almacenar los datos en variables
      $userok = $row['Usuario'];
      $passok = $row['Password'];
    }
    $resultado->close();
  } 
  $connect->close();
  //validar que se han introducido datos en los campos de formulario
  if(isset($ruser) && isset($rpass)){
    //verificar que esos valores coinciden con los datos de la base de datos
    if($ruser == $userok && $rpass == $passok){
      //Si los campos coinciden se redirige a la página principal index.php
      $_SESSION['login'] = TRUE;
      $_SESSION['Usuario'] = $ruser;
      header("location:index.php");
    }else{
      //si los campos no coinciden se envía datos de error
      $mensaje.='<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Usuario o contraseña inválidos</strong> prueba a introducir las credenciales de nuevo.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
      ';
 //     header("location:login.php");
    }
  }
}

?>
<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width">
      <title>Stockage-TPV</title>
      <link href="./css/style.css" rel="stylesheet" type="text/css" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-fkJS/Z+1bIP/hMBCkM78P4p4Px4o4Hn8aW9Aop1tS/ydLQrlS3oWw3qg3EdiV86C0QepLGyV7SXuq3IFpVzrHw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-Hz/eZ0eVQ3/r8ZGg3LQ0p/NG75vGMnTyULmBqDy40OTsZUDBhUz5J/LIgXOiF9M0fM88EYIBk+nOCCmiWs7tCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dancing+Script">
      <link rel="icon" type="image/png" href="/img/Logo.ico"/>
    </head>
    <body class="vh-100">
      <main id="bg-image-main" class="content">
        <article id="artlog" class="container-fluid justify-content-center h-100">
         <section class="row justify-content-center align-items-center h-100">

          <div id="divwelcome" class="text-light col-lg-6 col-md-5 col-xs-12 my-auto d-flex align-items-center"><h1 id="hcaligr" class="fw-bold text-center text-shadow">Bienvenido a <br>Stockage - TPV</h1></div>
           
          <div id="divlogin" class="col-lg-3 col-md-6 col-sm-6 col-xs-8 rounded shadow-lg">
            <h1 class="text-center mt-3 mb-3"><i class="fas fa-user-lock fa-lg" style="color: #FFFFFF"></i></h1>
            
            <!--    Formulario de inicio de sesión   $_SERVER['PHP_SELF'] refresca la web y recupera el valor de las variables-->
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="mt-3">
              <hr class="bg-light col-10 mx-auto shadow border border-light">
              <div class="mb-3 col-8 mx-auto">
                <label for="exampleFormControlInput1" class="form-label text-light fw-semibold">Usuario</label>
                <input type="text" name="usuario" class="form-control bg-transparent border border-light rounded-3 text-light" id="exampleFormControlInput1">
              </div>
              <div class="mb-3 col-8 mx-auto">
                <label for="exampleFormControlInput2" class="form-label text-light fw-semibold">Contraseña</label>
                <input type="password" name="password" class="form-control bg-transparent border border-light rounded-3 text-light" id="exampleFormControlInput1" placeholder="">
              </div>
              <div>
                <?php 
                  echo $mensaje; 
                ?>
              </div>
              <div class="my-3 col-10 mx-auto text-center">
                <input type="submit" name="bentrar" value="Entrar" class="mt-3 btn btn-outline-light fw-semibold rounded-3">
              </div>  
            </div>
            </form> 
          </div>       
         </section>
      </article>
       </main>
     </body>
    <script src="https://kit.fontawesome.com/d38f67bab1.js" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/d38f67bab1.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
    integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
    integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
    crossorigin="anonymous"></script>
  </html>
