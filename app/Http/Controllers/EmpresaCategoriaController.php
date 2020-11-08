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
	 			->select('ec.id_empresa_categoria','ec.nombre','ec.descripcion','e.nombre as nombreEmpresa','e.descripcion as descripcionEmpresa')
	 			->orderBy('id_empresa_categoria', 'desc')
	 			->paginate(10);

	 			$empresas=DB::table('empresa')
	 			->orderBy('id_empresa', 'desc')
	 			->paginate(10);

	 			return view('almacen.cliente.empresaCategoria.index',["empresas"=>$empresas,"empresaCategoria"=>$empresaCategoria,"searchText"=>$query, "modulos"=>$modulos]);
	 		}
	 	}

	 	public function create(){

	 	}

	 	public function store(EmpresaCategoriaFormRequest $request){
	 		$Empresa = new EmpresaCategoria;
	 		$Empresa->nombre=$request->get('nombre');
	 		$Empresa->descripcion=$request->get('descripcion');
	 		$Empresa->empresa_id_empresa=$request->get('empresa_id_empresa');
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
	 			
	 		return view("almacen.cliente.empresaCategoria.edit",["empresa"=>EmpresaCategoria::findOrFail($id), "modulos"=>$modulos,"empresas"=>$empresas]);
	 	}

	 	public function update(EmpresaCategoriaFormRequest $request, $id){
	 		$Empresa = EmpresaCategoria::findOrFail($id);
	 		$Empresa->nombre=$request->get('nombre');
	 		$Empresa->descripcion=$request->get('descripcion');
	 		$Empresa->empresa_id_empresa=$request->get('empresa_id_empresa');
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
