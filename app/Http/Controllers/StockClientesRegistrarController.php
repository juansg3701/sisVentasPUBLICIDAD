<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\StockClientes;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\StockClientesFormRequest;
use DB;

class StockClientesRegistrarController extends Controller
{
	   public function __construct(){
			$this->middleware('auth');	

			 	}
			 	
	 	public function index(Request $request){
	 		if ($request) {
	 		$query=trim($request->get('searchText'));
			$usuarios=DB::table('empleado')->get();
	 		$sedes=DB::table('sede')->get();
	 		$sede=DB::table('sede')->get();
			$empresas=DB::table('empresa')->get();
			$subempresas=DB::table('empresa_categoria')->get();
			$categoria=DB::table('categoria_stock_especiales')->get();
			
	 		$query=trim($request->get('searchText'));

	
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			$clientes=DB::table('cliente')->get();

	 		return view("almacen.inventario.eanClientes.index",["sede"=>$sede,"modulos"=>$modulos,"searchText"=>$query,"usuarios"=>$usuarios,"sedes"=>$sedes,"categoria"=>$categoria,"clientes"=>$clientes,"empresas"=>$empresas,"subempresas"=>$subempresas]);
	 	}
	 	}

	 	public function create(Request $request){
	 		if ($request) {
	 				$query=trim($request->get('searchText'));

	 		$sede=DB::table('sede')->get();
	 		$proveedor=DB::table('proveedor')->get();
	 		$producto=DB::table('producto')->get();
	 			$query=trim($request->get('searchText'));
			$pEAN=DB::table('producto')
			->where('ean','=',$query)
			->get();
	 			
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			

	 		return view("almacen.inventario.proveedor-sede.registrar.registrar",["sede"=>$sede,"proveedor"=>$proveedor,"producto"=>$producto, "modulos"=>$modulos,  "pEAN"=>$pEAN,"searchText"=>$query]);
	 	}
	 	}

		 
	 	public function store(StockClientesFormRequest $request){
			$ps = new StockClientes;
			$ps->producto_id_producto=$request->get('producto_id_producto');
			$ps->sede_id_sede=$request->get('sede_id_sede');
		    $ps->proveedor_id_proveedor=$request->get('proveedor_id_proveedor');
		    $ps->categoria_id_categoria=$request->get('categoria_id_categoria');
		    $ps->cantidad=$request->get('cantidad');
		    $ps->fecha_vencimiento=$request->get('fecha_vencimiento');
		    $ps->fecha_registro=$request->get('fecha_registro');
		    $ps->empleado_id_empleado=$request->get('empleado_id_empleado');
		    $ps->tipo_stock_id=$request->get('tipo_stock_id');
		    if($request->get('producto_dados_baja')==1){
			   $ps->producto_dados_baja=0;
		    }	
		    else{
			   $ps->producto_dados_baja=1;
		    }
			$ps->save();

			return back()->with('msj','Producto guardado');
		}



	 	public function show($id){
	 		
	 	}

}