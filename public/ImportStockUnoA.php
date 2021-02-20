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
                $x_tipo_stock_id = $sheet->getCell("F".$row)->getValue();
                $x_producto_dados_baja = $sheet->getCell("G".$row)->getValue();
                $x_fecha_vencimiento = $sheet->getCell("H".$row)->getValue()."-".$sheet->getCell("I".$row)->getValue()."-".$sheet->getCell("J".$row)->getValue();
                $x_cantidad = $sheet->getCell("K".$row)->getValue();
                //$x_fecha_vencimiento = $sheet->getCell("H".$row)->getValue();
                //$x_fecha_vencimiento = "0000-00-00";
                //$x_fecha_vencimiento = "2020-12-01";

                //$x_fecha_registro = $fecha_actual;
                //$x_empleado_id_empleado = 31;


                $empleado = "SELECT * FROM empleado WHERE user_id_user=\"$empleado\"";
                $result_empleado=mysqli_query($link, $empleado);
                if($result_empleado){
                    while($rows=mysqli_fetch_assoc($result_empleado)){
                        $id_empleado=$rows['id_empleado'];
                        $id_sede=$rows['sede_id_sede'];
                    }
                }

                $producto = "SELECT * FROM producto WHERE nombre=\"$x_producto_id_producto\"";
                $result_producto=mysqli_query($link, $producto);
                if($result_producto){
                    while($rows=mysqli_fetch_assoc($result_producto)){
                        $id_producto=$rows['id_producto']; 
                    }
                }

                $sede = "SELECT * FROM sede WHERE nombre_sede=\"$x_sede_id_sede\"";
                $result_sede=mysqli_query($link, $sede);
                if($result_sede){
                    while($rows=mysqli_fetch_assoc($result_sede)){
                        $id_sede=$rows['id_sede'];  
                    }
                }

                $proveedor = "SELECT * FROM proveedor WHERE nombre_proveedor=\"$x_proveedor_id_proveedor\"";
                $result_proveedor=mysqli_query($link, $proveedor);
                if($result_proveedor){
                    while($rows=mysqli_fetch_assoc($result_proveedor)){
                        $id_proveedor=$rows['id_proveedor'];  
                    }
                }

                $proveedor = "SELECT * FROM proveedor WHERE nombre_proveedor=\"$x_proveedor_id_proveedor\"";
                $result_proveedor=mysqli_query($link, $proveedor);
                if($result_proveedor){
                    while($rows=mysqli_fetch_assoc($result_proveedor)){
                        $id_proveedor=$rows['id_proveedor'];  
                    }
                }

                $consulta_dia = "SELECT id_categoriaStock FROM categoria_stock_especiales WHERE nombre=\"$x_categoria_id_categoria\"";
                $result_dia=mysqli_query($link, $consulta_dia);
                $count_dia=0; 
                while($rows=mysqli_fetch_assoc($result_dia)){
                    $count_dia++;  
                    $diaEspecial_i=$rows['id_categoriaStock'];
                }

                $tpstock = "SELECT * FROM tipo_stock_unoa WHERE nombre=\"$x_tipo_stock_id\"";
                $result_tpstock=mysqli_query($link, $tpstock);
                if($result_tpstock){
                    while($rows=mysqli_fetch_assoc($result_tpstock)){
                        $id_tpstock=$rows['id_stock_unoa'];  
                    }
                }

                 
                $sql = "insert into stock (id_stock, producto_id_producto, sede_id_sede, proveedor_id_proveedor, categoria_id_categoria, cantidad, fecha_registro, empleado_id_empleado,  producto_dados_baja, fecha_vencimiento, tipo_stock_id) value";
                $sql .= "(\"$x_id_stock\", \"$id_producto\", \"$id_sede\", \"$id_proveedor\", \"$diaEspecial_i\", \"$x_cantidad\", \"$fecha_actual\", \"$id_empleado\", \"$x_producto_dados_baja\", \"$x_fecha_vencimiento\", \"$id_tpstock\")";
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