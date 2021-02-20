<!--Configuración general del archivo a descargar y consulta a la base de datos para especificación de la tabla a incluir en el archivo-->
<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=Descarga_StockClientes_UnoA.xls');
	require_once('conexion.php');
	$conn=new Conexion();
	$link = $conn->conectarse();

    $query="SELECT sc.id_stock_clientes, sc.nombre, sc.descripcion, cat.nombre as categoria_id_categoria, 
    sc.cantidad, sc.fecha_registro, empl.nombre as empleado_id_empleado, sc.producto_dados_baja, 
    sc.fecha_vencimiento, empr.nombre as empresa_id_empresa, sed.nombre_sede as sede_id_sede, sc.plu, sc.ean, 
    sc.precio, cse.nombre as categoria_dias_especiales_id, sed2.nombre_sede as sede_id_sede_cliente, 
    ec.nombre as empresa_categoria_id
    FROM stock_clientes as sc, categoria as cat, empleado as empl, empresa as empr, 
    sede as sed, categoria_stock_especiales as cse, sede as sed2, empresa_categoria as ec 
    WHERE sc.sede_id_sede=sed.id_sede AND sc.empleado_id_empleado=empl.id_empleado AND sc.categoria_dias_especiales_id=cse.id_categoriaStock 
    AND sc.empresa_id_empresa=empr.id_empresa AND sc.categoria_id_categoria=cat.id_categoria AND sc.sede_id_sede_cliente=sed2.id_sede 
    AND sc.empresa_categoria_id=ec.id_empresa_categoria";
    
	$result=mysqli_query($link, $query);

    /*if($fecha!="0000-00-00"){

        if(date("y",$b)==date("y")){
            if(date("m",$b)==date("m")){
                if(date("d",$b)==date("d")){
                    $stock->producto_dados_baja=0;
                }
                if(date("d",$b)<date("d")){
                    $stock->producto_dados_baja=1;
                }
                if(date("d",$b)>date("d")){
                    $stock->producto_dados_baja=0;
                }	
            }
            if(date("m",$b)<date("m")){
                $stock->producto_dados_baja=1;
            }
            if(date("m",$b)>date("m")){
                $stock->producto_dados_baja=0;
            }	
        }
        if(date("y",$b)<date("y")){
            $stock->producto_dados_baja=1;
        }
        if(date("y",$b)>date("y")){
            $stock->producto_dados_baja=0;
        }
    }*/
    
?>
<!--Definir los campos de la tabla proveedor a mostrar en el archivo excel-->
<table border="1">
	<tr style="background-color:LIGHTSTEELBLUE; height:100px">
		<thead>
			<th>ID</th>
            <th>PLU</th>
            <th>EAN</th>
			<th>NOMBRE</th>
			<th>DESCRIPCION</th>
			<th>CATEGORIA</th>
            <th>EMPRESA</th>
            <th>SUBEMPRESA</th>
            <th>DIA ESPECIAL</th>
            <th>SEDE CLIENTE</th>
            <th>BAJA</th>
            <th colspan="3">FECHA_VENCIMIENTO</th>
            <th>CANTIDAD</th>
            <th>PRECIO</th>
		</thead>
	</tr>
	<?php
		while ($row=mysqli_fetch_assoc($result)){
			?>
			<tr>
				<td><?php echo $row['id_stock_clientes']; ?></td>
                <td><?php echo $row['plu']; ?></td>
                <td><?php echo $row['ean']; ?></td>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['descripcion']; ?></td>
                <td><?php echo $row['categoria_id_categoria']; ?></td>		
                <td><?php echo $row['empresa_id_empresa']; ?></td>
                <td><?php echo $row['empresa_categoria_id']; ?></td>
                <td><?php echo $row['categoria_dias_especiales_id']; ?></td>
                <td><?php echo $row['sede_id_sede_cliente']; ?></td>
                <td><?php echo $row['producto_dados_baja']; ?></td>
                <td><?php 
                    $b=strtotime($row['fecha_vencimiento']); 
                    //dd($año);
                    $año=date("Y",$b); 
                    echo $año;
                ?></td>
                    <td><?php 
                    $b=strtotime($row['fecha_vencimiento']); 
                    //dd($año);
                    $mes=date("m",$b); 
                    echo $mes;
                ?></td>
                     <td><?php 
                    $b=strtotime($row['fecha_vencimiento']); 
                    //dd($año);
                    $dia=date("d",$b); 
                    echo $dia;
                ?></td>
                <td><?php echo $row['cantidad']; ?></td>
                <td><?php echo $row['precio']; ?></td>

			</tr>	
			<?php
		}
	?>
</table>