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

// Consultar la fruta
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
        <td colspan="3" style="text-align:center"><h2>Stockage-TPV</h2></td>
    </tr>
    <tr>
        <td style="text-align:center"><br></td>
        <td></td>
    </tr>
    <tr>
        <td style="text-align:center">Factura Simplificada Nº: ' . $id . ' <br></td>
        <td style="text-align:center">' . $fecha_final . '</td>
        <td style="text-align:center">Le atendió: ' . $username . '</td>
    </tr>
    <tr>
        <td colspan="3" style="text-align:center">===============================================================================</td>
    </tr>
    <tr>
        <td style="text-align:center;"><i>Kg.</i></td>
        <td style="text-align:center;"><i>Producto</i></td>
        <td style="text-align:center;"><i>Importe</i></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align:center">===============================================================================</td>
    </tr>
';
$lineas=$resultado->num_rows;
$num_linea = 0;
$ivaPorcentaje= 0.21;
while ($row = $resultado->fetch_array()) {
    //Calcular el IVA de cada fruta
    $iva = round($row['precio_kilo'] * $ivaPorcentaje, 2);
    //Calcular el precio sin IVA
    $precio_sin_iva = $row['precio_kilo'] - $iva;
    $total = $row['kilos'] * $row['precio_kilo'];
    $totalPrecio = $total++;
    $num_linea = $num_linea + 1;

// Consulta para obtener la suma de las cantidades de unidades de las líneas con el mismo número de albarán
$consultaSumaCantidades = "SELECT SUM(lineas_factura.kilos) AS total_cantidades
FROM lineas_factura
WHERE lineas_factura.factura = " . $row['num_factura'];
$stmtSumaCantidades = $connect->query($consultaSumaCantidades);
$rowSumaCantidades = $stmtSumaCantidades->fetch_array();
$totalCantidades = $rowSumaCantidades['total_cantidades'];
$cantidadUnid = $totalCantidades;
    $nombre = $row['nombre'];
    $precio = $row['precio_kilo'];
    $kilos = $row['kilos'];
    $precioFinal=round($precio*$kilos,2);
    $content.= '    <tr>
    <td style="text-align:center;"><i>' . $kilos . '</i></td>
    <td style="text-align:center;"><i>' . $nombre . '</i></td>
    <td style="text-align:center;"><i>' . $precioFinal . '</i></td>
</tr>


    ';
}

$content.='
<tr>
        <td colspan="3" style="text-align:center">===============================================================================</td>
    </tr>
<tr>
    <td style="text-align:center;">Total:(<i>' . $cantidadUnid . '</i>)</td>
    <td style="text-align:center;"><i>' . $num_linea . '</i></td>
    <td style="text-align:center;"><i>' . $totalPrecio . '</i></td>
</tr>

<table>

Total: ($num_linea)
TOTAL/€: 

';

//Añadir el contenido al PDF utilizando el método writeHTML()
$pdf->writeHTML($content, true, false, true, false, '');

//Generar archivo con el método Output(), y especificarle el nombre del archivo.
$pdf->Output('ticket_" . $id . ".pdf', 'I');

?>