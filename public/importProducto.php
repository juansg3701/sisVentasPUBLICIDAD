<?php
include "database.php";
include "class.upload.php";


require_once('conexion.php');
$conn=new Conexion();
$link = $conn->conectarse();


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

                $x_id_producto = $sheet->getCell("A".$row)->getValue();
                $x_plu = $sheet->getCell("B".$row)->getValue();
                $x_ean = $sheet->getCell("C".$row)->getValue();
                $x_nombre = $sheet->getCell("D".$row)->getValue();
                $x_categoria_id_categoria = $sheet->getCell("E".$row)->getValue();
                $x_precio = $sheet->getCell("F".$row)->getValue();
                $x_stock_minimo = $sheet->getCell("G".$row)->getValue();   
                $x_imagen = "";
                $x_fecha_registro = "2020-12-05";
                $x_empleado_id_empleado = "31";
                $x_sede_id_sede = "1";

                $sql = "insert into producto (id_producto, plu, ean, nombre, precio, stock_minimo, fecha_registro, imagen, categoria_id_categoria, empleado_id_empleado, sede_id_sede) value";
                $sql .= "(\"$x_id_producto\", \"$x_plu\", \"$x_ean\", \"$x_nombre\", \"$x_precio\", \"$x_stock_minimo\", \"$x_fecha_registro\", \"$x_imagen\", \"$x_categoria_id_categoria\", \"$x_empleado_id_empleado\", \"$x_sede_id_sede\")";
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