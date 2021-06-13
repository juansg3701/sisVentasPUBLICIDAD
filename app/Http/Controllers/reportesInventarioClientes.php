<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\RInventarios;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RInventariosFormRequest;
use DB;

class reportesInventarioClientes extends Controller
{
	   public function __construct(){
			$this->middleware('auth');	

			 	} 
	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$query0=trim($request->get('searchText0'));

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
		 		

	 			return view('almacen.reportes.inventarioclientes.inventario',["sedes"=>$sedes,"searchText"=>$query, "modulos"=>$modulos, "empresas"=>$empresas, "subempresas"=>$subempresas,"searchText0"=>$query0]);
	 		}
	 	}

	 	public function show(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText0'));
	 			$fecha_inicial=trim($request->get('fecha_inicial'));
	 			$fecha_final=trim($request->get('fecha_final'));
	 			$tipo_reporte_detallado=trim($request->get('tipo_reporte_detallado'));
	 			$empresa_r=trim($request->get('empresa_r'));
	 			$subempresa_r=trim($request->get('subempresa_r'));

	 			$nombre_empresa=trim($request->get('nombre_empresa'));
	 			$nombre_subempresa=trim($request->get('nombre_subempresa'));



	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			//inicio

	 				 	if($subempresa_r==""){

	 					$pedidos_mensuales=DB::table('stock_clientes as s')
			 			->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
			 			->select('s.id_stock_clientes',
						 DB::raw('sum(s.cantidad) as noproductos'),
						 DB::raw('YEAR(s.fecha_registro) as fecha_year'),
						 DB::raw('MONTH(s.fecha_registro) as fecha_mes'),
						 's.nombre as producto')
			 			->where('s.fecha_registro','>=',$fecha_inicial)
			 			->where('s.fecha_registro','<=',$fecha_final)
			 			->where('s.empresa_id_empresa','=',$empresa_r)
			 			->orderBy(DB::raw('MONTH(s.fecha_registro)'), 'asc')
			 			->groupBy('s.id_stock_clientes')
			 			->get();

			 			$pedidos_mensuales_tabla=DB::table('stock_clientes as s')
			 			->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
			 			->select('s.id_stock_clientes',
						 DB::raw('sum(s.cantidad) as noproductos'),
						 DB::raw('YEAR(s.fecha_registro) as fecha_year'),
						 DB::raw('MONTH(s.fecha_registro) as fecha_mes'),
						 's.nombre as producto')
			 			->where('s.fecha_registro','>=',$fecha_inicial)
			 			->where('s.nombre','LIKE','%'.$query.'%')
			 			->where('s.fecha_registro','<=',$fecha_final)
			 			->where('s.empresa_id_empresa','=',$empresa_r)
			 			->orderBy(DB::raw('MONTH(s.fecha_registro)'), 'asc')
			 			->groupBy('s.id_stock_clientes')
			 			->get();


	 				}else{

	 					$n_subempresa=DB::table('empresa_categoria')
				 		->where('id_empresa_categoria','=',$subempresa_r)
				 		->where('empresa_id_empresa','=',$empresa_r)
				 		->orderBy('id_empresa_categoria', 'desc')->get();

				 		$nombre_subempresa=$n_subempresa[0]->nombre;
				 		$pedidos_mensuales=DB::table('stock_clientes as s')
			 			->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
			 			->select('s.id_stock_clientes',
						 DB::raw('sum(s.cantidad) as noproductos'),
						 DB::raw('YEAR(s.fecha_registro) as fecha_year'),
						 DB::raw('MONTH(s.fecha_registro) as fecha_mes'),
						 's.nombre as producto')
			 			->where('s.fecha_registro','>=',$fecha_inicial)
			 			->where('s.fecha_registro','<=',$fecha_final)
			 			->where('s.empresa_id_empresa','=',$empresa_r)
			 			->where('s.empresa_categoria_id','=',$subempresa_r)
			 			->orderBy(DB::raw('MONTH(s.fecha_registro)'), 'asc')
			 			->groupBy('s.id_stock_clientes')
			 			->get();

			 			$pedidos_mensuales_tabla=DB::table('stock_clientes as s')
			 			->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
			 			->select('s.id_stock_clientes',
						 DB::raw('sum(s.cantidad) as noproductos'),
						 DB::raw('YEAR(s.fecha_registro) as fecha_year'),
						 DB::raw('MONTH(s.fecha_registro) as fecha_mes'),
						 's.nombre as producto')
			 			->where('s.fecha_registro','>=',$fecha_inicial)
			 			->where('s.nombre','LIKE','%'.$query.'%')
			 			->where('s.fecha_registro','<=',$fecha_final)
			 			->where('s.empresa_id_empresa','=',$empresa_r)
			 			->where('s.empresa_categoria_id','=',$subempresa_r)
			 			->orderBy(DB::raw('MONTH(s.fecha_registro)'), 'asc')
			 			->groupBy('s.id_stock_clientes')
			 			->get();
	
	 				}
	 			
	 			//fin
		 		

	 		return view("almacen.reportes.inventarioclientes.graficad2",["modulos"=>$modulos,"pedidos_mensuales"=>$pedidos_mensuales,"fecha_inicial"=>$fecha_inicial,"fecha_final"=>$fecha_final,"tipo_reporte_detallado"=>$tipo_reporte_detallado,"searchText0"=>$query,"empresa_r"=>$empresa_r,"subempresa_r"=>$subempresa_r,"pedidos_mensuales_tabla"=>$pedidos_mensuales_tabla,"nombre_empresa"=>$nombre_empresa,'nombre_subempresa'=>$nombre_subempresa]);
	 		}
	 	}


	 	public function store(RInventariosFormRequest $request){
	 		$fechaInicialR=$request->get('fechaInicial');
	 		$fechaFinalR=$request->get('fechaFinal');

	 		if($fechaInicialR<=$fechaFinalR){
	 			$reporte = new RInventarios;
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

	 					$pedidos_mensuales=DB::table('stock_clientes as s')
			 			->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
			 			->select('s.id_stock_clientes',
						 DB::raw('sum(s.cantidad) as noproductos'), 
						 DB::raw('MONTH(s.fecha_registro) as fecha'), 
						 DB::raw('YEAR(s.fecha_registro) as fecha_year'),
						 DB::raw('MONTH(s.fecha_registro) as fecha_mes'))
			 			->where('s.fecha_registro','>=',$mes_r)
			 			->where('s.fecha_registro','<=',$mes_final)
			 			->where('s.empresa_id_empresa','=',$empresa_r)
			 			->orderBy('s.fecha_registro', 'asc')
			 			->groupBy(DB::raw('MONTH(s.fecha_registro)'))
			 			->get();
	 				}else{

	 					//dd($empresa_r.' '.$subempresa_r);
	 					$n_subempresa=DB::table('empresa_categoria')
				 		->where('id_empresa_categoria','=',$subempresa_r)
				 		->where('empresa_id_empresa','=',$empresa_r)
				 		->orderBy('id_empresa_categoria', 'desc')->get();

				 		$nombre_subempresa=$n_subempresa[0]->nombre;

	 					$pedidos_mensuales=DB::table('stock_clientes as s')
			 			->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
			 			->select('s.id_stock_clientes',
						 DB::raw('sum(s.cantidad) as noproductos'), 
						 DB::raw('MONTH(s.fecha_registro) as fecha'), 
						 DB::raw('YEAR(s.fecha_registro) as fecha_year'),
						 DB::raw('MONTH(s.fecha_registro) as fecha_mes'))
			 			->where('s.fecha_registro','>=',$mes_r)
			 			->where('s.fecha_registro','<=',$mes_final)
			 			->where('s.empresa_id_empresa','=',$empresa_r)
			 			->where('s.empresa_categoria_id','=',$subempresa_r)
			 			->orderBy('s.fecha_registro', 'asc')
			 			->groupBy(DB::raw('MONTH(s.fecha_registro)'))
			 			->get();
	 				}
	 				foreach ($pedidos_mensuales as $key => $value) {	
	 				$pedidos_mensuales[$key]->fecha=self::metodoMeses($pedidos_mensuales[$key]->fecha);
		 			}
		 			$mes_letra=self::metodoMeses($mes_r);
		 			$mes_final_letra= self::metodoMeses($mes_final);
		 				
		 			
	 			return view("almacen.reportes.inventarioclientes.graficam",["modulos"=>$modulos,"pedidos"=>$pedidos_mensuales,"mes_inicial"=>$mes_r,"mes_final"=>$mes_final,"mes_inicial_letra"=>$mes_letra,"mes_final_letra"=>$mes_final_letra,"nombre_empresa"=>$nombre_empresa,"nombre_subempresa"=>$nombre_subempresa]);
	 				}else{
	 					if($subempresa_r==""){

	 					$pedidos_mensuales=DB::table('stock_clientes as s')
			 			->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
			 			->select('s.id_stock_clientes',
						 DB::raw('sum(s.cantidad) as noproductos'),
						 DB::raw('YEAR(s.fecha_registro) as fecha_year'),
						 DB::raw('MONTH(s.fecha_registro) as fecha_mes'),
						 's.nombre as producto')
			 			->where('s.fecha_registro','>=',$mes_r)
			 			->where('s.fecha_registro','<=',$mes_final)
			 			->where('s.empresa_id_empresa','=',$empresa_r)
			 			->orderBy(DB::raw('MONTH(s.fecha_registro)'), 'asc')
			 			->groupBy('s.id_stock_clientes')
			 			->get();
	 				}else{
	 					$n_subempresa=DB::table('empresa_categoria')
				 		->where('id_empresa_categoria','=',$subempresa_r)
				 		->where('empresa_id_empresa','=',$empresa_r)
				 		->orderBy('id_empresa_categoria', 'desc')->get();

				 		$nombre_subempresa=$n_subempresa[0]->nombre;
				 		$pedidos_mensuales=DB::table('stock_clientes as s')
			 			->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
			 			->select('s.id_stock_clientes',
						 DB::raw('sum(s.cantidad) as noproductos'),
						 DB::raw('YEAR(s.fecha_registro) as fecha_year'),
						 DB::raw('MONTH(s.fecha_registro) as fecha_mes'),
						 's.nombre as producto')
			 			->where('s.fecha_registro','>=',$mes_r)
			 			->where('s.fecha_registro','<=',$mes_final)
			 			->where('s.empresa_id_empresa','=',$empresa_r)
			 			->where('s.empresa_categoria_id','=',$subempresa_r)
			 			->orderBy(DB::raw('MONTH(s.fecha_registro)'), 'asc')
			 			->groupBy('s.id_stock_clientes')
			 			->get();
	
	 				}
	 			
	 				$tipo_reporte_detallado="d";
	 				$pedidos_mensuales_tabla=$pedidos_mensuales;
	 				$query0="";

		 			return view("almacen.reportes.inventarioclientes.graficad2",["modulos"=>$modulos,"pedidos_mensuales"=>$pedidos_mensuales,"fecha_inicial"=>$mes_r,"fecha_final"=>$mes_final,"tipo_reporte_detallado"=>$tipo_reporte_detallado,"searchText0"=>$query0,"empresa_r"=>$empresa_r,"subempresa_r"=>$subempresa_r,"pedidos_mensuales_tabla"=>$pedidos_mensuales,"nombre_empresa"=>$nombre_empresa,'nombre_subempresa'=>$nombre_subempresa]);
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



	 	public function destroy($id){
	 		$reporte = RInventarios::findOrFail($id);
	 		$reporte->delete();
	 		return back()->with('msj','Reporte eliminado');
	 	}

	 
}
