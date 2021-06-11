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

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 		$empresa_r=$request->get('empresa');
	 		$subempresa_r=$request->get('subempresa');
	 		$mes_r=$request->get('mes');
	 		$mes_final=$request->get('mes_final');
	 		$tipo_reporte=$request->get('tipo_reporte');

	 		$nombre_empresa="";
	 		$nombre_subempresa="";

	 		$n_empresa=DB::table('empresa')
	 		->where('id_empresa','=',$empresa_r)
	 		->orderBy('id_empresa', 'desc')->get();	

	 		 $nombre_empresa=$n_empresa[0]->nombre;	

	 			if($empresa_r=="" || $mes_r=="" || $mes_final==""){
	 				return back()->with('errormsj','¡¡Los datos deben estar completos!!');
	 			}else{
	 				if($tipo_reporte==1){
	 					if($subempresa_r==""){

	 					$pedidos_mensuales=DB::table('t_p_cliente as tpc')
			 			->join('sede as sed','tpc.sede_id_sede','=','sed.id_sede')
			 			->select('tpc.id_remision',
						 DB::raw('sum(tpc.noproductos) as noproductos'), 
						 DB::raw('MONTH(tpc.fecha_entrega) as fecha'), 
						 DB::raw('YEAR(tpc.fecha_entrega) as fecha_year'),
						 DB::raw('MONTH(tpc.fecha_entrega) as fecha_mes'))
			 			->where('tpc.fecha_entrega','>=',$mes_r)
			 			->where('tpc.fecha_entrega','<=',$mes_final)
			 			->where('tpc.estado','=',3)
			 			->where('tpc.empresa_pedido','=',$empresa_r)
			 			->orderBy('tpc.fecha_entrega', 'asc')
			 			->groupBy(DB::raw('MONTH(tpc.fecha_entrega)'))
			 			->get();
	 				}else{

	 					//dd($empresa_r.' '.$subempresa_r);
	 					$n_subempresa=DB::table('empresa_categoria')
				 		->where('id_empresa_categoria','=',$subempresa_r)
				 		->where('empresa_id_empresa','=',$empresa_r)
				 		->orderBy('id_empresa_categoria', 'desc')->get();

				 		$nombre_subempresa=$n_subempresa[0]->nombre;

	 					$pedidos_mensuales=DB::table('t_p_cliente as tpc')
			 			->join('sede as sed','tpc.sede_id_sede','=','sed.id_sede')
			 			->select('tpc.id_remision',
						 DB::raw('sum(tpc.noproductos) as noproductos'), 
						 DB::raw('MONTH(tpc.fecha_entrega) as fecha'), 
						 DB::raw('YEAR(tpc.fecha_entrega) as fecha_year'),
						 DB::raw('MONTH(tpc.fecha_entrega) as fecha_mes'))
			 			->where('tpc.fecha_entrega','>=',$mes_r)
			 			->where('tpc.fecha_entrega','<=',$mes_final)
			 			->where('tpc.estado','=',3)
			 			->where('tpc.empresa_pedido','=',$empresa_r)
			 			->where('tpc.subempresa_pedido','=',$subempresa_r)
			 			->orderBy('tpc.fecha_entrega', 'asc')
			 			->groupBy(DB::raw('MONTH(tpc.fecha_entrega)'))
			 			->get();
	 				}
	 				foreach ($pedidos_mensuales as $key => $value) {	
	 				$pedidos_mensuales[$key]->fecha=self::metodoMeses($pedidos_mensuales[$key]->fecha);
		 			}
		 			$mes_letra=self::metodoMeses($mes_r);
		 			$mes_final_letra= self::metodoMeses($mes_final);
		 				
		 			
	 			return view("almacen.reportes.pedidos.graficam",["modulos"=>$modulos,"pedidos"=>$pedidos_mensuales,"mes_inicial"=>$mes_r,"mes_final"=>$mes_final,"mes_inicial_letra"=>$mes_letra,"mes_final_letra"=>$mes_final_letra,"nombre_empresa"=>$nombre_empresa,"nombre_subempresa"=>$nombre_subempresa]);
	 				}else{
	 					if($subempresa_r==""){

	 					$pedidos_mensuales=DB::table('t_p_cliente as tpc')
			 			->join('sede as sed','tpc.sede_id_sede','=','sed.id_sede')
			 			->join('d_p_cliente as dpc','tpc.id_remision','=','dpc.t_p_cliente_id_remision')
			 			->join('stock_clientes as sc','dpc.producto_id_producto','=','sc.id_stock_clientes')
			 			->select('tpc.id_remision',
						 DB::raw('sum(dpc.cantidad) as noproductos'),
						 DB::raw('YEAR(tpc.fecha_entrega) as fecha_year'),
						 DB::raw('MONTH(tpc.fecha_entrega) as fecha_mes'),
						 'sc.nombre as producto')
			 			->where('tpc.fecha_entrega','>=',$mes_r)
			 			->where('tpc.fecha_entrega','<=',$mes_final)
			 			->where('tpc.estado','=',3)
			 			->where('tpc.empresa_pedido','=',$empresa_r)
			 			->orderBy(DB::raw('MONTH(tpc.fecha_entrega)'), 'asc')
			 			->groupBy('dpc.producto_id_producto')
			 			->get();
	 				}else{

	 					//dd($empresa_r.' '.$subempresa_r);
	 					$n_subempresa=DB::table('empresa_categoria')
				 		->where('id_empresa_categoria','=',$subempresa_r)
				 		->where('empresa_id_empresa','=',$empresa_r)
				 		->orderBy('id_empresa_categoria', 'desc')->get();

				 		$nombre_subempresa=$n_subempresa[0]->nombre;
				 		$pedidos_mensuales=DB::table('t_p_cliente as tpc')
			 			->join('sede as sed','tpc.sede_id_sede','=','sed.id_sede')
			 			->join('d_p_cliente as dpc','tpc.id_remision','=','dpc.t_p_cliente_id_remision')
			 			->join('stock_clientes as sc','dpc.producto_id_producto','=','sc.id_stock_clientes')
			 			->select('tpc.id_remision',
						 DB::raw('sum(dpc.cantidad) as noproductos'),
						 DB::raw('YEAR(tpc.fecha_entrega) as fecha_year'),
						 DB::raw('MONTH(tpc.fecha_entrega) as fecha_mes'),
						 'sc.nombre as producto')
			 			->where('tpc.fecha_entrega','>=',$mes_r)
			 			->where('tpc.fecha_entrega','<=',$mes_final)
			 			->where('tpc.estado','=',3)
			 			->where('tpc.empresa_pedido','=',$empresa_r)
			 			->where('tpc.subempresa_pedido','=',$subempresa_r)
			 			->orderBy(DB::raw('MONTH(tpc.fecha_entrega)'), 'asc')
			 			->groupBy('dpc.producto_id_producto')
			 			->get();
	
	 				}
	 			
	 				$tipo_reporte_detallado="d";
		 		
		 			return view("almacen.reportes.pedidos.graficad2",["modulos"=>$modulos,"pedidos_mensuales"=>$pedidos_mensuales,"fecha_inicial"=>$mes_r,"fecha_final"=>$mes_final,"tipo_reporte_detallado"=>$tipo_reporte_detallado]);


	 				}
	 				
	 	}
	 }

	 public function metodoMeses($valor_mes){
	 	switch ($valor_mes) {
 					case '1':
 						$valor_mes="Enero";
 					break;

 					case '2':
 						$valor_mes="Febrero";
 					break;

 					case '3':
 						$valor_mes="Marzo";
 					break;

 					case '4':
 						$valor_mes="Abril";
 					break;

 					case '5':
 						$valor_mes="Mayo";
 					break;

 					case '6':
 						$valor_mes="Junio";
 					break;

 					case '7':
 						$valor_mes="Julio";
 					break;

 					case '8':
 						$valor_mes="Agosto";
 					break;

 					case '9':
 						$valor_mes="Septiembre";
 					break;

 					case '10':
 						$valor_mes="Octubre";
 					break;

 					case '11':
 						$valor_mes="Noviembre";
 					break;

 					case '12':
 						$valor_mes="Diciembre";
 					break;
 					
 					default:
 						$valor_mes="Ninguno";
 					break;
		 				}
		 return $valor_mes;
	 }

	 
}


	 

