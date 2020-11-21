<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Empresa;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\EmpresaFormRequest;
use DB;

class EmpresaController extends Controller
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

				$empresas=DB::table('empresa as e')
				->join('empleado as u','e.empleado_id_empleado','=','u.id_empleado')
				->join('sede as s','e.sede_id_sede','=','s.id_sede')
				->select('e.id_empresa','e.nombre','e.descripcion','e.fecha_registro', 's.nombre_sede as sede_id_sede', 'u.nombre as empleado_id_empleado')
				->where('e.nombre','LIKE', '%'.$query.'%') 
				->orderBy('id_empresa', 'desc')
	 			->paginate(10);

				$empleados=DB::table('empleado')
				->orderBy('id_empleado', 'desc')->get();
				 
				$sedes=DB::table('sede')->get();
	 			
	 			return view('almacen.cliente.empresa.index',["empresas"=>$empresas,"empleados"=>$empleados,"searchText"=>$query, "modulos"=>$modulos,"sedes"=>$sedes]);
	 		}
	 	}

	 	public function create(){

	 	}

	 	public function store(EmpresaFormRequest $request){
	 		$Empresa = new Empresa;
	 		//$Empresa->id_Empresa=$request->get('id_Empresa');
	 		$Empresa->nombre=$request->get('nombre');
	 		$Empresa->descripcion=$request->get('descripcion');
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
			 
			 $empleados=DB::table('empleado')
				->orderBy('id_empleado', 'desc')->get();
				 
				$sedes=DB::table('sede')->get();

	 		return view("almacen.cliente.empresa.edit",["empresa"=>Empresa::findOrFail($id), "modulos"=>$modulos,"empleados"=>$empleados,"sedes"=>$sedes]);
	 	}

	 	public function update(EmpresaFormRequest $request, $id){
	 		$Empresa = Empresa::findOrFail($id);
	 		//$sede->id_sede=$request->get('id_sede');
	 		$Empresa->nombre=$request->get('nombre');
	 		$Empresa->descripcion=$request->get('descripcion');
	 		$Empresa->update();

	 		return back()->with('msj','Empresa actualizada');
	 	}

	 	public function destroy($id){
			$id=$id;
	 		$existeC=DB::table('cliente')
	 		->where('empresa_id_empresa','=',$id)
	 		->orderBy('id_cliente', 'desc')->get();

	 		$existeEC=DB::table('empresa_categoria')
	 		->where('empresa_id_empresa','=',$id)
	 		->orderBy('id_empresa_categoria', 'desc')->get();

	 		if(count($existeC)==0 && count($existeEC)==0){
	 		$Empresa=Empresa::findOrFail($id);
	 		$Empresa->delete();

	 		return back()->with('msj','Empresa eliminada');

	 		}else{
	 			return back()->with('errormsj','¡Empresa relacionada!');	 			
	 		}
	 	}

	 	
}
