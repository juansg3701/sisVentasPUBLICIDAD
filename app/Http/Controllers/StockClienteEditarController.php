<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\StockClientes;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\StockClienteFormRequest;
use DB;

class StockClienteEditarController extends Controller
{
	   public function __construct(){
			$this->middleware('auth');	

			 	}
			 	
	 	public function index(Request $request){
	 		if ($request) {
	 		$id=$request->get('id');
	 		$query=trim($request->get('searchText'));
	 		$sede=DB::table('sede')->get();
			$usuarios=DB::table('empleado')->get();
			$sedes=DB::table('sede')->get();
			$categoria=DB::table('categoria')->get();
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 		$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();

	 		$empresas=DB::table('empresa')->get();
			if($query!=""){
			$subempresas=DB::table('empresa_categoria')
			->where('empresa_id_empresa','=',$query)
			->orderBy('id_empresa_categoria','desc')
			->get();
			}else{
				$subempresas=[];

			}

			$subempresasGeneral=DB::table('empresa_categoria')->get();
			$categoria_especiales=DB::table('categoria_stock_especiales')->get();
	 			

	 		return view("almacen.inventario.stockclientes.edit",["categoria"=>$categoria, "sede"=>$sede,"stock"=>StockClientes::findOrFail($id),"modulos"=>$modulos,"usuarios"=>$usuarios,"sedes"=>$sedes,"empresas"=>$empresas,"subempresas"=>$subempresas,"categoria_especiales"=>$categoria_especiales,"searchText"=>$query,"subempresasGeneral"=>$subempresasGeneral]);
	 		}
	 	}

	 	public function create(Request $request){

	 	
	 	}
	 	public function update(Request $request,$id){
	 		
	 			
	 	
	 	}

		 
	 	public function store(StockClienteFormRequest $request){
	 		

			
		}



	 	public function show($id){
	 		
	 	}

}