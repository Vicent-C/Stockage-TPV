<?php
session_start();
include 'conn.php';
//verificar que se ha creado la variable de sesión.
if(!isset($_SESSION['login']) || $_SESSION['login'] !== TRUE){
    header('location:./../login.php');
    exit;

}

$username = $_SESSION['Usuario'];
//Recoger el número de la factura.
$id = $_GET['factura'];
//Consultar la factura
$consulta = "SELECT * FROM factura JOIN lineas_factura JOIN fruta WHERE factura.num_factura=lineas_factura.factura AND lineas_factura.fruta=fruta.codigo_fruta AND lineas_factura.kilos >0 AND factura.num_factura = $id";
$resultado = $connect->query($consulta);


$fecha_query = "SELECT fecha_salida FROM factura WHERE num_factura = $id";
$fecha_resultado = $connect->query($consulta);
$fecha = $fecha_resultado->fetch_assoc();
$fecha_final = $fecha['fecha_salida'];
//importar el módulo que genera tickets
require_once('./../TCPDF-main/tcpdf.php');

//Aplicar una configuración a la página
$pdf = new TCPDF('P', 'mm', 'LETTER', true, 'UTF-8');
//Configurar la información que aparece en el ticket
$pdf->SetCreator('Stockage-TPV');
$pdf->SetAuthor($username);
$pdf->SetTitle('Ticket de Compra');

//Definir los márgenes y el salto de página automático.
$pdf->SetMargins(10, 10, 10);


$pdf->SetAutoPageBreak(true, 10);

//Agregar una nueva página al documento PDF

$pdf->AddPage();
$content = " ";

$content = '
<table>
    <tr>
        <td colspan="4" style="text-align:center"><h2>Stockage-TPV</h2></td>
    </tr>
    <tr>
        <td style="text-align:center"><br></td>
        <td></td>
    </tr>
    <tr>
        <td style="text-align:center">Factura Simplificada Nº: ' . $id . ' <br></td>
        <td style="text-align:center">' . $fecha_final . '</td>
        <td style="text-align:center">Le atendió: ' . $username . '</td>
        <td style="text-align:center"></td>
    </tr>
    <tr>
        <td colspan="4" style="text-align:center">===============================================================================</td>
    </tr>
    <tr>
        <td style="text-align:center;"><i>Producto</i></td>
        <td style="text-align:center;"><i>Kilos</i></td>
        <td style="text-align:center;"><i>Precio/kg</i></td>
        <td style="text-align:center;"><i>Importe</i></td>
    </tr>
    <tr>
        <td colspan="4" style="text-align:center">===============================================================================</td>
    </tr>
';
//Declarar variables para evitar errores
$precioUnid = 0;
$cantidadUnid = 0;
$totalPrecio = 0;
while ($row = $resultado->fetch_array()) {
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

//declarar variables para mostrar en el ticket.
$kilos = $row['kilos'];
$nombre = $row['nombre'];
$precio = $row['precio_kilo'];
//Calcular precio final de cada fruta que se ha comprado
$total = round($precio*$kilos,2);
//Calcular el total final de euros
if ($rowSuma['total']) {
    $totalPrecio += $rowSuma['total'];
  }
    $content.= '    <tr>
    <td style="text-align:center;"><i>' . $nombre . '</i></td>
    <td style="text-align:center;"><i>' . $kilos . '</i></td>
    <td style="text-align:center;"><i>' . $precio . ' €</i></td>
    <td style="text-align:center;"><i>' . $total . ' €</i></td>
</tr>


    ';
}

$content.='
<tr>
        <td colspan="4" style="text-align:center">===============================================================================</td>
    </tr>
<tr>
    <td style="text-align:center;"><i>' . $totalCantidades . ' kg</i></td>
    <td style="text-align:center;"> </td>
    <td style="text-align:center;">TOTAL:</td>
    <td style="text-align:center;"> <i>' . round($rowSuma['total'],2) . ' €</i></td>
</tr>
<tr>
    <td colspan="4" style="text-align:center;"></td>    
</tr>
<tr>
    <td colspan="4" style="text-align:center;"><b>¡Gracias por su visita!</b></td>    
</tr>
<table>

';

//Añadir el contenido al PDF utilizando el método writeHTML()
$pdf->writeHTML($content, true, false, true, false, '');

//Generar archivo con el método Output(), y especificarle el nombre del archivo.
$pdf->Output('ticket_" . $id . ".pdf', 'I');

?>