<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\PedidoProveedor;
use sisVentas\AbonoPC;
use sisVentas\DetallePP;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\PedidoProveedorFormRequest;
use sisVentas\Http\Requests\AbonoPCFormRequest;
use DB;

class facturacionListaPedidosUnoa extends Controller
{
	public function __construct(){
		$this->middleware('auth');	
	} 

	 	public function create(Request $request){
	 	}

	 	public function index(Request $request){

	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$query2=trim($request->get('searchText2'));
	 			$query3=trim($request->get('searchText3'));
	 			$query4=trim($request->get('searchText4'));
	 			$usuarios=DB::table('empleado')->get();
	 			$clientes=DB::table('cliente')->get();
	 			$tipoPagos=DB::table('tipo_pago')->get();


	 			$pedidosCliente=DB::table('t_p_proveedor as tc')
	 			->join('empleado as e','tc.empleado_id_empleado','=','e.id_empleado')
	 			
	 			->join('tipo_pago as p','tc.tipo_pago_id_tpago','=','p.id_tpago')
	 			->select('tc.id_remision','tc.noproductos','tc.fecha_solicitud','tc.fecha_entrega','tc.pago_inicial','tc.porcentaje_venta','tc.pago_total', 'e.nombre as empleado', 'p.nombre as tipo_pago', 'tc.estado')
	 			->where('tc.fecha_solicitud','LIKE', '%'.$query.'%')
	 			->where('tc.fecha_entrega','LIKE', '%'.$query2.'%')
	 			->where('tc.id_remision','LIKE', '%'.$query3.'%')
	 			
	 			->orderBy('tc.id_remision', 'desc')
	 			->paginate(10);

				
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$clientesP=DB::table('cliente')->get();
	 			$pedidoP=DB::table('t_p_cliente')->get();

	 			return view('almacen.facturacion.listaPedidosUnoa.listaPedidos',["pedidosCliente"=>$pedidosCliente, "tipoPagos"=>$tipoPagos, "clientes"=>$clientes, "usuarios"=>$usuarios, "searchText"=>$query, "searchText2"=>$query2, "searchText3"=>$query3, "searchText4"=>$query4, "modulos"=>$modulos,"clientesP"=>$clientesP,"pedidoP"=>$pedidoP]);
	 		}
	 	}
		

	 	public function show(Request $request){
	 		if ($request){
	 			$query=trim($request->get('searchText'));
	 			$usuarios=DB::table('empleado')->get();
	 			$clientes=DB::table('cliente')->get();
	 			$tipoPagos=DB::table('tipo_pago')->get();
	 			$pedidosCliente=DB::table('t_p_cliente as tc')
	 			->join('empleado as e','tc.empleado_id_empleado','=','e.id_empleado')
	 			->join('cliente as c','tc.cliente_id_cliente','=','c.id_cliente')
	 			->join('tipo_pago as p','tc.tipo_pago_id_tpago','=','p.id_tpago')
	 			->select('tc.id_remision','tc.noproductos','tc.fecha_solicitud','tc.fecha_entrega','tc.pago_inicial','tc.porcentaje_venta','tc.pago_total', 'e.nombre as empleado', 'c.nombre as cliente', 'p.nombre as tipo_pago')
	 			->where('tc.fecha_solicitud','LIKE', '%'.$query.'%')
	 			->orderBy('tc.id_remision', 'desc')
	 			->paginate(10);

				$empleados=DB::table('empleado')
				 ->orderBy('id_empleado', 'desc')->get();

				$sedes=DB::table('sede')->get();

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			return view('almacen.pedidosDevoluciones.pedidoUnoa.pedidoCliente',["pedidosCliente"=>$pedidosCliente, "tipoPagos"=>$tipoPagos, "clientes"=>$clientes, "usuarios"=>$usuarios, "searchText"=>$query, "modulos"=>$modulos,"empleados"=>$empleados,"sedes"=>$sedes]);
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

			return view('almacen.pedidosDevoluciones.productoPedidoUnoa.registrarProductos',["id"=>$id,"producto"=>$producto,"productosNom"=>$productosNom,"searchText"=>$query,"searchText1"=>$query1,"productosEAN2"=>$productosEAN2,"modulos"=>$modulos,"productosEAN"=>$productosEAN, "detalleCliente"=>$detalleCliente, "pedidoCliente"=>$pedidoCliente,"eanP"=>$eanP, "empleados"=>$empleados, "sedes"=>$sedes, "proveedor"=>$proveedor]);
		}




	 	public function store(PedidoProveedorFormRequest $request){


	 		$pedidoCliente = new PedidoProveedor;
	 		$pedidoCliente->noproductos=$request->get('noproductos');
	 		$pedidoCliente->fecha_solicitud=$request->get('fecha_solicitud');
	 		$pedidoCliente->fecha_entrega=$request->get('fecha_entrega');	
	 		$pedidoCliente->pago_inicial=$request->get('pago_inicial');
	 		$pedidoCliente->porcentaje_venta=$request->get('porcentaje_venta');
	 		//$pedidoCliente->cliente_id_cliente=$request->get('cliente_id_cliente');
	 		$pedidoCliente->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$pedidoCliente->tipo_pago_id_tpago=$request->get('tipo_pago_id_tpago');
	 		$pedidoCliente->save();

			$id=$pedidoCliente->id_remision;
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

	 	public function update(PedidoProveedorFormRequest $request, $id){

	 		$pedidoCliente = PedidoProveedor::findOrFail($id);
	 		$pedidoCliente->noproductos=$request->get('noproductos');
	 		$pedidoCliente->fecha_solicitud=$request->get('fecha_solicitud');
	 		$pedidoCliente->fecha_entrega=$request->get('fecha_entrega');	
	 		$pedidoCliente->pago_inicial=$request->get('pago_inicial');
	 		$pedidoCliente->porcentaje_venta=$request->get('porcentaje_venta');
	 		$pedidoCliente->pago_total=$request->get('pago_total');
	 		$pedidoCliente->cliente_id_cliente=$request->get('cliente_id_cliente');
	 		$pedidoCliente->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$pedidoCliente->tipo_pago_id_tpago=$request->get('tipo_pago_id_tpago');

	 		$pedidoCliente->update();
	 		return Redirect::to('almacen/facturacion/listaPedidosUnoa');

	 	}


	 	public function destroy($id){
	 		$id=$id;
	 		$modulos=DB::table('d_p_proveedor')
	 		->select('id_dpproveedor')
	 		->where('t_p_proveedor_id_remision','=',$id)
	 		->orderBy('id_dpproveedor', 'desc')->get();

			$existe=DB::table('d_p_proveedor')
			->select('id_dpproveedor as id')
			->where('t_p_proveedor_id_remision','=',$id)
			->orderBy('id_dpproveedor', 'desc')->get();




	 			if(count($modulos)==0){
	 				$pedidoCliente = PedidoProveedor::findOrFail($id);
	 				$pedidoCliente->delete();
	 				return back()->with('msj','Pedido eliminado');
	 			}
	 			else{

					for ($i=0; $i <count($modulos) ; $i++) { 
						$proCorte=DetallePP::findOrFail($modulos[$i]->id_dpproveedor);
						$proCorte->delete();
					}

					$t_p_proveedor=PedidoProveedor::findOrFail($id);
					$t_p_proveedor->delete();
	
					return back()->with('msj','Pedido eliminado');


				
	 				//return back()->with('errormsj','¡Pedido con productos!');
	 			}
	 	}


		public function changeState($id){
			$pedidoProveedor = PedidoProveedor::findOrFail($id);
		   	$pedidoProveedor->estado=2;
			$pedidoProveedor->save();
			return back()->with('msj','Pedido despachado');
		}
		
}