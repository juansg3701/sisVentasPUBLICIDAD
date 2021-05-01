<?php
include "database.php";
include "class.upload.php";

require_once('conexion.php');
$conn=new Conexion();
$link = $conn->conectarse();

$empleado= $_POST['empleado'];
$fecha_actual= $_POST['fecha_actual'];

$sql = "SELECT * FROM producto";

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

                $query="SELECT * FROM producto WHERE id_producto = \"$x_id_producto\"";
                $result=mysqli_query($link, $query);
                    
                $count_producto=0; 
                while($rows=mysqli_fetch_assoc($result)){
                    $count_producto++;
                    echo "nombre: ".$rows['nombre'];
                }

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

                $consulta_ean = "SELECT * FROM producto WHERE ean = \"$x_ean\"";
                $result_ean=mysqli_query($link, $consulta_ean);
                $count_ean=0; 
                while($rows=mysqli_fetch_assoc($result_ean)){
                    $count_ean++;
                    $ean=$rows['ean'];
                }

                $consulta_plu = "SELECT * FROM producto WHERE plu = \"$x_plu\"";
                $result_plu=mysqli_query($link, $consulta_plu);
                $count_plu=0; 
                while($rows=mysqli_fetch_assoc($result_plu)){
                    $count_plu++;
                    $plu=$rows['ean'];
                }


                $x_id_producto = $sheet->getCell("A".$row)->getValue();
                $x_plu = $sheet->getCell("B".$row)->getValue();
                $x_ean = $sheet->getCell("C".$row)->getValue();
                $x_nombre = $sheet->getCell("D".$row)->getValue();
                $x_categoria_id_categoria = $sheet->getCell("E".$row)->getValue();
                $x_precio = $sheet->getCell("F".$row)->getValue();
                $x_stock_minimo = $sheet->getCell("G".$row)->getValue();   
                $x_imagen = "";

                if(($x_id_producto!="" || $x_plu!="" || $x_ean!="" || $x_nombre!="" || $x_categoria_id_categoria!="" || $x_precio!="" || $x_stock_minimo!="") && ($x_id_producto==0 || $x_plu==0 || $x_ean==0 || $x_nombre==0 || $x_categoria_id_categoria==0 || $x_precio==0 || $x_stock_minimo==0)){
                
                    if ($count_producto==0) {

                        if($count_cat!=0){

                            if ($count_ean==0 && $count_plu==0){
                                $sql = "insert into producto (id_producto, plu, ean, nombre, precio, stock_minimo, fecha_registro, imagen, categoria_id_categoria, empleado_id_empleado, sede_id_sede) value";
                                $sql .= "(\"$x_id_producto\", \"$x_plu\", \"$x_ean\", \"$x_nombre\", \"$x_precio\", \"$x_stock_minimo\", \"$fecha_actual\", \"$x_imagen\", \"$categoria_i\", \"$id_empleado\", \"$id_sede\")";
                            }else{
                                echo '<script language="javascript">alert("EAN y PLU deben ser valores únicos, no se guardará el registro con el ID: '.$x_id_producto.' y nombre: '.$x_nombre.'");</script>';
                            }
        
                        }else{
                            echo '<script language="javascript">alert("Los datos ingresados en categoría son incorrectos. Error en el registro con el id: '.$x_id_producto.' y nombre: '.$x_nombre.'");</script>';
                        }

                    }else{

                        if($count_cat!=0){

                            if ($count_ean!=0 && $count_plu!=0){
                                $sql = "UPDATE producto SET nombre=\"$x_nombre\", precio=\"$x_precio\", stock_minimo=\"$x_stock_minimo\", fecha_registro=\"$fecha_actual\", categoria_id_categoria=\"$categoria_i\", empleado_id_empleado=\"$id_empleado\", sede_id_sede=\"$id_sede\" WHERE id_producto = \"$x_id_producto\"";    
                            }else{
                                echo '<script language="javascript">alert("Hay registros con el ID repetido, no se guardarán cambios en el registro con el ID: '.$x_id_producto.' y nombre: '.$x_nombre.'");</script>';
                            }

                        }else{
                            echo '<script language="javascript">alert("Los datos ingresados en categoría son incorrectos.  Error en el registro con el ID: '.$x_id_producto.' y nombre: '.$x_nombre.'");</script>';
                        }

                    }

                }else{}
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