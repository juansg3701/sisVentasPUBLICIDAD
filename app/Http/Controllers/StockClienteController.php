<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\StockClientes;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\StockClienteFormRequest;
use DB;

class StockClienteController extends Controller
{
	  	public function __construct(){
			$this->middleware('auth');	
		} 
	 	public function index(Request $request){
	 	if ($request) {

	 			$query1=trim($request->get('searchText1'));
	 			$query2=trim($request->get('searchText2'));
	 			$query3=trim($request->get('searchText3'));
				$query4=trim($request->get('searchText4'));
				$query5=trim($request->get('searchText5'));
				$query6=trim($request->get('searchText6'));
				$query7=trim($request->get('searchText7'));
				$query8=trim($request->get('searchText8'));

				$usuarios=DB::table('empleado')->get();
				$sedes=DB::table('sede')->get();
				$categoria=DB::table('categoria_stock_especiales')->get();
				 
	 			$productosP=DB::table('stock_clientes')
				->orderBy('id_stock_clientes', 'desc')->get();

				foreach ($productosP as $p) {

	 			$stock=StockClientes::findOrFail($p->id_stock_clientes);
	 			$fecha=$p->fecha_vencimiento;
				$b=strtotime($fecha);
				$fechaA=getdate();

				if($fecha!="0000-00-00"){

				if(date("y",$b)==date("y")){
					if(date("m",$b)==date("m")){
						if(date("d",$b)==date("d")){
							$stock->producto_dados_baja=1;
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
			}
						$stock->update();	
	 			}
				 

				 if($query1=="Todas las categorías" && $query2=="Todas las categorías" && $query3=="Todas las categorías"){
					$productos=DB::table('stock_clientes as s')
					->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
					->join('sede as sed2','s.sede_id_sede_cliente','=','sed2.id_sede')
					->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
					->join('categoria_stock_especiales as c','s.categoria_dias_especiales_id','=','c.id_categoriaStock')
					->join('empresa as em','s.empresa_id_empresa','=','em.id_empresa')
					->join('categoria as ct','s.categoria_id_categoria','=','ct.id_categoria')
					->select('s.id_stock_clientes','s.nombre','s.plu','s.ean','sed.nombre_sede as sede_empresa','sed.nombre_sede as sede_cliente','c.nombre as categoria_especial','s.cantidad','sed.id_sede as id_sede_empresa','sed2.id_sede as id_sede_cliente','s.producto_dados_baja','s.fecha_vencimiento', 's.fecha_registro','e.nombre as empleado_id_empleado', 's.imagen as img','s.precio','ct.nombre as categoria_normal','s.empresa_id_empresa as nombre_empresa','s.empresa_categoria_id as nombre_subempresa')
					->where('s.nombre','LIKE', '%'.$query5.'%')
					->where('s.plu','LIKE', '%'.$query6.'%')
					->where('s.ean','LIKE', '%'.$query7.'%')
					->where('sed2.nombre_sede','LIKE', '%'.$query8.'%')
					->orderBy('s.id_stock_clientes', 'desc')
					->paginate(100);
				}else{

					$productos=DB::table('stock_clientes as s')
					->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
					->join('sede as sed2','s.sede_id_sede_cliente','=','sed2.id_sede')
					->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
					->join('categoria_stock_especiales as c','s.categoria_dias_especiales_id','=','c.id_categoriaStock')
					->join('empresa as em','s.empresa_id_empresa','=','em.id_empresa')
					->join('categoria as ct','s.categoria_id_categoria','=','ct.id_categoria')
					->select('s.id_stock_clientes','s.nombre','s.plu','s.ean','sed.nombre_sede as sede_empresa','sed.nombre_sede as sede_cliente','c.nombre as categoria_especial','s.cantidad','sed.id_sede as id_sede_empresa','sed2.id_sede as id_sede_cliente','s.producto_dados_baja','s.fecha_vencimiento', 's.fecha_registro','e.nombre as empleado_id_empleado', 's.imagen as img','s.precio','ct.nombre as categoria_normal','s.empresa_id_empresa as nombre_empresa','s.empresa_categoria_id as nombre_subempresa')
					->where('ct.nombre','LIKE', '%'.$query1.'%')
					->where('c.nombre','LIKE', '%'.$query2.'%')
					->where('em.nombre','LIKE', '%'.$query3.'%')
					->where('s.nombre','LIKE', '%'.$query5.'%')
					->where('s.plu','LIKE', '%'.$query6.'%')
					->where('s.ean','LIKE', '%'.$query7.'%')
					->where('sed2.nombre_sede','LIKE', '%'.$query8.'%')
					->orderBy('s.id_stock_clientes', 'desc')
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

	 			$empresas=DB::table('empresa')->get();
	 			$subempresas=DB::table('empresa_categoria')->get();
	 			$categoria_especiales=DB::table('categoria')->get();

	 			return view('almacen.inventario.stockclientes.index',["categoria"=>$categoria,"productos"=>$productos,"searchText1"=>$query1,"searchText2"=>$query2,"searchText3"=>$query3,"searchText4"=>$query4,"searchText5"=>$query5,"searchText6"=>$query6,"searchText7"=>$query7,"searchText8"=>$query8,"modulos"=>$modulos,"eanP"=>$eanP,"sedesP"=>$sedesP,"proveedoresP"=>$proveedoresP,"usuarios"=>$usuarios,"sedes"=>$sedes,"empresas"=>$empresas,"subempresas"=>$subempresas,"categoria_especiales"=>$categoria_especiales]);
	 		}
	 	}


	 	public function create(Request $request){

	 	}

	 	public function store(StockFormRequest $request){
	 		
	 	}

	 	public function show($id){
	 	
	 	}

	 	public function edit($id){
	 		$query="";
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



	 	public function update(StockClienteFormRequest $request, $id){
	 		$id=$id;
	 		$pluR=$request->get('plu');
	 		$eanR=$request->get('ean');
	 		$nombreR=$request->get('nombre');

	 		$pluE=DB::table('stock_clientes')
	 		->where('id_stock_clientes','!=',$id)
	 		->where('plu','=',$pluR)
	 		->orderBy('id_stock_clientes', 'desc')->get();

	 		$nombreE=DB::table('stock_clientes')
	 		->where('id_stock_clientes','!=',$id)
	 		->where('nombre','=',$nombreR)
	 		->orderBy('id_stock_clientes', 'desc')->get();

			
	 		if(count($pluE)==0){
	 			if(count($nombreE)==0){
	 			$ps = StockClientes::findOrFail($id);
		 		$ps->plu=$pluR;
		 		$ps->ean=$eanR;
		 		$ps->nombre=$nombreR;
		 		$ps->precio=$request->get('precio');
				$ps->categoria_id_categoria=$request->get('categoria_id_categoria');
				$ps->fecha_registro=$request->get('fecha_registro');
				$ps->empresa_id_empresa=$request->get('empresa_id_empresa');
				$ps->empresa_categoria_id=$request->get('empresa_categoria_id');	
				$ps->empleado_id_empleado=$request->get('empleado_id_empleado');
				$ps->sede_id_sede=$request->get('sede_id_sede');
				$ps->sede_id_sede_cliente=$request->get('sede_id_sede_cliente');
				$ps->categoria_dias_especiales_id=$request->get('categoria_dias_especiales_id');
			    $ps->cantidad=$request->get('cantidad');
			    $ps->fecha_vencimiento=$request->get('fecha_vencimiento');
			    if($request->get('producto_dados_baja')==1){
				   $ps->producto_dados_baja=0;
			    }	
			    else{
				   $ps->producto_dados_baja=1;
			    }

				if($request->hasFile('imagen')){
					$file=$request->file('imagen');
					$nombre=$ps->id_stock_clientes."_".$ps->nombre."_".$file->getClientOriginalName();
					$file->move(public_path().'/imagenes/articulosClientes/', $nombre);
					$ps->imagen=$nombre;
				}
				/*
				$file->move('/home/control3/public_unoa//imagenes/articulosClientes/', $nombre);
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


	 		$existe=DB::table('m_stock')
	 		->where('stock_id_stock','=',$id)
	 		->orderBy('id_mstock', 'desc')->get();

	 		$existeDPC=DB::table('d_p_cliente')
	 		->where('producto_id_producto','=',$id)
	 		->orderBy('id_dpcliente', 'desc')->get();


	 		if(count($existe)==0 && count($existeDPC)==0){
	 			$ps=StockClientes::findOrFail($id);
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


	

}