<!--Configuración general del archivo a descargar y consulta a la base de datos para especificación de la tabla a incluir en el archivo-->
<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=Descarga_Stock_UnoA.xls');
	require_once('conexion.php');
	$conn=new Conexion();
	$link = $conn->conectarse();


    $query="SELECT s.id_stock, p.nombre, sed.nombre_sede as sede_id_sede, 
    pd.nombre_proveedor as proveedor_id_proveedor, c.nombre as categoria_id_categoria, s.cantidad, 
    s.fecha_registro, e.nombre as empleado_id_empleado, s.producto_dados_baja, s.fecha_vencimiento,  
    tp.nombre as tipo_stock_id FROM stock as s, producto as p, sede as sed, empleado as e,  
    categoria_stock_especiales as c, tipo_stock_unoa as tp, proveedor as pd 
    WHERE s.producto_id_producto=p.id_producto AND s.sede_id_sede=sed.id_sede AND s.empleado_id_empleado=e.id_empleado 
    AND s.categoria_id_categoria=c.id_categoriaStock AND s.tipo_stock_id=tp.id_stock_unoa
    AND s.proveedor_id_proveedor=pd.id_proveedor";

	$result=mysqli_query($link, $query);
?>
<!--Definir los campos de la tabla proveedor a mostrar en el archivo excel-->
<table border="1">
	<tr style="background-color:LIGHTSTEELBLUE; height:100px">
		<thead>
			<th>ID</th>
			<th>NOMBRE</th>
			<th>SEDE_INGRESO</th>
			<th>PROVEEDOR</th>
            <th>CATEGORIA</th>
            <th>TIPO STOCK</th>
			<th>BAJA</th>
            <th colspan="3">FECHA_VENCIMIENTO</th>
			<th>CANTIDAD</th>
		</thead>
	</tr>
	<?php
		while ($row=mysqli_fetch_assoc($result)) {
			?>
			<tr>
                <td><?php echo $row['id_stock']; ?></td>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['sede_id_sede']; ?></td>
                <td><?php echo $row['proveedor_id_proveedor']; ?></td>
                <td><?php echo $row['categoria_id_categoria']; ?></td>   
                <td><?php echo $row['tipo_stock_id']; ?></td>
				<td><?php echo $row['producto_dados_baja']; ?></td>
                <td><?php 
                    $b=strtotime($row['fecha_vencimiento']); 
                    $año=date("Y",$b); 
                    echo $año;
                ?></td>
                    <td><?php 
                    $b=strtotime($row['fecha_vencimiento']); 
                    $mes=date("m",$b); 
                    echo $mes;
                ?></td>
                    <td><?php 
                    $b=strtotime($row['fecha_vencimiento']); 
                    $dia=date("d",$b); 
                    echo $dia;
                ?></td>
				<td><?php echo $row['cantidad']; ?></td>
			</tr>	
			<?php
		}
	?>
</table>