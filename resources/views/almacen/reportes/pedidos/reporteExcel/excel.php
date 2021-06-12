<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=RP_PEDIDOS_MENSUALES.xls');

	require_once('conexion.php');
	$conn=new Conexion();
	$link = $conn->conectarse();

?>

<table border="1">





	<?php

		if ($valor==1) {
			?>

			<tr>
				<td colspan="2"><?php echo 'REPORTE DE PEDIDOS MENSUAL GENERAL'; ?></td>
			</tr>
			<tr>
				<td colspan="2"><?php echo 'Fecha de generacion: '.date('m-d-Y h:i:s a', time()); ?></td>
			</tr>
			<tr>
				<td><?php echo 'Empresa: '.$nombre_empresa; ?></td>
				<td><?php echo 'Aliado: '.$nombre_subempresa; ?></td>
			</tr>
			<tr>
				<td><?php echo 'Inicio: '.$mes_r; ?></td>
				<td><?php echo 'Fin: '.$mes_final; ?></td>
			</tr>

			<tr style="background-color:WHITE; height:100px">
				<thead>
					<th>FECHA</th>
					<th>NO. PRODUCTOS</th>
				</thead>
			</tr>
			<?php
			foreach ($pedidos_mensuales as $ps) {
				?>
				<tr>
						<td><?php echo $ps->fecha.' - '.$ps->fecha_year; ?></td>
						<td><?php echo $ps->noproductos; ?></td>
				</tr>	
				<?php

			}
		}
	?>


<?php

if ($valor=='m') {
	?>

	<tr>
		<td colspan="2"><?php echo 'REPORTE DE PEDIDOS MENSUAL DETALLADO'; ?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo 'Fecha de generacion: '.date('m-d-Y h:i:s a', time()); ?></td>
	</tr>
	<tr>
		<td><?php echo 'Empresa: '.$nombre_empresa; ?></td>
		<td><?php echo 'Aliado: '.$nombre_subempresa; ?></td>
	</tr>
	<tr>
		<td><?php echo 'Inicio: '.$mes_r; ?></td>
		<td><?php echo 'Fin: '.$mes_final; ?></td>
	</tr>

	<tr style="background-color:WHITE; height:100px">
		<thead>
			<th>PRODUCTO</th>
			<th>CANTIDAD</th>
		</thead>
	</tr>
	<?php
	foreach ($pedidos_mensuales as $ps) {
		?>
		<tr>
				<td><?php echo $ps->producto; ?></td>
				<td><?php echo $ps->noproductos; ?></td>
		</tr>	
		<?php

	}
}
?>



</table>
