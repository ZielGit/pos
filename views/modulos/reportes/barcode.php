<?php
    require_once "../../../controllers/ProductController.php";
    require_once "../../../models/Product.php";

    class Imprimir{
        public $codigo;

        public function impresionBarcode(){
            $itemProducto = "codigo";
            $codigoProducto = $this->codigo;
        }
    }
    
    $factura = new imprimir();
    $factura->codigo = $_GET["codigo"];
    $factura->impresionBarcode();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode</title>

    <!-- Theme style -->
    <link rel="stylesheet" href="../../../public/dist/css/adminlte.css">

    <!-- Plugins -->
    <!-- jQuery -->
    <script src="../../../public/plugins/jquery/jquery.min.js"></script>
    <!-- JsBarcode 3.11.5 -->
    <script src="../../../public/plugins/JsBarcode/JsBarcode.all.min.js"></script>
    <!-- jquery print -->
    <script src="../../../public/plugins/jquery-print/JQuery.print.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-2">
                <h2 class="mx-auto" style="width: 300px;">Codigo de Barras</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
            <div class="col-3">
                <svg id="barcode"></svg>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <button id="btnImprimir" type="button" class="btn btn-success mx-auto">Imprimir</button>
    </div>
    <script>
        JsBarcode("#barcode", "<?php print_r($factura->codigo); ?>", {
                
            displayValue: true,
            lineColor: "#24292e",
            width:2,
            height:40,
            fontSize: 20					
        });

        $("#btnImprimir").on("click", function () {
            $.print(".container");
        })
    </script>
</body>
</html>