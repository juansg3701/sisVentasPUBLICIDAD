<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\EmpresaCategoria;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\EmpresaCategoriaFormRequest;
use DB;

class EmpresaCategoriaController extends Controller
{
	  public function __construct(){
			$this->middleware('auth');	

			 	} 
	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$empresaCategoria=DB::table('empresa_categoria as ec')
				->join('empresa as e','ec.empresa_id_empresa','=','e.id_empresa')
				->join('empleado as u','ec.empleado_id_empleado','=','u.id_empleado')
				->join('sede as s','ec.sede_id_sede','=','s.id_sede')
	 			->select('ec.id_empresa_categoria','ec.nombre','ec.descripcion','e.nombre as nombreEmpresa','e.descripcion as descripcionEmpresa','ec.fecha_registro', 's.nombre_sede as sede_id_sede', 'u.nombre as empleado_id_empleado')
				->where('ec.nombre','LIKE', '%'.$query.'%')  
				->orderBy('id_empresa_categoria', 'desc')
				->paginate(10);
				 
				 /*$empresas=DB::table('empresa as e')
				 ->join('empleado as u','e.empleado_id_empleado','=','u.id_empleado')
				 ->join('sede as s','e.sede_id_sede','=','s.id_sede')
				 ->select('e.id_empresa','e.nombre','e.descripcion','e.fecha_registro', 's.nombre_sede as sede_id_sede', 'u.nombre as empleado_id_empleado')
				 ->where('e.nombre','LIKE', '%'.$query.'%') 
				 ->orderBy('id_empresa', 'desc')
				  ->paginate(10);*/

	 			$empresas=DB::table('empresa')
	 			->orderBy('id_empresa', 'desc')
	 			->paginate(10);

				$empleados=DB::table('empleado')
				 ->orderBy('id_empleado', 'desc')->get();
				  
				$sedes=DB::table('sede')->get();

	 			return view('almacen.cliente.empresaCategoria.index',["empresas"=>$empresas,"empresaCategoria"=>$empresaCategoria,"searchText"=>$query, "modulos"=>$modulos,"empleados"=>$empleados,"sedes"=>$sedes]);
	 		}
	 	}

	 	public function create(){

	 	}

	 	public function store(EmpresaCategoriaFormRequest $request){
	 		$Empresa = new EmpresaCategoria;
	 		$Empresa->nombre=$request->get('nombre');
	 		$Empresa->descripcion=$request->get('descripcion');
			$Empresa->empresa_id_empresa=$request->get('empresa_id_empresa');
			$Empresa->fecha_registro=$request->get('fecha_registro');
			$Empresa->empleado_id_empleado=$request->get('empleado_id_empleado');
			$Empresa->sede_id_sede=$request->get('sede_id_sede');
	 		$Empresa->save();

	 		return back()->with('msj','Empresa guardada');
	 	}

	 	public function show($id){
	 		return view("almacen.sede.show",["sede"=>Sede::findOrFail($id)]);
	 	}

	 	public function edit($id){

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$empresas=DB::table('empresa')
	 			->orderBy('id_empresa', 'desc')
				 ->paginate(10);
				 
			$empleados=DB::table('empleado')
			->orderBy('id_empleado', 'desc')->get();
				  
			$sedes=DB::table('sede')->get();

	 		return view("almacen.cliente.empresaCategoria.edit",["empresa"=>EmpresaCategoria::findOrFail($id), "modulos"=>$modulos,"empresas"=>$empresas,"empleados"=>$empleados,"sedes"=>$sedes]);
	 	}

	 	public function update(EmpresaCategoriaFormRequest $request, $id){
	 		$Empresa = EmpresaCategoria::findOrFail($id);
	 		$Empresa->nombre=$request->get('nombre');
	 		$Empresa->descripcion=$request->get('descripcion');
			$Empresa->empresa_id_empresa=$request->get('empresa_id_empresa');
			$Empresa->fecha_registro=$request->get('fecha_registro');
			$Empresa->empleado_id_empleado=$request->get('empleado_id_empleado');
			$Empresa->sede_id_sede=$request->get('sede_id_sede');
	 		$Empresa->update();

	 		return back()->with('msj','Empresa actualizada');
	 	}

	 	public function destroy($id){
			$id=$id;

	 		$existeC=DB::table('cliente')
	 		->where('empresa_categoria_id','=',$id)
	 		->orderBy('id_cliente', 'desc')->get();

	 		if(count($existeC)==0){
	 		$Empresa=EmpresaCategoria::findOrFail($id);
	 		$Empresa->delete();

	 		return back()->with('msj','Empresa eliminada');

	 		}else{
	 			return back()->with('errormsj','¡Empresa relacionada!');	 			
	 		}
	 	}

	 	
}
