<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\SedeFormRequest;
use DB;

class SedeController extends Controller
{
	    public function __construct(){
			$this->middleware('auth');	
		}
		
		
	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			/*$sedes=DB::table('sede')
	 			->where('nombre_sede','LIKE', '%'.$query.'%')
	 			->orderBy('id_sede', 'desc')
				->paginate(7);*/
				 
				$sedes=DB::table('sede as s')
				->join('empleado as u','s.empleado_id_empleado','=','u.id_empleado')
				->join('tipo_sede as ts','s.tipo_sede_id_tipo_sede','=','ts.id_tipo_sede')
				->select('s.id_sede','s.nombre_sede','s.ciudad','s.descripcion','s.direccion','s.telefono','u.nombre as empleado_id_empleado','s.fecha', 'ts.nombre as tipo_sede_id_tipo_sede')
				->where('s.nombre_sede','LIKE', '%'.$query.'%')
				->orderBy('s.id_sede', 'desc')
				->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$sedesP=DB::table('sede')->get();

	 			$tipos=DB::table('tipo_sede')
	 			->orderBy('id_tipo_sede', 'desc')->get();

	 			$empleados=DB::table('empleado')
	 			->orderBy('id_empleado', 'desc')->get();

	 			
	 			return view('almacen.sede.index',["sedes"=>$sedes,"searchText"=>$query, "modulos"=>$modulos,"sedesP"=>$sedesP,"tipos"=>$tipos,"empleados"=>$empleados]);
	 		}
	 	}

	 	public function create(){
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$tipos=DB::table('tipo_sede')
	 			->orderBy('id_tipo_sede', 'desc')->get();

	 			$empleados=DB::table('empleado')
	 			->orderBy('id_empleado', 'desc')->get();

	 			
	 		return view("almacen.sede.registrar", ["modulos"=>$modulos,"tipos"=>$tipos,"empleados"=>$empleados]);
	 	}

	 	public function store(SedeFormRequest $request){
	 		$sede = new Sede;
	 		//$sede->id_sede=$request->get('id_sede');
	 		$sede->nombre_sede=$request->get('nombre_sede');
	 		$sede->ciudad=$request->get('ciudad');
	 		$sede->descripcion=$request->get('descripcion');
	 		$sede->direccion=$request->get('direccion');
	 		$sede->telefono=$request->get('telefono');
	 		$sede->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$sede->fecha=$request->get('fecha');
	 		$sede->tipo_sede_id_tipo_sede=$request->get('tipo_sede_id_tipo_sede');
	 		$sede->save();

	 		return back()->with('msj','Sede guardada');
	 	}

	 	public function show($id){
	 		return view("almacen.sede.show",["sede"=>Sede::findOrFail($id)]);
	 	}

	 	public function edit($id){

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$tipos=DB::table('tipo_sede')
	 			->orderBy('id_tipo_sede', 'desc')->get();

	 			$empleados=DB::table('empleado')
	 			->orderBy('id_empleado', 'desc')->get();

	 			
	 		return view("almacen.sede.edit",["sede"=>Sede::findOrFail($id), "modulos"=>$modulos,"tipos"=>$tipos,"empleados"=>$empleados]);
	 	}

	 	public function update(SedeFormRequest $request, $id){
	 		$sede = Sede::findOrFail($id);
	 		//$sede->id_sede=$request->get('id_sede');
	 		$sede->nombre_sede=$request->get('nombre_sede');
	 		$sede->ciudad=$request->get('ciudad');
	 		$sede->descripcion=$request->get('descripcion');
	 		$sede->direccion=$request->get('direccion');
	 		$sede->telefono=$request->get('telefono');
	 		$sede->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$sede->fecha=$request->get('fecha');
	 		$sede->tipo_sede_id_tipo_sede=$request->get('tipo_sede_id_tipo_sede');
	 		$sede->update();

	 		return back()->with('msj','Sede actualizada');
	 	}

	 	public function destroy($id){
			$id=$id;


	 		$existeCI=DB::table('c_inventario')
	 		->where('sede_id_sede','=',$id)
	 		->orderBy('id_corte', 'desc')->get();


	 		$existeE=DB::table('empleado')
	 		->where('sede_id_sede','=',$id)
	 		->orderBy('id_empleado', 'desc')->get();

	 		$existeM=DB::table('m_stock')
	 		->where('sede_id_sede','=',$id)
	 		->orderBy('id_mstock', 'desc')->get();

	 		$existeS=DB::table('stock')
	 		->where('sede_id_sede','=',$id)
	 		->orderBy('id_stock', 'desc')->get();

	 		$existeSC=DB::table('stock_clientes')
	 		->where('sede_id_sede_cliente','=',$id)
	 		->orderBy('id_stock_clientes', 'desc')->get();
	 		
	 		$existeSC2=DB::table('stock_clientes')
	 		->where('sede_id_sede','=',$id)
	 		->orderBy('id_stock_clientes', 'desc')->get();

	 		$existeU=DB::table('users')
	 		->where('sede_id_sede','=',$id)
	 		->orderBy('id', 'desc')->get();

	 		if(count($existeCI)==0 && count($existeE)==0 && count($existeM)==0 && count($existeS)==0 && count($existeU)==0 && count($existeSC)==0 && count($existeSC2)==0){
	 		$sede=Sede::findOrFail($id);
	 		$sede->delete();

	 		return back()->with('msj','Sede eliminada');

	 		}else{
	 			return back()->with('errormsj','¡Sede relacionada!');	 			
	 		}
	 	}

	 	
}
