<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=RP_PEDIDOS_FILTRADOS.xls');

	require_once('conexion.php');
	$conn=new Conexion();
	$link = $conn->conectarse();

?>

<table border="1">

		<tr>
		   	<td colspan="3"><?php echo 'REPORTE DE PEDIDOS FILTRADOS'; ?></td>
	    </tr>
	    <tr>
	    	<td colspan="3"><?php echo 'Fecha de generacion: '.date('m-d-Y h:i:s a', time()); ?></td>
	    </tr>
	    <tr>
	    	<td><?php echo 'Inicio: '.$inicio; ?></td>
			<td><?php echo 'Fin: '.$fin; ?></td>
			<td><?php echo 'Total ventas: '.$nombre_tipo_reporte; ?></td>
	    </tr>

		<tr style="background-color:WHITE; height:100px">
			<thead>
				<th>EMPRESA</th>
				<th>NO. PEDIDOS</th>
				<th>NO. PRODUCTOS</th>
			</thead>
		</tr>		
		<?php
		foreach ($pedidos as $ps) {
	        ?>
			<tr>
				<td><?php echo $ps->empresa.' - '.$ps->subempresa; ?></td>
				<td><?php echo $ps->numero_pedidos; ?></td>
				<td><?php echo $ps->noproductos; ?></td>
			</tr>	
		<?php
	   	}
		?>



</table>
