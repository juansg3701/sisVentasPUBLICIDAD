<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\ProductoSede;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\ProductoSedeFormRequest;
use DB;

class ProductoSedeController extends Controller
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
				$categoria=DB::table('categoria')->get();
				
				if($query3=="Todas las categorías"){
					$productos=DB::table('producto as p')
					->join('categoria as c','p.categoria_id_categoria','=','c.id_categoria')
					->join('empleado as e','p.empleado_id_empleado','=','e.id_empleado')
					->join('sede as s','p.sede_id_sede','=','s.id_sede')
					->select('p.id_producto','p.nombre','p.plu','p.ean','c.nombre as categoria_id_categoria','p.precio','p.stock_minimo','p.imagen','p.fecha_registro','e.nombre as empleado_id_empleado','s.nombre_sede as sede_id_sede')
					->where('p.nombre','LIKE', '%'.$query0.'%')
					->where('p.plu','LIKE', '%'.$query1.'%')
					->where('p.ean','LIKE', '%'.$query2.'%')
					->orderBy('p.id_producto', 'desc')
					->paginate(10);
				}else{
					$productos=DB::table('producto as p')
					->join('categoria as c','p.categoria_id_categoria','=','c.id_categoria')
					->join('empleado as e','p.empleado_id_empleado','=','e.id_empleado')
					->join('sede as s','p.sede_id_sede','=','s.id_sede')
					->select('p.id_producto','p.nombre','p.plu','p.ean','c.nombre as categoria_id_categoria','p.precio','p.stock_minimo','p.imagen','p.fecha_registro','e.nombre as empleado_id_empleado','s.nombre_sede as sede_id_sede')
					->where('p.nombre','LIKE', '%'.$query0.'%')
					->where('p.plu','LIKE', '%'.$query1.'%')
					->where('p.ean','LIKE', '%'.$query2.'%')
					->where('c.nombre','LIKE', '%'.$query3.'%')
					->orderBy('p.id_producto', 'desc')
					->paginate(10);
				}

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			$eanP=DB::table('producto')
				 ->orderBy('id_producto', 'desc')->get();
				 
	 			return view('almacen.inventario.producto-sede.productoCompleto.index',["productos"=>$productos,"categoria"=>$categoria,"searchText0"=>$query0,"searchText1"=>$query1,"searchText2"=>$query2,"searchText3"=>$query3,"modulos"=>$modulos,"eanP"=>$eanP]);
	 		}
	 	}


	 	public function create(){
	 		$categorias=DB::table('categoria')->get();
			$usuarios=DB::table('empleado')->get();
	 		$sedes=DB::table('sede')->get();
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen.inventario.producto-sede.productoCompleto.registrar",["categorias"=>$categorias,"modulos"=>$modulos,"usuarios"=>$usuarios,"sedes"=>$sedes]);
	 	}

	 	public function store(ProductoSedeFormRequest $request){
	 		$pluR=$request->get('plu');
	 		$eanR=$request->get('ean');
	 		$nombreR=$request->get('nombre');

	 		$pluE=DB::table('producto')
	 		->where('plu','=',$pluR)
	 		->orderBy('id_producto', 'desc')->get();

	 		$eanE=DB::table('producto')
	 		->where('ean','=',$eanR)
	 		->orderBy('id_producto', 'desc')->get();

	 		$nombreE=DB::table('producto')
	 		->where('nombre','=',$nombreR)
	 		->orderBy('id_producto', 'desc')->get();

	 		if(count($pluE)==0 && count($eanE)==0 && $pluR!="" && $eanR!="" && $pluR!=" " && $eanR!=" "){
	 			if(count($nombreE)==0){
	 			$ps = new ProductoSede;
		 		$ps->plu=$pluR;
		 		$ps->ean=$eanR;
		 		$ps->nombre=$nombreR;
		 		//$ps->unidad_de_medida=$request->get('unidad_de_medida');
		 		$ps->precio=$request->get('precio');
		 		$ps->stock_minimo=$request->get('stock_minimo');
				$ps->categoria_id_categoria=$request->get('categoria_id_categoria');
				$ps->fecha_registro=$request->get('fecha_registro');	
				$ps->empleado_id_empleado=$request->get('empleado_id_empleado');
				$ps->sede_id_sede=$request->get('sede_id_sede');
				$ps->save();

				$year_now=date('Y');
				$month_now=date('m');
				$day_now=date('d');
				if($request->hasFile('imagen')){
					$file=$request->file('imagen');
					$nombre=$ps->id_producto.$year_now.$month_now.$day_now;
					$file->move(public_path().'/imagenes/articulos/', $nombre);
					$ps->imagen=$nombre;
				}
				/*
				$file->move('/home/control3/public_unoa/imagenes/articulos/', $nombre);
				*/
		 		$ps->update();

			 	return back()->with('msj','Producto guardado');
	 			}else{
	 				return back()->with('errormsj','¡Nombre ya registrado!');
	 			}
	 		}else{
	 				return back()->with('errormsj','¡Revise el PLU o EAN!');
	 		}
	 	}

	 	public function show($id){
	 		return view("almacen.inventario.producto-sede.productoCompleto.show",["productos"=>ProductoSede::findOrFail($id)]);
	 	}

	 	public function edit($id){
			$categorias=DB::table('categoria')->get();
			$usuarios=DB::table('empleado')->get();
	 		$sedes=DB::table('sede')->get();

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen.inventario.producto-sede.productoCompleto.edit",["productos"=>ProductoSede::findOrFail($id),"categorias"=>$categorias, "modulos"=>$modulos,"usuarios"=>$usuarios,"sedes"=>$sedes]);

	 	}

	 	public function update(ProductoSedeFormRequest $request, $id){
	 		$id=$id;
	 		$pluR=$request->get('plu');
	 		$eanR=$request->get('ean');
	 		$nombreR=$request->get('nombre');

	 		$pluE=DB::table('producto')
	 		->where('id_producto','!=',$id)
	 		->where('plu','=',$pluR)
	 		->orderBy('id_producto', 'desc')->get();

	 		$nombreE=DB::table('producto')
	 		->where('id_producto','!=',$id)
	 		->where('nombre','=',$nombreR)
	 		->orderBy('id_producto', 'desc')->get();

	 		if(count($pluE)==0){
	 			if(count($nombreE)==0){
	 			$ps = ProductoSede::findOrFail($id);
		 		$ps->plu=$pluR;
		 		$ps->ean=$eanR;
		 		$ps->nombre=$nombreR;
		 		//$ps->unidad_de_medida=$request->get('unidad_de_medida');
		 		$ps->precio=$request->get('precio');
		 		$ps->stock_minimo=$request->get('stock_minimo');
				$ps->categoria_id_categoria=$request->get('categoria_id_categoria');
				$ps->fecha_registro=$request->get('fecha_registro');	
				$ps->empleado_id_empleado=$request->get('empleado_id_empleado');
				$ps->sede_id_sede=$request->get('sede_id_sede');
				$year_now=date('Y');
				$month_now=date('m');
				$day_now=date('d');
				if($request->hasFile('imagen')){
					$file=$request->file('imagen');
					$nombre=$ps->id_producto.$year_now.$month_now.$day_now;
					$file->move(public_path().'/imagenes/articulos/', $nombre);
					$ps->imagen=$nombre;
				}
				
				/*
				$file->move('/home/control3/public_unoa/imagenes/articulos/', $nombre);
				*/
		 		$ps->update();

		 		return back()->with('msj','Producto actualizado');
	 			}else{
	 				return back()->with('errormsj','¡Nombre ya registrado!');
	 			}
	 		}else{
	 				return back()->with('errormsj','¡PLU ya registrado!');
	 		}
	
	 	}

	 	public function destroy($id){
	 		$id=$id;

	 		$existeS=DB::table('stock')
	 		->where('producto_id_producto','=',$id)
	 		->orderBy('id_stock', 'desc')->get();

	 		$existeDC=DB::table('d_corte')
	 		->where('producto_id_producto','=',$id)
	 		->orderBy('id_dcorte', 'desc')->get();


	 		if(count($existeS)==0 && count($existeDC)==0){
	 			$ps=ProductoSede::findOrFail($id);
		 		$ps->delete();
		 		return back()->with('msj','Producto eliminado');
	 		}else{
	 			return back()->with('errormsj','¡Producto relacionado!');
	 		}

		 }
		 
		public function downloadExcel(Request $request){
			//Proveedor
			return view('almacen.descargarExcel.descargarProductos');
		}

}