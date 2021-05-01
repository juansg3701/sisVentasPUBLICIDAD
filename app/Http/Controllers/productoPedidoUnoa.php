<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\DetallePP;
use sisVentas\PedidoProveedor;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\DetallePPFormRequest;
use Mail;
use DB;
use FPDF;


class productoPedidoUnoa extends Controller
{
	    public function __construct(){
			$this->middleware('auth');	
		} 
	 	public function create(Request $request){
	 		if ($request) {
	 		$id=trim($request->get('t_p_cliente_id_remision'));
	 		$usuarios=DB::table('empleado')->get();
	 		$clientes=DB::table('cliente')->get();
	 		$tipoPagos=DB::table('tipo_pago')->get();
	 		$abonosCliente=DB::table('t_ab_p_cliente as apc')
	 			->join('t_p_cliente as tc','apc.t_p_cliente_id_remision','=','tc.id_remision')
	 			->join('empleado as e','apc.empleado_id_empleado','=','e.id_empleado')
	 			->join('cliente as c','apc.cliente_id_cliente','=','c.id_cliente')
	 			->join('tipo_pago as p','apc.tipo_pago_id_tpago','=','p.id_tpago')
	 			->select('tc.id_remision as t_p_cliente_id_remision','apc.abono','apc.restante','apc.total','apc.fecha','e.nombre as empleado', 'c.nombre as cliente', 'p.nombre as tipo_pago')
	 			->orderBy('apc.t_p_cliente_id_remision', 'desc')
	 			->paginate(10);

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 		$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();



	 		return view('almacen.pedidosDevoluciones.productoPedidoCliente.abono.registrarAbono',["abonosCliente"=>$abonosCliente, "tipoPagos"=>$tipoPagos, "clientes"=>$clientes, "usuarios"=>$usuarios, "modulos"=>$modulos]);
	 	}

	 	}


	 	public function index(Request $request){
	 		if ($request) {
	 			$idp=trim($request->get('producto_id_producto'));
	 			$id=trim($request->get('t_p_proveedor_id_remision'));
	 			$query=trim($request->get('searchText'));
	 			$query1=trim($request->get('searchText1'));
				 $producto=DB::table('producto')->get();
				 $tpCliente=DB::table('t_p_proveedor')->get();
			 
				 //Es esta variable!!!!
				/* $detalleCliente=DB::table('d_p_proveedor as dc')
				 ->join('t_p_proveedor as tpc','dc.t_p_proveedor_id_remision','=','tpc.id_remision')
				 ->join('stock as s','dc.producto_id_producto','=','s.id_stock')
				 ->join('empleado as e','dc.empleado_id_empleado','=','e.id_empleado')
				 ->join('sede as sed','dc.sede_id_sede','=','sed.id_sede')
				 ->select('dc.dpproveedor as id_dpproveedor','dc.cantidad as cantidad', 'dc.precio_venta as precio_venta', 'tpc.id_remision as t_p_proveedor_id_remision','s.nombre as producto_id_producto','dc.total as total', 'e.nombre as empleado_id_empleado', 'sed.nombre_sede as sede_id_sede', 'dc.fecha')
				 ->where('dc.t_p_proveedor_id_remision','=',$id)
				 ->orderBy('dc.producto_id_producto', 'desc')
				 ->paginate(10);*/

				 $detalleCliente=DB::table('d_p_proveedor as dpp')
				 ->join('t_p_proveedor as tpc','dpp.t_p_proveedor_id_remision','=','tpc.id_remision')
				 ->join('proveedor as prov','dpp.proveedor_id_proveedor','=','prov.id_proveedor')
				 ->join('producto as pro','dpp.producto_id_producto','=','pro.id_producto')
				 ->join('empleado as e','dpp.empleado_id_empleado','=','e.id_empleado')
				 ->join('sede as sed','dpp.sede_id_sede','=','sed.id_sede')
				 ->select('dpp.id_dpproveedor as id_dpproveedor','dpp.cantidad as cantidad', 'dpp.precio_venta as precio_venta', 'tpc.id_remision as t_p_proveedor_id_remision','pro.nombre as producto_id_producto','dpp.total as total', 'e.nombre as empleado_id_empleado', 'sed.nombre_sede as sede_id_sede', 'dpp.fecha', 'prov.nombre_empresa as proveedor_id_proveedor')
				 ->where('dpp.t_p_proveedor_id_remision','=',$id)
				 ->orderBy('dpp.producto_id_producto', 'desc')
				 ->paginate(10);

				 $productosNom=DB::table('producto')
				 ->where('nombre','=',$query)
				 ->orderBy('nombre', 'desc')
				 ->paginate(10);
	 
				 $productosEAN=DB::table('producto as pro')
				 ->join('sede as sed','pro.sede_id_sede','=','sed.id_sede')
				 ->join('empleado as e','pro.empleado_id_empleado','=','e.id_empleado')
				 ->join('categoria as ct','pro.categoria_id_categoria','=','ct.id_categoria')
				 ->select('pro.id_producto','pro.plu','pro.ean','pro.nombre','pro.precio','pro.stock_minimo','pro.fecha_registro','sed.nombre_sede as sede_id_sede','ct.nombre as categoria_id_categoria','e.nombre as empleado_id_empleado')
				 ->where('ean','=',$query)
				 ->orderBy('ean', 'desc')
				 ->paginate(10);
	 
				 $productosEAN2=DB::table('producto as pro')
				 ->join('sede as sed','pro.sede_id_sede','=','sed.id_sede')
				 ->join('empleado as e','pro.empleado_id_empleado','=','e.id_empleado')
				 ->join('categoria as ct','pro.categoria_id_categoria','=','ct.id_categoria')
				 ->select('pro.id_producto','pro.plu','pro.ean','pro.nombre','pro.precio','pro.stock_minimo','pro.fecha_registro','sed.nombre_sede as sede_id_sede','ct.nombre as categoria_id_categoria','e.nombre as empleado_id_empleado')
				 ->where('pro.nombre','LIKE', '%'.$query1.'%')
				 ->orderBy('ean', 'desc')
				 ->paginate(10);
	 
	 
				 $cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
				 $modulos=DB::table('cargo_modulo')
				 ->where('id_cargo','=',$cargoUsuario)
				 ->orderBy('id_cargo', 'desc')->get();
	 
				 $pedidoCliente=DB::table('t_p_proveedor')->get();
	 
				 $eanP=DB::table('producto')
				 ->orderBy('id_producto', 'desc')->get();
	 
				 if($query!="" && $query1!=""){
						 $query1="";
						 $query="";
				}
				 
				$proveedor=DB::table('proveedor')->get();


				 $empleados=DB::table('empleado')
					  ->orderBy('id_empleado', 'desc')->get();
	 
				 $sedes=DB::table('sede')->get();
	 

	 			//return view('almacen.pedidosDevoluciones.productoPedidoUnoa.registrarProductos',["id"=>$id,"producto"=>$producto,"productosNom"=>$productosNom,"searchText"=>$query,"searchText1"=>$query1,"productosEAN2"=>$productosEAN2,"modulos"=>$modulos, "productosImp"=>$productosImp,"productosEAN"=>$productosEAN, "detalleCliente"=>$detalleCliente, "impuestos"=>$impuestos, "descuentos"=>$descuentos, "pedidoCliente"=>$pedidoCliente,"eanP"=>$eanP]);
				 return view('almacen.pedidosDevoluciones.productoPedidoUnoa.registrarProductos',["id"=>$id,"producto"=>$producto,"productosNom"=>$productosNom,"searchText"=>$query,"searchText1"=>$query1,"productosEAN2"=>$productosEAN2,"modulos"=>$modulos,"productosEAN"=>$productosEAN, "detalleCliente"=>$detalleCliente, "pedidoCliente"=>$pedidoCliente,"eanP"=>$eanP, "empleados"=>$empleados,"sedes"=>$sedes, "proveedor"=>$proveedor]);
			}
	 	}



		 public function edit($id){	
	 		
			$id=$id;
			$query="";
			$query1="";
			$producto=DB::table('producto')->get();
			$tpCliente=DB::table('t_p_proveedor')->get();
		
			//Es esta variable!!!!
			$detalleCliente=DB::table('d_p_proveedor as dpp')
			->join('t_p_proveedor as tpc','dpp.t_p_proveedor_id_remision','=','tpc.id_remision')
			->join('proveedor as prov','dpp.proveedor_id_proveedor','=','prov.id_proveedor')
			->join('producto as pro','dpp.producto_id_producto','=','pro.id_producto')
			->join('empleado as e','dpp.empleado_id_empleado','=','e.id_empleado')
			->join('sede as sed','dpp.sede_id_sede','=','sed.id_sede')
			->select('dpp.id_dpproveedor as id_dpproveedor','dpp.cantidad as cantidad', 'dpp.precio_venta as precio_venta', 'tpc.id_remision as t_p_proveedor_id_remision','pro.nombre as producto_id_producto','dpp.total as total', 'e.nombre as empleado_id_empleado', 'sed.nombre_sede as sede_id_sede', 'dpp.fecha', 'prov.nombre_empresa as proveedor_id_proveedor')
			->where('dpp.t_p_proveedor_id_remision','=',$id)
			->orderBy('dpp.producto_id_producto', 'desc')
			->paginate(10);

			$productosNom=DB::table('producto')
			->where('nombre','=',$query)
			->orderBy('nombre', 'desc')
			->paginate(10);

			$productosEAN=DB::table('producto as pro')
			->join('sede as sed','pro.sede_id_sede','=','sed.id_sede')
			->join('empleado as e','pro.empleado_id_empleado','=','e.id_empleado')
			->join('categoria as ct','pro.categoria_id_categoria','=','ct.id_categoria')
			->select('pro.id_producto','pro.plu','pro.ean','pro.nombre','pro.precio','pro.stock_minimo','pro.fecha_registro','sed.nombre_sede as sede_id_sede','ct.nombre as categoria_id_categoria','e.nombre as empleado_id_empleado')
			->where('ean','=',$query)
			->orderBy('ean', 'desc')
			->paginate(10);

			$productosEAN2=DB::table('producto as pro')
			->join('sede as sed','pro.sede_id_sede','=','sed.id_sede')
			->join('empleado as e','pro.empleado_id_empleado','=','e.id_empleado')
			->join('categoria as ct','pro.categoria_id_categoria','=','ct.id_categoria')
			->select('pro.id_producto','pro.plu','pro.ean','pro.nombre','pro.precio','pro.stock_minimo','pro.fecha_registro','sed.nombre_sede as sede_id_sede','ct.nombre as categoria_id_categoria','e.nombre as empleado_id_empleado')
			->where('pro.nombre','LIKE', '%'.$query1.'%')
			->orderBy('ean', 'desc')
			->paginate(10);



			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
			$modulos=DB::table('cargo_modulo')
			->where('id_cargo','=',$cargoUsuario)
			->orderBy('id_cargo', 'desc')->get();

			$pedidoCliente=DB::table('t_p_proveedor')->get();

			$eanP=DB::table('producto')
			->orderBy('id_producto', 'desc')->get();

			if($query!="" && $query1!=""){
					$query1="";
					$query="";
		   }
			

		   $proveedor=DB::table('proveedor')->get();


		    $empleados=DB::table('empleado')
				 ->orderBy('id_empleado', 'desc')->get();

			$sedes=DB::table('sede')->get();

			return view('almacen.pedidosDevoluciones.productoPedidoUnoa.registrarProductos',["id"=>$id,"producto"=>$producto,"productosNom"=>$productosNom,"searchText"=>$query,"searchText1"=>$query1,"productosEAN2"=>$productosEAN2,"modulos"=>$modulos,"productosEAN"=>$productosEAN, "detalleCliente"=>$detalleCliente, "pedidoCliente"=>$pedidoCliente,"eanP"=>$eanP, "empleados"=>$empleados,"sedes"=>$sedes, "proveedor"=>$proveedor]);
		}






	 	public function store(DetallePPFormRequest $request){
	 		
	 		$cantidadR=$request->get('cantidad');
	 		$productoR=$request->get('producto_id_producto');

	 		$existeR=DB::table('stock')
	 		->where('cantidad','>=',$cantidadR)
	 		->where('id_stock','=',$productoR)
	 		->get();

	 		
	 		$detallepc = new DetallePP;
	 		$cantidad=$cantidadR;
	 		$precio=$request->get('precio_venta');
	 		$id_remision=$request->get('t_p_proveedor_id_remision');
			$detallepc->empleado_id_empleado=$request->get('empleado_id_empleado');
			$detallepc->proveedor_id_proveedor=$request->get('proveedor_id_proveedor');
			$detallepc->sede_id_sede=$request->get('sede_id_sede');
			$detallepc->fecha=$request->get('fecha');
	 		$detallepc->cantidad=$request->get('cantidad');
	 		$detallepc->t_p_proveedor_id_remision=$id_remision;
	 		$detallepc->producto_id_producto=$productoR;
	 		$detallepc->precio_venta=$precio;

		
	 		$detallepc->total=$cantidad*($precio);
	 		$detallepc->save();
	 		$total=$cantidad*($precio);


	 		$pc = PedidoProveedor::findOrFail($id_remision);
	 		$precioAnterior=$pc->pago_total;
	 		$productos=$pc->noproductos;

	 		$pc->pago_total=$precioAnterior+$total;
	 		$pc->noproductos=$productos+$cantidad;
	 		$pc->update(); 



	 		return back()->with('msj','Producto guardado');

	 	}



		 public function update(Request $request, $id){
			$pedidoCliente = PedidoProveedor::findOrFail($id);
		    $pedidoCliente->finalizar=0;
			$pedidoCliente->update();

			/*$cliente=DB::table('t_p_cliente as pc')
			->join('cliente as cli','pc.cliente_id_cliente','=','cli.id_cliente')
			->join('users as us','cli.user_id_user','=','us.id')
			->select('us.email')
			->where('pc.id_remision','=',$id)	
			->get();
			$enviar=$cliente[0]->email;
			//dd($cliente);*/

			$id=$id;

			require('fpdf/fpdf.php');
			require 'cn.php';

			$pdf = new FPDF($orientation='P',$unit='mm');
			$pdf->AddPage();
			$pdf->SetFont('Arial','I',8);

			//$pdf->Output(public_path('/pdfPedidos/'),'s.pdf','F','UTF-8');
			//$pdf->Output('D','RP_Ventas.pdf','UTF-8');

			$pdf->Output(public_path('/pdfPedidos/').$id.'.pdf','F','UTF-8');

			$enviar="holmanrincon7@gmail.com";
		
			$subject = "PEDIDO UNO A";
			$for = $enviar;
			Mail::send('almacen.emails.tickets',$request->all(), function($msj) use($subject,$for){
				$msj->from("holman.test17@gmail.com","Lista de pedidos.");
				$msj->subject($subject);
				$msj->to($for);
				//$msj->attach(public_path('/').'/prueba.pdf'); 
			});
			
			return back()->with('msj','Pedido finalizado');
		}


		/*public function aprobar($id, Request $request){

			$id=$id;
			$fecha_actual=date("Y-m-d");
			$p=PedidoCliente::findOrFail($id);
			if($p->fecha_entrega>$fecha_actual){
				$p->nombre_aprobador=auth()->user()->name;
				$p->correo_aprobador=auth()->user()->email;
				$p->estado=2;
			$p->save();
			

		$facturaInfo="SELECT tpc.subempresa_pedido, tpc.empresa_pedido, tpc.correo_aprobador, tpc.nombre_aprobador, tpc.id_remision, tpc.fecha_solicitud, tpc.fecha_entrega, e.nombre as nombre_empleado, c.nombre as nombre_cliente, c.documento as documento_cliente, c.verificacion_nit as nit, c.telefono as telefono_cliente, tp.nombre as t_entrega, tpc.noproductos FROM empleado as e, t_p_cliente as tpc,cliente as c, tipo_entrega as tp WHERE tpc.id_remision='$id' and tpc.empleado_id_empleado=e.id_empleado and tpc.cliente_id_cliente=c.id_cliente and tp.id_tipo_entrega=tpc.entrega_id_tipo_entrega ";

		$fecha="SELECT CURDATE() as fechas";

	 	$productos="SELECT dpc.cantidad, dpc.fecha, stc.nombre as nombre_producto, e.nombre as nombre_empleado FROM d_p_cliente as dpc, stock_clientes as stc, empleado as e, t_p_cliente as tpc,cliente as c WHERE dpc.empleado_id_empleado=e.id_empleado and tpc.cliente_id_cliente=c.id_cliente and dpc.producto_id_producto=stc.id_stock_clientes and dpc.t_p_cliente_id_remision='$id' and tpc.id_remision=dpc.t_p_cliente_id_remision";

		require('fpdf/fpdf.php');
		require 'cn.php';

		$consulta = $facturaInfo;
		$consulta3 = $productos;
		$consulta4 = $fecha;

		$facturas = $mysqli->query($consulta);
		$facturas2 = $mysqli->query($consulta);
		$listaProductos = $mysqli->query($consulta3);
		$fechaActual = $mysqli->query($consulta4);

		$pdf = new FPDF($orientation='P',$unit='mm');
		$pdf->AddPage();
		$pdf->SetFont('Arial','I',8);
		$hola='hola';

		//fecha para qr
		$fechaQR= $fecha;
		$qrFecha = $mysqli->query($fechaQR);

		$totalQR= $facturaInfo;
		$qrTotal = $mysqli->query($totalQR);


		$charfec='Fecha:';
		while($row = $qrFecha->fetch_assoc()){
		    $fec=$row['fechas'];
		}

		$charno='No_Prod:';
		while($row = $qrTotal->fetch_assoc()){
		    
		    $noPro=$row['noproductos'];
		}


		$pdf->Cell(40,10,'PEDIDOS DE CLIENTES',0,1);
		$pdf->Cell(25,5,'Fecha de aprobacion: ',0,0);
		while($row = $fechaActual->fetch_assoc()){    
		    $pdf->Cell(30,5,$row['fechas'],0,1,'C',0);
		}


		$pdf->Cell(40,10,'',0,1);


		$pdf->Cell(40,5,'Datos de Emisor y Adquiriente:',0,1);
		$pdf->Cell(40,5,'',0,1);



		$pdf->SetFillColor(13,16,64);


		while($row = $facturas2->fetch_assoc()){
		    $pdf->SetTextColor(255,255,255);
		    $pdf->Cell(190,5,'DATOS DEL PEDIDO',1,1,"C",true);
		    $pdf->SetTextColor(0,0,1);
		    $pdf->Cell(60,5,'No. remision:',1,0);
		    $pdf->Cell(130,5,$row['id_remision'],1,1,'C',0);
		    $pdf->Cell(60,5,'Nombre cliente:',1,0);
		    $pdf->Cell(130,5,$row['nombre_cliente'],1,1,'C',0);
		    $pdf->Cell(60,5,'Documento/NIT:',1,0);
		    $pdf->Cell(120,5,$row['documento_cliente'],1,0,'C',0);
		    $pdf->Cell(10,5,$row['nit'],1,1,'C',0);
		    $pdf->Cell(60,5,'Telefono:',1,0);
		    $pdf->Cell(130,5,$row['telefono_cliente'],1,1,'C',0);
		    $pdf->Cell(60,5,'Nombre de aprobador:',1,0);
		    $pdf->Cell(130,5,$row['nombre_aprobador'],1,1,'C',0);
		    $pdf->Cell(60,5,'Correo de aprobador:',1,0);
		    $pdf->Cell(130,5,$row['correo_aprobador'],1,1,'C',0);
		    $pdf->Cell(60,5,'Nombre de empresa:',1,0);
		    $pdf->Cell(130,5,$row['empresa_pedido'],1,1,'C',0);
		    $pdf->Cell(60,5,'Nombre de subempresa:',1,0);
		    $pdf->Cell(130,5,$row['subempresa_pedido'],1,1,'C',0);
		    $pdf->Cell(60,5,'Tipo de entrega:',1,0);
		    $pdf->Cell(130,5,$row['t_entrega'],1,1,'C',0);
		    $pdf->Cell(60,5,'Fecha de solicitud:',1,0);
		    $pdf->Cell(130,5,$row['fecha_solicitud'],1,1,'C',0);
		    $pdf->Cell(60,5,'Fecha de envio:',1,0);
		    $pdf->Cell(130,5,$row['fecha_entrega'],1,1,'C',0);

		}

		$pdf->Cell(15, 15, 'Productos:', 0,1);
		    $pdf->SetTextColor(255,255,255);
		    $pdf->Cell(140,5,'Nombre',1,0,"C",true);
		    $pdf->Cell(20,5,'Cantidad',1,0,"C",true);
		    $pdf->Cell(30,5,'Fecha',1,1,"C",true);
		    $pdf->SetTextColor(0,0,1);


		while($row = $listaProductos->fetch_assoc()){
		    $pdf->Cell(140,5,$row['nombre_producto'],1,0,'C',0);
		    $pdf->Cell(20,5,$row['cantidad'],1,0,'C',0);
		    $pdf->Cell(30,5,$row['fecha'],1,1,'C',0);

		}

		$pdf->Output(public_path('/pdfPedidos/').$id.'.pdf','F','UTF-8');


			
		
			$enviar="juangomez3701@gmail.com";

			$subject = "PEDIDO UNO A ID:".$id;
			$for = $enviar;
			$file=$id;
			
			Mail::send('almacen.emails.tickets',$request->all(), function($msj) use($subject,$for,$file){
				$msj->from("holman.test17@gmail.com","Pedido aprobado");
				$msj->subject($subject);
				$msj->to($for);
				$msj->attach(public_path('/pdfPedidos').'/'.$file.'.pdf'); 
			});

			return Redirect::to('almacen/pedido')->with('msj','Pedido aprobado');

			}else{
				return back()->with('errormsj','¡Revise la fecha de entrega!');
			}
			
	 	}*/




	 	public function destroy($idf){
	 	
	 		$detallepc=DetallePP::findOrFail($idf);
	 		$id=$detallepc->t_p_proveedor_id_remision;
	 		$can=$detallepc->cantidad;
	 		$to=$detallepc->total;
	 		$detallepc->delete();

	 		$pc=PedidoProveedor::findOrFail($id);
	 		$precioAnterior=$pc->pago_total;
	 		$productosTotal=$pc->noproductos;

	 		$pc->pago_total=$precioAnterior-$to;
	 		$pc->noproductos=$productosTotal-$can;

	 		$pc->update();



	 		return back()->with('msj','Producto eliminado');


		}

}
