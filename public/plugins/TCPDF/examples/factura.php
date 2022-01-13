<?php

require_once "../../../../controllers/SaleController.php";
require_once "../../../../models/Sale.php";

require_once "../../../../controllers/ClientController.php";
require_once "../../../../models/Client.php";

require_once "../../../../controllers/UserController.php";
require_once "../../../../models/User.php";

require_once "../../../../controllers/ProductController.php";
require_once "../../../../models/Product.php";

class imprimirFactura{

    public $codigo;

    public function traerImpresionFactura(){

        // Traemos la información de la venta
        $itemVenta = "codigo";
        $valorVenta = $this->codigo;
        $respuestaVenta = SaleController::MostrarVentas($itemVenta, $valorVenta);
        $fecha = substr($respuestaVenta["fecha"],0,-8);
        $productos = json_decode($respuestaVenta["productos"], true);
        $neto = number_format($respuestaVenta["neto"],2);
        $impuesto = number_format($respuestaVenta["impuesto"],2);
        $total = number_format($respuestaVenta["total"],2);

        // Traemos la información del cliente
        $itemCliente = "id";
		$valorCliente = $respuestaVenta["id_cliente"];
		$respuestaCliente = ClientController::MostrarClientes($itemCliente, $valorCliente);

        // Traemos la información del vendedor
        $itemVendedor = "id";
		$valorVendedor = $respuestaVenta["id_vendedor"];
		$respuestaVendedor = UserController::MostrarUsuario($itemVendedor, $valorVendedor);

        // Include the main TCPDF library (search for installation path).
        require_once('tcpdf_include.php');

        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->startPageGroup();
        $pdf->AddPage();

        // BLOQUE 1
        $bloque1 = <<<EOD
            <table>
                <tr>
                    <td style="width:150px"><img src="images/tcpdf_logo.jpg"></td>
                    <td style="background-color:white; width:140px">
                        <div style="font-size:8.5px; text-align:right; line-height:15px;">
                            <br>
                            NIT: 71.759.963-9
                            <br>
                            Dirección: Calle 448 92-11
                        </div>
                    </td>
                    <td style="background-color:white; width:140px">
                        <div style="font-size:8.5px; text-align:right; line-height:15px;">
                            <br>
                            Telefono: 300 786 52 49
                            <br>
                            ventas@gmail.com
                        </div>
                    </td>
                    <td style="background-color:white; width:110px; text-align:center; color:red">
                        <br><br>FACTURA N.<br>$valorVenta
                    </td>
                </tr>
            </table>
        EOD;

        $pdf->writeHTML($bloque1, false, false, false, false, '');

        // BLOQUE 2
        $bloque2 = <<<EOD
            <table>
                <tr>
                    <td style="width:540px"><img src="images/back.jpg"></td>
                </tr>
            </table>

            <table style="font-size:10px; padding:5px 10px;">
                <tr>
                    <td style="border: 1px solid #666; background-color:white; width:390px">
                        Cliente: $respuestaCliente[nombre]
                    </td>
                    <td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
                        Fecha: $fecha
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid #666; background-color:white; width:540px">Vendedor: $respuestaVendedor[nombre]</td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>
                </tr>
            </table>
        EOD;

        $pdf->writeHTML($bloque2, false, false, false, false, '');

        // BLOQUE 3
        $bloque3 = <<<EOD
			<table style="font-size:10px; padding:5px 10px;">
				<tr>
					<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Producto</td>
					<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Cantidad</td>
					<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Unit.</td>
					<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Total</td>
				</tr>
			</table>
		EOD;

		$pdf->writeHTML($bloque3, false, false, false, false, '');

        foreach ($productos as $key => $item) {
			$itemProducto = "descripcion";
			$valorProducto = $item["descripcion"];
			$orden = null;
			$respuestaProducto = ProductController::MostrarProductos($itemProducto, $valorProducto, $orden);
			$valorUnitario = number_format($respuestaProducto["precio_venta"], 2);
			$precioTotal = number_format($item["total"], 2);
            
            // BLOQUE 4
			$bloque4 = <<<EOD
				<table style="font-size:10px; padding:5px 10px;">
					<tr>
						<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
							$item[descripcion]
						</td>
						<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
							$item[cantidad]
						</td>
						<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
							$valorUnitario
						</td>
						<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
							$precioTotal
						</td>
					</tr>
				</table>
			EOD;
			$pdf->writeHTML($bloque4, false, false, false, false, '');
		}

        // BLOQUE 5
        $bloque5 = <<<EOD
			<table style="font-size:10px; padding:5px 10px;">
				<tr>
					<td style="color:#333; background-color:white; width:340px; text-align:center"></td>
					<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>
					<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>
				</tr>
				<tr>
					<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
					<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
						Neto:
					</td>
					<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
						$ $neto
					</td>
				</tr>
				<tr>
					<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
					<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
						Impuesto:
					</td>
					<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
						$ $impuesto
					</td>
				</tr>
				<tr>
					<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
					<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
						Total:
					</td>
					<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
						$ $total
					</td>
				</tr>
			</table>

		EOD;

		$pdf->writeHTML($bloque5, false, false, false, false, '');

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('factura.pdf');
    }
}

$factura = new imprimirFactura();
$factura->codigo = $_GET["codigo"];
$factura->traerImpresionFactura();

?>