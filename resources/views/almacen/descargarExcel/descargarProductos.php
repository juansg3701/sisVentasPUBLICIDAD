<!--Configuración general del archivo a descargar y consulta a la base de datos para especificación de la tabla a incluir en el archivo-->
<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=Descarga_Productos_UnoA.xls');
	require_once('conexion.php');
	$conn=new Conexion();
	$link = $conn->conectarse();
	$query="SELECT p.id_producto, p.plu, p.ean, p.nombre, c.nombre as categoria_id_categoria, p.stock_minimo, p.precio FROM producto as p, categoria as c WHERE p.categoria_id_categoria=c.id_categoria ORDER BY id_producto ASC";
	$result=mysqli_query($link, $query);
?>
<!--Definir los campos de la tabla proveedor a mostrar en el archivo excel-->
<table border="1">
	<tr style="background-color:LIGHTSTEELBLUE; height:100px">
		<thead>
			<th>ID</th>
			<th>PLU</th>
			<th>EAN</th>
			<th>NOMBRE</th>
			<th>CATEGORIA</th>
			<th>PRECIO</th>
			<th>STOCK MINIMO</th>
		</thead>
	</tr>
	<?php
		while ($row=mysqli_fetch_assoc($result)) {
			?>
			<tr>
				<td><?php echo $row['id_producto']; ?></td>
				<td><?php echo $row['plu']; ?></td>
				<td><?php echo $row['ean']; ?></td>
				<td><?php echo $row['nombre']; ?></td>
				<td><?php echo $row['categoria_id_categoria']; ?></td>
				<td><?php echo $row['precio']; ?></td>
				<td><?php echo $row['stock_minimo']; ?></td>
			</tr>	
			<?php
		}
	?>
</table>