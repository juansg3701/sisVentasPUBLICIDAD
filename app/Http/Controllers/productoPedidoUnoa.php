<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\DetallePP;
use sisVentas\PedidoProveedor;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\DetallePPFormRequest;
use DB;


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
