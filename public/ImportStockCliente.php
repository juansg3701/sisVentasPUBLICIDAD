<?php
include "database.php";
include "class.upload.php";

require_once('conexion.php');
$conn=new Conexion();
$link = $conn->conectarse();

$empleado= $_POST['empleado'];
$fecha_actual= $_POST['fecha_actual'];

$sql = "SELECT * FROM stock_clientes";

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

                $x_id_stock_clientes = $sheet->getCell("A".$row)->getValue();
                $x_plu = $sheet->getCell("B".$row)->getValue();
                $x_ean = $sheet->getCell("C".$row)->getValue();
                $x_nombre = $sheet->getCell("D".$row)->getValue();
                $x_descripcion = $sheet->getCell("E".$row)->getValue();
                $x_categoria_id_categoria = $sheet->getCell("F".$row)->getValue();
                $x_cantidad = $sheet->getCell("G".$row)->getValue();

            
                $x_fecha_vencimiento = $sheet->getCell("O".$row)->getValue()."-".$sheet->getCell("P".$row)->getValue()."-".$sheet->getCell("Q".$row)->getValue();
                echo $x_fecha_vencimiento;
                //$x_fecha_vencimiento = "0000-00-00";
                //$x_fecha_vencimiento = "2020-12-01";
                $x_empresa_id_empresa = $sheet->getCell("I".$row)->getValue();
                $x_empresa_categoria_id= $sheet->getCell("J".$row)->getValue();
                $x_precio = $sheet->getCell("K".$row)->getValue();
                $x_categoria_dias_especiales_id = $sheet->getCell("L".$row)->getValue();
                $x_sede_id_sede_cliente = $sheet->getCell("M".$row)->getValue();
                $x_producto_dados_baja = $sheet->getCell("N".$row)->getValue();   
                $x_imagen = "";
                $x_fecha_registro = $fecha_actual;
                $x_empleado_id_empleado = 31;
                $x_sede_id_sede = 1;



                $sql = "insert into stock_clientes (id_stock_clientes, nombre, descripcion, categoria_id_categoria, cantidad, fecha_vencimiento, empleado_id_empleado,  producto_dados_baja, empresa_id_empresa, empresa_categoria_id, sede_id_sede, plu, ean, precio, imagen, categoria_dias_especiales_id, sede_id_sede_cliente) value";
                $sql .= "(\"$x_id_stock_clientes\",  \"$x_nombre\", \"$x_descripcion\", \"$x_categoria_id_categoria\", \"$x_cantidad\", \"$x_fecha_vencimiento\", \"$x_empleado_id_empleado\", \"$x_producto_dados_baja\", \"$x_empresa_id_empresa\", \"$x_empresa_categoria_id\", \"$x_sede_id_sede\", \"$x_plu\", \"$x_ean\", \"$x_precio\", \"$x_imagen\", \"$x_categoria_dias_especiales_id\", \"$x_sede_id_sede_cliente\")";    

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