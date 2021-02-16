<?php
include "database.php";
include "class.upload.php";

require_once('conexion.php');
$conn=new Conexion();
$link = $conn->conectarse();

$empleado= $_POST['empleado'];
$fecha_actual= $_POST['fecha_actual'];

$sql = "SELECT * FROM stock";

if(isset($_FILES["name"])){
    $up = new Upload($_FILES["name"]);
    if($up->uploaded){
        $up->Process("./uploads/");
        if($up->processed){
            /// leer el archivo excel
            require_once 'PHPExcel/Classes/PHPExcel.php';
            $archivo = "uploads/".$up->file_dst_name;
            $inputFileType = PHPExcel_IOFactory::identify($archivo);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($archivo);
            $sheet = $objPHPExcel->getSheet(0); 
            $highestRow = $sheet->getHighestRow(); 
            $highestColumn = $sheet->getHighestColumn();

            for ($row = 2; $row <= $highestRow; $row++){

                $x_id_stock = $sheet->getCell("A".$row)->getValue();
                $x_producto_id_producto = $sheet->getCell("B".$row)->getValue();
                $x_sede_id_sede = $sheet->getCell("C".$row)->getValue();
                $x_proveedor_id_proveedor = $sheet->getCell("D".$row)->getValue();
                $x_categoria_id_categoria = $sheet->getCell("E".$row)->getValue();
                $x_cantidad = $sheet->getCell("F".$row)->getValue();
                $x_producto_dados_baja = $sheet->getCell("I".$row)->getValue();
                //$x_fecha_vencimiento = $sheet->getCell("H".$row)->getValue();
                //$x_fecha_vencimiento = "0000-00-00";
                $x_fecha_vencimiento = "2020-12-01";
                $x_tipo_stock_id = $sheet->getCell("K".$row)->getValue();    
                $x_fecha_registro = $fecha_actual;
                $x_empleado_id_empleado = 31;
                 
                $sql = "insert into stock (id_stock, producto_id_producto, sede_id_sede, proveedor_id_proveedor, categoria_id_categoria, cantidad, fecha_registro, empleado_id_empleado,  producto_dados_baja, fecha_vencimiento, tipo_stock_id) value";
                $sql .= "(\"$x_id_stock\", \"$x_producto_id_producto\", \"$x_sede_id_sede\", \"$x_proveedor_id_proveedor\", \"$x_categoria_id_categoria\", \"$x_cantidad\", \"$x_fecha_registro\", \"$x_empleado_id_empleado\", \"$x_producto_dados_baja\", \"$x_fecha_vencimiento\", \"$x_tipo_stock_id\")";
                $con->query($sql);
            }
        unlink($archivo);
        }   
    }
}
echo "<script>
window.location = './index.php';
</script>
";
?>