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
                $x_empresa_id_empresa = $sheet->getCell("G".$row)->getValue();
                $x_empresa_categoria_id= $sheet->getCell("H".$row)->getValue();
                $x_categoria_dias_especiales_id = $sheet->getCell("I".$row)->getValue();
                $x_sede_id_sede_cliente = $sheet->getCell("J".$row)->getValue();
                $x_producto_dados_baja = $sheet->getCell("K".$row)->getValue(); 
                $x_fecha_vencimiento = $sheet->getCell("L".$row)->getValue()."-".$sheet->getCell("M".$row)->getValue()."-".$sheet->getCell("N".$row)->getValue();
                $x_cantidad = $sheet->getCell("O".$row)->getValue();
                $x_precio = $sheet->getCell("P".$row)->getValue();
                $x_imagen = "";

                $empleado = "SELECT * FROM empleado WHERE user_id_user=\"$empleado\"";
                $result_empleado=mysqli_query($link, $empleado);
                if($result_empleado){
                    while($rows=mysqli_fetch_assoc($result_empleado)){
                        $id_empleado=$rows['id_empleado'];
                        $id_sede=$rows['sede_id_sede'];
                    }
                }

                $consulta_cat = "SELECT id_categoria FROM categoria WHERE nombre=\"$x_categoria_id_categoria\"";
                $result_cat=mysqli_query($link, $consulta_cat);
                $count_cat=0; 
                while($rows=mysqli_fetch_assoc($result_cat)){
                    $count_cat++;  
                    $categoria_i=$rows['id_categoria'];
                }

                $consulta_empresa = "SELECT id_empresa FROM empresa WHERE nombre=\"$x_empresa_id_empresa\"";
                $result_empresa=mysqli_query($link, $consulta_empresa);
                $count_empresa=0; 
                while($rows=mysqli_fetch_assoc($result_empresa)){
                    $count_empresa++;  
                    $empresa_i=$rows['id_empresa'];
                }

                $consulta_subempresa = "SELECT id_empresa_categoria FROM empresa_categoria WHERE nombre=\"$x_empresa_categoria_id\"";
                $result_subempresa=mysqli_query($link, $consulta_subempresa);
                $count_subempresa=0; 
                while($rows=mysqli_fetch_assoc($result_subempresa)){
                    $count_subempresa++;  
                    $subempresa_i=$rows['id_empresa_categoria'];
                }

                $consulta_dia = "SELECT id_categoriaStock FROM categoria_stock_especiales WHERE nombre=\"$x_categoria_dias_especiales_id\"";
                $result_dia=mysqli_query($link, $consulta_dia);
                $count_dia=0; 
                while($rows=mysqli_fetch_assoc($result_dia)){
                    $count_dia++;  
                    $diaEspecial_i=$rows['id_categoriaStock'];
                }

                $consulta_ean = "SELECT * FROM stock_clientes WHERE ean = \"$x_ean\"";
                $result_ean=mysqli_query($link, $consulta_ean);
                $count_ean=0; 
                while($rows=mysqli_fetch_assoc($result_ean)){
                    $count_ean++;
                    $ean=$rows['ean'];
                }

                $consulta_plu = "SELECT * FROM stock_clientes WHERE plu = \"$x_plu\"";
                $result_plu=mysqli_query($link, $consulta_plu);
                $count_plu=0; 
                while($rows=mysqli_fetch_assoc($result_plu)){
                    $count_plu++;
                    $plu=$rows['ean'];
                }

                $sql = "insert into stock_clientes (id_stock_clientes, nombre, descripcion, categoria_id_categoria, cantidad, fecha_registro, fecha_vencimiento, empleado_id_empleado,  producto_dados_baja, empresa_id_empresa, empresa_categoria_id, sede_id_sede, plu, ean, precio, imagen, categoria_dias_especiales_id, sede_id_sede_cliente) value";
                $sql .= "(\"$x_id_stock_clientes\",  \"$x_nombre\", \"$x_descripcion\", \"$categoria_i\", \"$x_cantidad\", \"$fecha_actual\", \"$x_fecha_vencimiento\", \"$id_empleado\", \"$x_producto_dados_baja\", \"$empresa_i\", \"$subempresa_i\", \"$id_sede\", \"$x_plu\", \"$x_ean\", \"$x_precio\", \"$x_imagen\", \"$diaEspecial_i\", \"$x_sede_id_sede_cliente\")";    

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