<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\CategoriaStock;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\CategoriaStockFormRequest;
use DB;

class CategoriaStockController extends Controller
{
	    public function __construct(){
			$this->middleware('auth');	
		}

	 	public function index(Request $request){
	 		if ($request) {

				$query=trim($request->get('searchText'));
				$usuarios=DB::table('empleado')->get();
			 	$sedes=DB::table('sede')->get();
			 
				$categorias=DB::table('categoria_stock_especiales as c')
				->join('empleado as e','c.empleado_id_empleado','=','e.id_empleado')
				->join('sede as s','c.sede_id_sede','=','s.id_sede')
				->select('c.id_categoriaStock','c.nombre','c.descripcion','c.fecha','e.nombre as empleado_id_empleado','s.nombre_sede as sede_id_sede')
	 			->where('c.nombre','LIKE', '%'.$query.'%')
	 			->orderBy('c.id_categoriaStock', 'desc')
				->paginate(10);
				 
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			$catP=DB::table('categoria')->get();

	 			return view('almacen.inventario.categoriaStock.index',["categorias"=>$categorias,"searchText"=>$query, "modulos"=>$modulos,"catP"=>$catP,"usuarios"=>$usuarios,"sedes"=>$sedes]);
	 		}
	 	}

	 	public function create(){
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 		$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen.inventario.categoriaStock.index",["modulos"=>$modulos]);
	 	}

	 	public function store(CategoriaStockFormRequest $request){
	 		$categoria = new CategoriaStock();
	 		$categoria->nombre=$request->get('nombre');
			$categoria->descripcion=$request->get('descripcion');
			$categoria->fecha=$request->get('fecha');	
			$categoria->empleado_id_empleado=$request->get('empleado_id_empleado');
			$categoria->sede_id_sede=$request->get('sede_id_sede');
	 		$categoria->save();

	 		return back()->with('msj','Categoria guardada');
	 	}

	 	public function show($id){
	 		return view("almacen.inventario.categoriaStock.show",["categoria"=>CategoriaStock::findOrFail($id)]);
	 	}

	 	public function edit($id){
			$usuarios=DB::table('empleado')->get();
			$sedes=DB::table('sede')->get();

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 		$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
			->orderBy('id_cargo', 'desc')->get();
				 		
	 		return view("almacen.inventario.categoriaStock.edit",["categoria"=>CategoriaStock::findOrFail($id), "modulos"=>$modulos,"usuarios"=>$usuarios,"sedes"=>$sedes]);
	 	}

	 	public function update(CategoriaStockFormRequest $request, $id){
	 		$categoria = CategoriaStock::findOrFail($id);
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
	 		->where('empresa_categoria_id','=',$id)
	 		->orderBy('id_stock_clientes', 'desc')->get();

	 		if(count($existe)==0 && count($existeC)==0){
	 		$categoria=CategoriaStock::findOrFail($id);
	 		$categoria->delete();

	 		return back()->with('msj','Categoria eliminada');
	 		}else{	
	 			return back()->with('errormsj','¡Categoria relacionada!');
	 		}

	 		
	 	}

	 
}
