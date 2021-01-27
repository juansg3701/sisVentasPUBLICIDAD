<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Categoria;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\CategoriaFormRequest;
use DB;

class CategoriaProducto extends Controller
{
	    public function __construct(){
			$this->middleware('auth');	
		}

	 	public function index(Request $request){
	 		if ($request) {

				$query=trim($request->get('searchText'));
				$usuarios=DB::table('empleado')->get();
			 	$sedes=DB::table('sede')->get();
			 
				$categorias=DB::table('categoria as c')
				->join('empleado as e','c.empleado_id_empleado','=','e.id_empleado')
				->join('sede as s','c.sede_id_sede','=','s.id_sede')
				->select('c.id_categoria','c.nombre','c.descripcion','c.fecha','e.nombre as empleado_id_empleado','s.nombre_sede as sede_id_sede')
	 			->where('c.nombre','LIKE', '%'.$query.'%')
	 			->orderBy('c.id_categoria', 'desc')
				->paginate(10);
				 
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			$catP=DB::table('categoria')->get();

	 			return view('almacen.inventario.producto-sede.categoriaProducto.index',["categorias"=>$categorias,"searchText"=>$query, "modulos"=>$modulos,"catP"=>$catP,"usuarios"=>$usuarios,"sedes"=>$sedes]);
	 		}
	 	}

	 	public function create(){
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 		$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen.inventario.producto-sede.categoriaProducto.index",["modulos"=>$modulos]);
	 	}

	 	public function store(CategoriaFormRequest $request){
	 		$categoria = new Categoria;
	 		$categoria->nombre=$request->get('nombre');
			$categoria->descripcion=$request->get('descripcion');
			$categoria->fecha=$request->get('fecha');	
			$categoria->empleado_id_empleado=$request->get('empleado_id_empleado');
			$categoria->sede_id_sede=$request->get('sede_id_sede');
	 		$categoria->save();

	 		return back()->with('msj','Categoria guardada');
	 	}

	 	public function show($id){
	 		return view("almacen.inventario.producto-sede.categoriaProducto.show",["categoria"=>Categoria::findOrFail($id)]);
	 	}

	 	public function edit($id){
			$usuarios=DB::table('empleado')->get();
			$sedes=DB::table('sede')->get();

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 		$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
			->orderBy('id_cargo', 'desc')->get();
				 		
	 		return view("almacen.inventario.producto-sede.categoriaProducto.edit",["categoria"=>Categoria::findOrFail($id), "modulos"=>$modulos,"usuarios"=>$usuarios,"sedes"=>$sedes]);
	 	}

	 	public function update(CategoriaFormRequest $request, $id){
	 		$categoria = Categoria::findOrFail($id);
	 		$categoria->nombre=$request->get('nombre');
			$categoria->descripcion=$request->get('descripcion');
			$categoria->fecha=$request->get('fecha');	
			$categoria->empleado_id_empleado=$request->get('empleado_id_empleado'); 
			$categoria->sede_id_sede=$request->get('sede_id_sede');
	 		$categoria->update();

	 		return back()->with('msj','Categoria actualizada');
	 	}

	 	public function destroy($id){
	 		$id=$id;

	 		$existe=DB::table('producto')
	 		->where('categoria_id_categoria','=',$id)
	 		->orderBy('id_producto', 'desc')->get();

	 			$existeC=DB::table('stock_clientes')
	 		->where('categoria_id_categoria','=',$id)
	 		->orderBy('id_stock_clientes', 'desc')->get();

	 		if(count($existe)==0 && count($existeC)==0){
	 		$categoria=Categoria::findOrFail($id);
	 		$categoria->delete();

	 		return back()->with('msj','Categoria eliminada');
	 		}else{	
	 			return back()->with('errormsj','¡Categoria relacionada!');
	 		}

	 		
	 	}

	 
}
