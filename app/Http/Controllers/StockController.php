<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Stock;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\StockFormRequest;
use DB;

class StockController extends Controller
{
	  	public function __construct(){
			$this->middleware('auth');	
		} 
	 	public function index(Request $request){
	 	if ($request) {

	 			$query0=trim($request->get('searchText0'));
	 			$query1=trim($request->get('searchText1'));
	 			$query2=trim($request->get('searchText2'));
				$query3=trim($request->get('searchText3'));
				$query4=trim($request->get('searchText4'));

				$usuarios=DB::table('empleado')->get();
				$sedes=DB::table('sede')->get();
				$categoria=DB::table('categoria_stock_especiales')->get();
				 
	 			$productosP=DB::table('stock')
				->orderBy('id_stock', 'desc')->get();

				foreach ($productosP as $p) {

	 			$stock=Stock::findOrFail($p->id_stock);
	 			$fecha=$p->fecha_vencimiento;
				$b=strtotime($fecha);
				$fechaA=getdate();

				if($fecha!="0000-00-00"){

				if(date("y",$b)==date("y")){
					if(date("m",$b)==date("m")){
						if(date("d",$b)==date("d")){
							$stock->producto_dados_baja=0;
						}
						if(date("d",$b)<date("d")){
							$stock->producto_dados_baja=1;
						}
						if(date("d",$b)>date("d")){
							$stock->producto_dados_baja=0;
						}	
					}
					if(date("m",$b)<date("m")){
						$stock->producto_dados_baja=1;
					}
					if(date("m",$b)>date("m")){
						$stock->producto_dados_baja=0;
					}	
				}
				if(date("y",$b)<date("y")){
					$stock->producto_dados_baja=1;
				}
				if(date("y",$b)>date("y")){
					$stock->producto_dados_baja=0;
				}
			}else{
			    $stock->producto_dados_baja=0;
			}
						$stock->update();	
	 			}
				 

				 if($query4=="Todas las categorías"){
					$productos=DB::table('stock as s')
					->join('producto as p','s.producto_id_producto','=','p.id_producto')
					->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
					->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
					->join('categoria_stock_especiales as c','s.categoria_id_categoria','=','c.id_categoriaStock')
					->join('tipo_stock_unoa as tp','s.tipo_stock_id','=','tp.id_stock_unoa')
					->join('proveedor as pd','s.proveedor_id_proveedor','=','pd.id_proveedor')
					->select('s.id_stock','p.nombre','p.plu','p.ean','sed.nombre_sede','pd.nombre_proveedor','c.nombre as categoria_id_categoria','s.cantidad','s.sede_id_sede as sede_id_sede','s.producto_dados_baja','s.fecha_vencimiento', 's.fecha_registro', 'e.nombre as empleado_id_empleado', 'p.imagen as img','tp.nombre as tipo_stock_id')
					->where('p.nombre','LIKE', '%'.$query0.'%')
					->where('p.plu','LIKE', '%'.$query1.'%')
					->where('sed.nombre_sede','LIKE', '%'.$query2.'%')
					->where('pd.nombre_proveedor','LIKE', '%'.$query3.'%')
					->where('s.producto_dados_baja','=', 0)
					->orderBy('s.id_stock', 'desc')
					->paginate(100);
				}else{

					$productos=DB::table('stock as s')
					->join('producto as p','s.producto_id_producto','=','p.id_producto')
					->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
					->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
					->join('categoria_stock_especiales as c','s.categoria_id_categoria','=','c.id_categoriaStock')
					->join('tipo_stock_unoa as tp','s.tipo_stock_id','=','tp.id_stock_unoa')
					->join('proveedor as pd','s.proveedor_id_proveedor','=','pd.id_proveedor')
					->select('s.id_stock','p.nombre','p.plu','p.ean','sed.nombre_sede','pd.nombre_proveedor','c.nombre as categoria_id_categoria','s.cantidad','s.sede_id_sede as sede_id_sede','s.producto_dados_baja','s.fecha_vencimiento', 's.fecha_registro', 'e.nombre as empleado_id_empleado', 'p.imagen as img','tp.nombre as tipo_stock_id')
					->where('p.nombre','LIKE', '%'.$query0.'%')
					->where('p.plu','LIKE', '%'.$query1.'%')
					->where('sed.nombre_sede','LIKE', '%'.$query2.'%')
					->where('pd.nombre_proveedor','LIKE', '%'.$query3.'%')
					->where('c.nombre','LIKE', '%'.$query4.'%')
					->where('s.producto_dados_baja','=', 0)
					->orderBy('s.id_stock', 'desc')
					->paginate(100);
				}
				

				$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$eanP=DB::table('producto')
	 			->orderBy('id_producto', 'desc')->get();

	 			$sedesP=DB::table('sede')->get();
	 			$proveedoresP=DB::table('proveedor')->get();
	 			$clientes=DB::table('cliente')->get();

	 			return view('almacen.inventario.stock.index',["categoria"=>$categoria,"productos"=>$productos,"searchText0"=>$query0,"searchText1"=>$query1,"searchText2"=>$query2,"searchText3"=>$query3,"searchText4"=>$query4,"modulos"=>$modulos,"eanP"=>$eanP,"sedesP"=>$sedesP,"proveedoresP"=>$proveedoresP,"usuarios"=>$usuarios,"sedes"=>$sedes,"clientes"=>$clientes]);
	 		}
	 	}


	 	public function create(Request $request){
	 		if ($request) {
	 		$query=trim($request->get('searchText'));
			$usuarios=DB::table('empleado')->get();
	 		$sede=DB::table('sede')->get();
	 		$proveedor=DB::table('proveedor')->get();
	 		$producto=DB::table('producto')->get();
	 		$clientes=DB::table('cliente')->get();

	 			$pEAN=DB::table('producto')
				->where('ean','=',$query)
				->get();
	 	
	 			
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen.inventario.proveedor-sede.registrar",["sede"=>$sede,"proveedor"=>$proveedor,"producto"=>$producto, "modulos"=>$modulos,  "pEAN"=>$pEAN,"searchText"=>$query, "usuarios"=>$usuarios,"clientes"=>$clientes]);
	 		}
	 	}

	 	public function store(StockFormRequest $request){
	 		
	 	}

	 	public function show($id){
	 	
	 	}

	 	public function edit($id){
	 		$sede=DB::table('sede')->get();
	 		$proveedor=DB::table('proveedor')->get();
			$producto=DB::table('producto')->get();
			$usuarios=DB::table('empleado')->get();
			$sedes=DB::table('sede')->get();
			$categoria=DB::table('categoria_stock_especiales')->get();
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 		$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();
	 		$clientes=DB::table('cliente')->get();
	 		$tipos=DB::table('tipo_stock_unoa')->get();
	 			

	 		return view("almacen.inventario.stock.edit",["categoria"=>$categoria, "sede"=>$sede,"proveedor"=>$proveedor,"producto"=>$producto,"stock"=>Stock::findOrFail($id),"modulos"=>$modulos,"usuarios"=>$usuarios,"sedes"=>$sedes,"clientes"=>$clientes,"tipos"=>$tipos]);
	 	}

	 	public function update(StockFormRequest $request, $id){
	 		$ps = Stock::findOrFail($id);
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
	 		$ps->update();

	 		return back()->with('msj','Producto actualizado');
	 	}

	 	public function destroy($id){
	 		$id=$id;


	 		$existe=DB::table('m_stock')
	 		->where('stock_id_stock','=',$id)
	 		->orderBy('id_mstock', 'desc')->get();

	 		$existeDPC=DB::table('d_p_cliente')
	 		->where('producto_id_producto','=',$id)
	 		->orderBy('id_dpcliente', 'desc')->get();

	 		$existeDPP=DB::table('d_p_proveedor')
	 		->where('producto_id_producto','=',$id)
	 		->orderBy('id_dpproveedor', 'desc')->get();

	 		if(count($existe)==0 && count($existeDPC)==0 && count($existeDPP)==0){
	 			$ps=Stock::findOrFail($id);
	 			$ps->delete();

	 		return back()->with('msj','Producto eliminado');

	 		}else{

	 		return back()->with('errormsj','¡Producto relacionado!');

	 		}

		 }
		 


	 	public function bajar(StockFormRequest $request, $id){

			$ps = Stock::findOrFail($id);
			$ps->producto_dados_baja=1;
			$ps->update();

			return back()->with('msj','Estado actualizado');
			
		}


		public function indexBaja(Request $request){
			if ($request) {
   
					$query0=trim($request->get('searchText0'));
					$query1=trim($request->get('searchText1'));
					$query2=trim($request->get('searchText2'));
					$query3=trim($request->get('searchText3'));
					$query4=trim($request->get('searchText4'));
					$usuarios=DB::table('empleado')->get();
					$sedes=DB::table('sede')->get();
					$categoria=DB::table('categoria_stock_especiales')->get();
   					
   					$productosP=DB::table('stock')
					->orderBy('id_stock', 'desc')->get();

   					foreach ($productosP as $p) {

	 			$stock=Stock::findOrFail($p->id_stock);
	 			$fecha=$p->fecha_vencimiento;
				$b=strtotime($fecha);
				$fechaA=getdate();

				if($fecha!="0000-00-00"){
					if(date("y",$b)==date("y")){
					if(date("m",$b)==date("m")){
						if(date("d",$b)==date("d")){
							$stock->producto_dados_baja=0;
						}
						if(date("d",$b)<date("d")){
							$stock->producto_dados_baja=1;
						}
						if(date("d",$b)>date("d")){
							$stock->producto_dados_baja=0;
						}	
					}
					if(date("m",$b)<date("m")){
						$stock->producto_dados_baja=1;
					}
					if(date("m",$b)>date("m")){
						$stock->producto_dados_baja=0;
					}	
				}
				if(date("y",$b)<date("y")){
					$stock->producto_dados_baja=1;
				}
				if(date("y",$b)>date("y")){
					$stock->producto_dados_baja=0;
				}
				}else{
			    $stock->producto_dados_baja=0;
			}

				


						$stock->update();	
	 			}

					if($query4=="Todas las categorías"){
						$productos=DB::table('stock as s')
					->join('producto as p','s.producto_id_producto','=','p.id_producto')
					->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
					->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
					->join('categoria_stock_especiales as c','s.categoria_id_categoria','=','c.id_categoriaStock')
					->join('tipo_stock_unoa as tp','s.tipo_stock_id','=','tp.id_stock_unoa')
					->join('proveedor as pd','s.proveedor_id_proveedor','=','pd.id_proveedor')
					->select('s.id_stock','p.nombre','p.plu','p.ean','sed.nombre_sede','pd.nombre_proveedor','c.nombre as categoria_id_categoria','s.cantidad','s.sede_id_sede as sede_id_sede','s.producto_dados_baja','s.fecha_vencimiento', 's.fecha_registro', 'e.nombre as empleado_id_empleado', 'p.imagen as img','tp.nombre as tipo_stock_id')
						->where('p.nombre','LIKE', '%'.$query0.'%')
						->where('p.plu','LIKE', '%'.$query1.'%')
						->where('sed.nombre_sede','LIKE', '%'.$query2.'%')
						->where('pd.nombre_proveedor','LIKE', '%'.$query3.'%')
						->where('s.producto_dados_baja','=', 1)
						->orderBy('s.id_stock', 'desc')
						->paginate(10);
					}else{
	
						$productos=DB::table('stock as s')
					->join('producto as p','s.producto_id_producto','=','p.id_producto')
					->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
					->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
					->join('categoria_stock_especiales as c','s.categoria_id_categoria','=','c.id_categoriaStock')
					->join('tipo_stock_unoa as tp','s.tipo_stock_id','=','tp.id_stock_unoa')
					->join('proveedor as pd','s.proveedor_id_proveedor','=','pd.id_proveedor')
					->select('s.id_stock','p.nombre','p.plu','p.ean','sed.nombre_sede','pd.nombre_proveedor','c.nombre as categoria_id_categoria','s.cantidad','s.sede_id_sede as sede_id_sede','s.producto_dados_baja','s.fecha_vencimiento', 's.fecha_registro', 'e.nombre as empleado_id_empleado', 'p.imagen as img','tp.nombre as tipo_stock_id')
						->where('p.nombre','LIKE', '%'.$query0.'%')
						->where('p.plu','LIKE', '%'.$query1.'%')
						->where('sed.nombre_sede','LIKE', '%'.$query2.'%')
						->where('pd.nombre_proveedor','LIKE', '%'.$query3.'%')
						->where('c.nombre','LIKE', '%'.$query4.'%')
						->where('s.producto_dados_baja','=', 1)
						->orderBy('s.id_stock', 'desc')
						->paginate(10);
					}
   
				    $cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
					$modulos=DB::table('cargo_modulo')
					->where('id_cargo','=',$cargoUsuario)
					->orderBy('id_cargo', 'desc')->get();
   
					$eanP=DB::table('producto')
					->orderBy('id_producto', 'desc')->get();
   
					$sedesP=DB::table('sede')->get();
					$proveedoresP=DB::table('proveedor')->get();

					$clientes=DB::table('cliente')->get();

   
					return view('almacen.inventario.stock.indexBaja',["categoria"=>$categoria,"productos"=>$productos,"searchText0"=>$query0,"searchText1"=>$query1,"searchText2"=>$query2,"searchText3"=>$query3,"searchText4"=>$query4,"modulos"=>$modulos,"eanP"=>$eanP,"sedesP"=>$sedesP,"proveedoresP"=>$proveedoresP,"usuarios"=>$usuarios,"sedes"=>$sedes,"clientes"=>$clientes]);
				}
			}


			public function downloadExcel(Request $request){
				return view('almacen.descargarExcel.descargarStockUnoA');
			}


}