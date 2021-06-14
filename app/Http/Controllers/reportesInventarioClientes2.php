<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\RInventarios2;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RInventarios2FormRequest;
use DB;

class reportesInventarioClientes2 extends Controller
{
	   	public function __construct(){
			$this->middleware('auth');	
		} 
	 public function index(Request $request){
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


	 	public function show(){

	 	}

	 
}
