<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RPedidosFormRequest;
use DB;

class reportesPedidos extends Controller
{
	  public function __construct(){
			$this->middleware('auth');	

			 	} 
	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));

	 			$sedes=DB::table('usuario')->where('nombre_sede','LIKE', '%'.$query.'%');

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			$empresas=DB::table('empresa')
	 			->orderBy('id_empresa', 'desc')
	 			->get();

	 			if($query!=""){
	 				$subempresas=DB::table('empresa_categoria')
	 				->where('empresa_id_empresa','=',$query)
		 			->orderBy('id_empresa_categoria', 'desc')
		 			->get();
	 			}else{
		 			$subempresas=DB::table('empresa_categoria')
		 			->orderBy('id_empresa_categoria', 'desc')
		 			->get();	
	 			}
	 			
	 		

	 			return view('almacen.reportes.pedidos.pedidos',["sedes"=>$sedes,"searchText"=>$query, "modulos"=>$modulos, "empresas"=>$empresas, "subempresas"=>$subempresas]);
	 		}
	 	}



	 	public function store(RPedidosFormRequest $request){
	 		$fechaInicialR=$request->get('fechaInicial');
	 		$fechaFinalR=$request->get('fechaFinal');

	 		if($fechaInicialR<=$fechaFinalR){

	 		$reporte = new RPedidos;
	 		$reporte->fechaInicial=$fechaInicialR;
	 		$reporte->fechaFinal=$fechaFinalR;
	 		$reporte->fechaActual=$request->get('fechaActual');

	 		$no="SELECT SUM(df.cantidad) FROM detalle_factura as df,factura as f WHERE df.factura_id_factura=f.id_factura";

	 		$nop="SELECT SUM(pro.stock_minimo) FROM producto as pro";

	 		$reporte->noProductos=$nop;
	 		$reporte->total=$request->get('total');
	 		$reporte->save();

	 			return back()->with('msj','Reporte guardado');
	 		}else{
	 			return back()->with('errormsj','¡Las fechas no son correctas!');
	 		}
	 	}


	 	public function destroy($id){
	 		
	 	}

	 	public function update(Request $request, $id){
	 		$empresa_r=$request->get('empresa');
	 		$subempresa_r=$request->get('suebempresa');
	 		$mes_r=$request->get('mes');
	 		$mes_final=$request->get('mes_final');
	 		$year_r=$request->get('year');

	 			if($empresa_r!="" || $mes_r!="" || $year_r!=""){
	 				return back()->with('errormsj','¡¡Los datos deben estar comlpletos!!');
	 			}else{

	 				if($subempresa_r==""){
	 					$pedidos_mensuales=DB::table('t_p_cliente as tpc')
			 			->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
			 			->select('tpc.id_factura',
						 DB::raw('sum(tpc.noproductos) as noproductos'), 
						 'tp.nombre as tipo_pago_id_tpago', 
						 DB::raw('MONTH(tpc.fecha_entrega) as fecha'), 
						 DB::raw('YEAR(tpc.fecha_entrega) as fecha_year'),
						 DB::raw('MONTH(tpc.fecha_entrega) as fecha_mes'))
			 			->where(DB::raw('MONTH(tpc.fecha_entrega)'),'>=',$mes_r)
			 			->where(DB::raw('MONTH(tpc.fecha_entrega)'),'<=',$mes_final)
			 			->where(DB::raw('YEAR(tpc.fecha_entrega)'),'=',$year_r)
			 			->where('tpc.estado','=',3)
			 			->where('tpc.empresa_pedido','=',$empresa_r)
			 			->orderBy('tpc.id_remision', 'asc')
			 			->groupBy(DB::raw('MONTH(tpc.fecha_entrega)'))
			 			->paginate(100);
	 				}else{
	 					$pedidos_mensuales=DB::table('t_p_cliente as tpc')
			 			->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
			 			->select('tpc.id_factura',
						 DB::raw('sum(tpc.noproductos) as noproductos'), 
						 'tp.nombre as tipo_pago_id_tpago', 
						 DB::raw('MONTH(tpc.fecha_entrega) as fecha'), 
						 DB::raw('YEAR(tpc.fecha_entrega) as fecha_year'),
						 DB::raw('MONTH(tpc.fecha_entrega) as fecha_mes'))
			 			->where(DB::raw('MONTH(tpc.fecha_entrega)'),'>=',$mes_r)
			 			->where(DB::raw('MONTH(tpc.fecha_entrega)'),'<=',$mes_final)
			 			->where(DB::raw('YEAR(tpc.fecha_entrega)'),'=',$year_r)
			 			->where('tpc.estado','=',3)
			 			->where('tpc.empresa_pedido','=',$empresa_r)
			 			->where('tpc.subempresa_pedido','=',$subempresa_r)
			 			->orderBy('tpc.id_remision', 'asc')
			 			->groupBy(DB::raw('MONTH(tpc.fecha_entrega)'))
			 			->paginate(100);
	 				}
	 			


	 			if(auth()->user()->superusuario==0){
	 				/*
	 			$pedidos_mensuales=DB::table('factura as f')
	 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
	 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
	 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
	 			->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 			->select('f.id_factura',DB::raw('sum(f.pago_total) as pago_total'),DB::raw('sum(f.noproductos) as noproductos'), 'tp.nombre as tipo_pago_id_tpago', DB::raw('MONTH(f.fecha) as fecha'), DB::raw('YEAR(f.fecha) as fecha_year'), DB::raw('MONTH(f.fecha) as fecha_mes'))
	 			->where(DB::raw('MONTH(f.fecha)'),'>=',$fecha_mes_inicial)
	 			->where(DB::raw('MONTH(f.fecha)'),'<=',$fecha_mes_final)
	 			->where(DB::raw('YEAR(f.fecha)'),'=',$fecha_year)
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('f.facturapaga','=',1)
		 		->where('f.anulacion','=',0)
	 			->orderBy('f.id_factura', 'asc')
	 			->groupBy(DB::raw('MONTH(f.fecha)'))
	 			->paginate(100);	
	 			*/
	 			}


	 			foreach ($pedidos_mensuales as $key => $value) {	

		 				switch ($pedidos_mensuales[$key]->fecha) {
		 					case '1':
		 						$pedidos_mensuales[$key]->fecha="Enero";
		 					break;

		 					case '2':
		 						$pedidos_mensuales[$key]->fecha="Febrero";
		 					break;

		 					case '3':
		 						$pedidos_mensuales[$key]->fecha="Marzo";
		 					break;

		 					case '4':
		 						$pedidos_mensuales[$key]->fecha="Abril";
		 					break;

		 					case '5':
		 						$pedidos_mensuales[$key]->fecha="Mayo";
		 					break;

		 					case '6':
		 						$pedidos_mensuales[$key]->fecha="Junio";
		 					break;

		 					case '7':
		 						$pedidos_mensuales[$key]->fecha="Julio";
		 					break;

		 					case '8':
		 						$pedidos_mensuales[$key]->fecha="Agosto";
		 					break;

		 					case '9':
		 						$pedidos_mensuales[$key]->fecha="Septiembre";
		 					break;

		 					case '10':
		 						$pedidos_mensuales[$key]->fecha="Octubre";
		 					break;

		 					case '11':
		 						$pedidos_mensuales[$key]->fecha="Noviembre";
		 					break;

		 					case '12':
		 						$pedidos_mensuales[$key]->fecha="Diciembre";
		 					break;
		 					
		 					default:
		 						$pedidos_mensuales[$key]->fecha="Ninguno";
		 					break;
		 				}
		 			}
		 			$mes_letra=$mes_r;
		 			switch ($mes_letra) {
		 					case '1':
		 						$mes_letra="Enero";
		 					break;

		 					case '2':
		 						$mes_letra="Febrero";
		 					break;

		 					case '3':
		 						$mes_letra="Marzo";
		 					break;

		 					case '4':
		 						$mes_letra="Abril";
		 					break;

		 					case '5':
		 						$mes_letra="Mayo";
		 					break;

		 					case '6':
		 						$mes_letra="Junio";
		 					break;

		 					case '7':
		 						$mes_letra="Julio";
		 					break;

		 					case '8':
		 						$mes_letra="Agosto";
		 					break;

		 					case '9':
		 						$mes_letra="Septiembre";
		 					break;

		 					case '10':
		 						$mes_letra="Octubre";
		 					break;

		 					case '11':
		 						$mes_letra="Noviembre";
		 					break;

		 					case '12':
		 						$mes_letra="Diciembre";
		 					break;
		 					
		 					default:
		 						$mes_letra="Ninguno";
		 					break;
		 				}
		 				$mes_final_letra=$mes_final;
		 			switch ($mes_final_letra) {
		 					case '1':
		 						$mes_final_letra="Enero";
		 					break;

		 					case '2':
		 						$mes_final_letra="Febrero";
		 					break;

		 					case '3':
		 						$mes_final_letra="Marzo";
		 					break;

		 					case '4':
		 						$mes_final_letra="Abril";
		 					break;

		 					case '5':
		 						$mes_final_letra="Mayo";
		 					break;

		 					case '6':
		 						$mes_final_letra="Junio";
		 					break;

		 					case '7':
		 						$mes_final_letra="Julio";
		 					break;

		 					case '8':
		 						$mes_final_letra="Agosto";
		 					break;

		 					case '9':
		 						$mes_final_letra="Septiembre";
		 					break;

		 					case '10':
		 						$mes_final_letra="Octubre";
		 					break;

		 					case '11':
		 						$mes_final_letra="Noviembre";
		 					break;

		 					case '12':
		 						$mes_final_letra="Diciembre";
		 					break;
		 					
		 					default:
		 						$mes_final_letra="Ninguno";
		 					break;
		 				}
		 			
	 			return view("almacen.reportes.ventas.graficam",["modulos"=>$modulos,"ventas"=>$pedidos_mensuales,"mes_inicial"=>$mes_r,"mes_final"=>$mes_final,"fecha_final"=>$fecha_mes_final, "year"=>$year_r,"mes_letra_"=>$mes_letra,"mes_final"=>$mes_final_letra]);
	 	}

	 
}


	 

