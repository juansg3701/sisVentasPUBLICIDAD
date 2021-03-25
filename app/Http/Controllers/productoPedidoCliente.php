<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\DetallePC;
use sisVentas\AbonoPC;
use sisVentas\PedidoCliente;
use sisVentas\Stock;
use sisVentas\StockClientes;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\DetallePCFormRequest;
use sisVentas\Http\Requests\PedidoClienteFormRequest;
use sisVentas\Http\Requests\StockFormRequest;
use sisVentas\Http\Requests\AbonoPCFormRequest;
use Mail;
use DB;


class productoPedidoCliente extends Controller
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
	 			$id=trim($request->get('t_p_cliente_id_remision'));
	 			$query=trim($request->get('searchText'));
	 			$query1=trim($request->get('searchText1'));
	 			$producto=DB::table('producto')->get();
	 			$tpCliente=DB::table('t_p_cliente')->get();

	 			$detalleCliente=DB::table('d_p_cliente as dc')
				->join('t_p_cliente as tpc','dc.t_p_cliente_id_remision','=','tpc.id_remision')
				->join('stock_clientes as s','dc.producto_id_producto','=','s.id_stock_clientes')
				->join('empleado as e','dc.empleado_id_empleado','=','e.id_empleado')
				->join('sede as sed','dc.sede_id_sede','=','sed.id_sede')
				->select('dc.id_dpcliente as id_dpcliente','dc.cantidad as cantidad', 'dc.precio_venta as precio_venta', 'tpc.id_remision as t_p_cliente_id_remision','s.nombre as producto_id_producto','dc.total as total', 'e.nombre as empleado_id_empleado', 'sed.nombre_sede as sede_id_sede', 'dc.fecha')
				->where('dc.t_p_cliente_id_remision','=',$id)
				->orderBy('dc.producto_id_producto', 'desc')
				->paginate(10);

	 			$productosNom=DB::table('producto')
	 			->where('nombre','=',$query)
	 			->orderBy('nombre', 'desc')
	 			->paginate(10);


				 $productosEAN=DB::table('stock_clientes as s')
				 ->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
				 ->join('sede as sed2','s.sede_id_sede_cliente','=','sed2.id_sede')
				 ->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
				 ->join('categoria_stock_especiales as c','s.categoria_dias_especiales_id','=','c.id_categoriaStock')
				 ->join('empresa as em','s.empresa_id_empresa','=','em.id_empresa')
				 ->join('categoria as ct','s.categoria_id_categoria','=','ct.id_categoria')
				 ->select('s.id_stock_clientes as id_producto','s.nombre','s.plu','s.ean','sed.nombre_sede as sede_empresa','sed2.nombre_sede as sede_cliente','c.nombre as categoria_especial','s.cantidad','sed.id_sede as id_sede_empresa','sed2.id_sede as id_sede_cliente','s.producto_dados_baja','s.fecha_vencimiento', 's.fecha_registro','e.nombre as empleado_id_empleado', 's.imagen as img','s.precio as precioU','ct.nombre as categoria_normal','s.empresa_id_empresa as nombre_empresa','s.empresa_categoria_id as nombre_subempresa')
				 ->where('ean','=',$query)
				 ->orderBy('ean', 'desc')
				 ->paginate(10);
	 
				 $productosEAN2=DB::table('stock_clientes as s')
				 ->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
				 ->join('sede as sed2','s.sede_id_sede_cliente','=','sed2.id_sede')
				 ->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
				 ->join('categoria_stock_especiales as c','s.categoria_dias_especiales_id','=','c.id_categoriaStock')
				 ->join('empresa as em','s.empresa_id_empresa','=','em.id_empresa')
				 ->join('categoria as ct','s.categoria_id_categoria','=','ct.id_categoria')
				 ->select('s.id_stock_clientes as id_producto','s.nombre','s.plu','s.ean','sed.nombre_sede as sede_empresa','sed2.nombre_sede as sede_cliente','c.nombre as categoria_especial','s.cantidad','sed.id_sede as id_sede_empresa','sed2.id_sede as id_sede_cliente','s.producto_dados_baja','s.fecha_vencimiento', 's.fecha_registro','e.nombre as empleado_id_empleado', 's.imagen as img','s.precio as precioU','ct.nombre as categoria_normal','s.empresa_id_empresa as nombre_empresa','s.empresa_categoria_id as nombre_subempresa')
				 ->where('s.nombre','LIKE', '%'.$query1.'%')
				 ->orderBy('ean', 'desc')
				 ->paginate(10);

	 			if(auth()->user()->superusuario==0){
					$productosEAN=DB::table('stock_clientes as s')
					->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
					->join('sede as sed2','s.sede_id_sede_cliente','=','sed2.id_sede')
					->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
					->join('categoria_stock_especiales as c','s.categoria_dias_especiales_id','=','c.id_categoriaStock')
					->join('empresa as em','s.empresa_id_empresa','=','em.id_empresa')
					->join('categoria as ct','s.categoria_id_categoria','=','ct.id_categoria')
					->select('s.id_stock_clientes as id_producto','s.nombre','s.plu','s.ean','sed.nombre_sede as sede_empresa','sed2.nombre_sede as sede_cliente','c.nombre as categoria_especial','s.cantidad','sed.id_sede as id_sede_empresa','sed2.id_sede as id_sede_cliente','s.producto_dados_baja','s.fecha_vencimiento', 's.fecha_registro','e.nombre as empleado_id_empleado', 's.imagen as img','s.precio as precioU','ct.nombre as categoria_normal','s.empresa_id_empresa as nombre_empresa','s.empresa_categoria_id as nombre_subempresa')
					->where('ean','=',$query)
					->where('s.sede_id_sede','=',auth()->user()->sede_id_sede)
					->orderBy('ean', 'desc')
					->paginate(10);
		
					$productosEAN2=DB::table('stock_clientes as s')
					->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
					->join('sede as sed2','s.sede_id_sede_cliente','=','sed2.id_sede')
					->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
					->join('categoria_stock_especiales as c','s.categoria_dias_especiales_id','=','c.id_categoriaStock')
					->join('empresa as em','s.empresa_id_empresa','=','em.id_empresa')
					->join('categoria as ct','s.categoria_id_categoria','=','ct.id_categoria')
					->select('s.id_stock_clientes as id_producto','s.nombre','s.plu','s.ean','sed.nombre_sede as sede_empresa','sed2.nombre_sede as sede_cliente','c.nombre as categoria_especial','s.cantidad','sed.id_sede as id_sede_empresa','sed2.id_sede as id_sede_cliente','s.producto_dados_baja','s.fecha_vencimiento', 's.fecha_registro','e.nombre as empleado_id_empleado', 's.imagen as img','s.precio as precioU','ct.nombre as categoria_normal','s.empresa_id_empresa as nombre_empresa','s.empresa_categoria_id as nombre_subempresa')
					->where('s.nombre','LIKE', '%'.$query1.'%')
					->where('s.sede_id_sede','=',auth()->user()->sede_id_sede)
					->orderBy('ean', 'desc')
					->paginate(10);
	 		}


	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$pedidoCliente=DB::table('t_p_cliente')->get();

	 			$eanP=DB::table('producto')
	 			->orderBy('id_producto', 'desc')->get();

	 			if($query!="" && $query1!=""){
	 				$query1="";
	 				$query="";
	 			}

				$empleados=DB::table('empleado')
				 ->orderBy('id_empleado', 'desc')->get();

				$sedes=DB::table('sede')->get();
				 
	 		return view('almacen.pedidosDevoluciones.productoPedidoUnoa.registrarProductos',["id"=>$id,"producto"=>$producto,"productosNom"=>$productosNom,"searchText"=>$query,"searchText1"=>$query1,"productosEAN2"=>$productosEAN2,"modulos"=>$modulos,"productosEAN"=>$productosEAN, "detalleCliente"=>$detalleCliente,"pedidoCliente"=>$pedidoCliente,"eanP"=>$eanP, "empleados"=>$empleados,"sedes"=>$sedes]);
	 		}
	 	}

	 	/*public function store(DetallePCFormRequest $request){
	 		
	 		$cantidadR=$request->get('cantidad');
	 		$productoR=$request->get('producto_id_producto');

	 		$existeR=DB::table('stock')
	 		->where('cantidad','>=',$cantidadR)
	 		->where('id_stock','=',$productoR)
	 		->get();

	 		if(count($existeR)!=0){
	 		$detallepc = new DetallePC;
	 		$cantidad=$cantidadR;
	 		$precio=$request->get('precio_venta');
	 		$id_remision=$request->get('t_p_cliente_id_remision');
	 		$impuesto=$request->get('impuestos_id_impuestos');
	 		$descuento=$request->get('descuentos_id_descuento');
	 		$detallepc->cantidad=$cantidad;
	 		$detallepc->t_p_cliente_id_remision=$id_remision;
	 		$detallepc->producto_id_producto=$productoR;
	 		$detallepc->precio_venta=$precio;
	 		$detallepc->descuentos_id_descuento=$descuento;
	 		$detallepc->impuestos_id_impuestos=$impuesto;


	 		$valorImpuesto=DB::table('impuestos')
	 		->select('valor')
	 		->where('id_impuestos','=',$impuesto)
	 		->get();
	 		
	 		$valorDescuento=DB::table('descuentos')
	 		->select('porcentaje')
	 		->where('id_descuento','=',$descuento)
	 		->get();

	 		$porcentajeI=0;
	 		foreach ($valorImpuesto as $vi) {
	 			$porcentajeI=($vi->valor*$precio)/100;
	 			
	 		}

	 		$porcentajeD=0;
	 		foreach ($valorDescuento as $vd) {
	 			$porcentajeD=($vd->porcentaje*$precio)/100;	
	 		}

	 		$detallepc->total=$cantidad*($precio+$porcentajeI-$porcentajeD);
	 		$detallepc->save();
	 		$total=$cantidad*($precio+$porcentajeI-$porcentajeD);


	 		$pc = PedidoCliente::findOrFail($id_remision);
	 		$precioAnterior=$pc->pago_total;
	 		$productos=$pc->noproductos;

	 		$pc->pago_total=$precioAnterior+$total;
	 		$pc->noproductos=$productos+$cantidad;
	 		$pc->update(); 

	 		$stockR = ProveedorSede::findOrFail($productoR);
	 		$cantidadA=$stockR->cantidad;
	 		$stockR->cantidad=$cantidadA-$cantidadR;
	 		$stockR->update();

	 		return back()->with('msj','Producto guardado y descontado del stock');

	 		}else{
	 			return back()->with('errormsj','No hay suficiente stock');
	 		}

		 }*/
		 
		public function store(DetallePCFormRequest $request){
	 		
			$cantidadR=$request->get('cantidad');
			$productoR=$request->get('producto_id_producto');

			$existeR=DB::table('stock_clientes')
			->where('cantidad','>=',$cantidadR)
			->where('id_stock_clientes','=',$productoR)
			->get();

			if(count($existeR)!=0){
			$detallepc = new DetallePC;
			$cantidad=$cantidadR;
			$precio=$request->get('precio_venta');
			$id_remision=$request->get('t_p_cliente_id_remision');

			$detallepc->empleado_id_empleado=$request->get('empleado_id_empleado');
			$detallepc->sede_id_sede=$request->get('sede_id_sede');
			$detallepc->fecha=$request->get('fecha');
			
			$detallepc->cantidad=$cantidad;
			$detallepc->t_p_cliente_id_remision=$id_remision;
			$detallepc->producto_id_producto=$productoR;
			$detallepc->precio_venta=$precio;
		
			$detallepc->total=$cantidad*($precio);
			$detallepc->save();
			$total=$cantidad*($precio);

			$pc = PedidoCliente::findOrFail($id_remision);
			$precioAnterior=$pc->pago_total;
			$productos=$pc->noproductos;

			$pc->pago_total=$precioAnterior+$total;
			$pc->noproductos=$productos+$cantidad;
			$pc->update(); 

			$stockR = StockClientes::findOrFail($productoR);
			$cantidadA=$stockR->cantidad;
			$stockR->cantidad=$cantidadA-$cantidadR;
			$stockR->update();

			return back()->with('msj','Producto guardado y descontado del stock');

			}else{

				return back()->with('errormsj','No hay suficiente stock');
			}

		}

		public function update(Request $request, $id){
			$pedidoCliente = PedidoCliente::findOrFail($id);
		    $pedidoCliente->finalizar=0;
			$pedidoCliente->update();

			$cliente=DB::table('t_p_cliente as pc')
			->join('cliente as cli','pc.cliente_id_cliente','=','cli.id_cliente')
			->join('users as us','cli.user_id_user','=','us.id')
			->select('us.email')
			->where('pc.id_remision','=',$id)	
			->get();

			$enviar=$cliente[0]->email;

			//dd($cliente);

		
			$subject = "PEDIDO UNO A";
			$for = $enviar;
			Mail::send('almacen.emails.tickets',$request->all(), function($msj) use($subject,$for){
				$msj->from("holman.test17@gmail.com","Su pedido ha sido enviado, pronto se le avisará cuando sea despachado.");
				$msj->subject($subject);
				$msj->to($for);
				//$msj->attach(public_path('/').'/prueba.pdf'); 
			});
			
			return back()->with('msj','Pedido finalizado');
		}

	 	public function show(Request $request){


	 	}

	 	public function destroy($idf){
	 	
	 		$detallepc=DetallePC::findOrFail($idf);
	 		$id=$detallepc->t_p_cliente_id_remision;
	 		$can=$detallepc->cantidad;
	 		$to=$detallepc->total;
	 		$detallepc->delete();

	 		$pc=PedidoCliente::findOrFail($id);
	 		$precioAnterior=$pc->pago_total;
	 		$productosTotal=$pc->noproductos;

	 		$pc->pago_total=$precioAnterior-$to;
	 		$pc->noproductos=$productosTotal-$can;

	 		$pc->update();

	 		$cantidadR=$detallepc->cantidad;
	 		$productoR=$detallepc->producto_id_producto;

	 		$stockR = StockClientes::findOrFail($productoR);
	 		$cantidadA=$stockR->cantidad;
	 		$stockR->cantidad=$cantidadA+$cantidadR;
	 		$stockR->update();

	 		return back()->with('msj','Producto eliminado y sumado al stock');


		}


		public function sendMail(Request $request){
			$subject = "Asunto del correo";
			$for = "holmanrincon7@gmail.com";
			Mail::send('almacen.emails.tickets',$request->all(), function($msj) use($subject,$for){
				$msj->from("holman.test17@gmail.com","Prueba-Ticket");
				$msj->subject($subject);
				$msj->to($for);
				//$msj->attach(public_path('/').'/prueba.pdf');
			   
			});
	
			return back()->with('msj','Correo enviado');
		}

}
