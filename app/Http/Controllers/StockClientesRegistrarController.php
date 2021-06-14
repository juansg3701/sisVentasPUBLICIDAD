<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\StockClientes;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\StockClienteFormRequest;
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
			if($query!=""){
			$subempresas=DB::table('empresa_categoria')
			->where('empresa_id_empresa','=',$query)
			->orderBy('id_empresa_categoria','desc')
			->get();
			}else{
				$subempresas=[];

			}
			

			$categoria=DB::table('categoria')->get();
			$categoria_especiales=DB::table('categoria_stock_especiales')->get();
			
	 		$query=trim($request->get('searchText'));

	
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			$clientes=DB::table('cliente')->get();

	 		return view("almacen.inventario.eanClientes.index",["sede"=>$sede,"modulos"=>$modulos,"searchText"=>$query,"usuarios"=>$usuarios,"sedes"=>$sedes,"categoria"=>$categoria,"clientes"=>$clientes,"empresas"=>$empresas,"subempresas"=>$subempresas,"categoria_especiales"=>$categoria_especiales]);
	 	}
	 	}

	 	public function create(Request $request){


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
				 

					$productos=DB::table('stock_clientes as s')
					->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
					->join('sede as sed2','s.sede_id_sede_cliente','=','sed2.id_sede')
					->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
					->join('categoria_stock_especiales as c','s.categoria_dias_especiales_id','=','c.id_categoriaStock')
					->join('empresa as em','s.empresa_id_empresa','=','em.id_empresa')
					->join('categoria as ct','s.categoria_id_categoria','=','ct.id_categoria')
					->select('s.id_stock_clientes','s.nombre','s.plu','s.ean','sed.nombre_sede as sede_empresa','sed2.nombre_sede as sede_cliente','c.nombre as categoria_especial','s.cantidad','sed.id_sede as id_sede_empresa','sed2.id_sede as id_sede_cliente','s.producto_dados_baja','s.fecha_vencimiento', 's.fecha_registro','e.nombre as empleado_id_empleado', 's.imagen as img','s.precio','ct.nombre as categoria_normal','s.empresa_id_empresa as nombre_empresa','s.empresa_categoria_id as nombre_subempresa', 's.descripcion')
					->orderBy('s.id_stock_clientes', 'desc')
					->paginate(10);

				

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

	 			if(auth()->user()->tipo_cuenta==1){
			 			$cuenta=DB::table('cliente')
			 			->where('user_id_user','=',auth()->user()->id)
			 			->orderBy('id_cliente', 'desc')->get();

		 			if($cuenta[0]->empresa_categoria_id!=0){
		 				$validacion=1;
		 			}else{
		 				$validacion=0;
		 			}
	 			}else{
	 				$validacion=0;
	 				$cuenta=[];
	 			}
	 			

	 			return view('almacen.inventario.clientes.index',["categoria"=>$categoria,"productos"=>$productos,"modulos"=>$modulos,"eanP"=>$eanP,"sedesP"=>$sedesP,"proveedoresP"=>$proveedoresP,"usuarios"=>$usuarios,"sedes"=>$sedes,"empresas"=>$empresas,"subempresas"=>$subempresas,"categoria_especiales"=>$categoria_especiales,"cuenta"=>$cuenta,"validacion"=>$validacion]);
	 	
	 	}
	 	public function update(Request $request,$id){
	 		
	 	
	 	}

		 
	 	public function store(StockClienteFormRequest $request){
	 		$pluR=$request->get('plu');
	 		$eanR=$request->get('ean');
	 		$nombreR=$request->get('nombre');

	 		$pluE=DB::table('stock_clientes')
	 		->where('plu','=',$pluR)
	 		->orderBy('id_stock_clientes', 'desc')->get();

	 		$eanE=DB::table('stock_clientes')
	 		->where('ean','=',$eanR)
	 		->orderBy('id_stock_clientes', 'desc')->get();

	 		$nombreE=DB::table('stock_clientes')
	 		->where('nombre','=',$nombreR)
	 		->orderBy('id_stock_clientes', 'desc')->get();

			
	 		if($pluR!="" && $eanR!="" $pluR!=" " && $eanR!=" " && count($pluE)==0 && count($eanE)==0){
	 			if(count($nombreE)==0){
	 			$ps = new StockClientes;
		 		$ps->plu=$pluR;
		 		$ps->ean=$eanR;
		 		$ps->nombre=$nombreR;
				$ps->precio=$request->get('precio');
				$ps->descripcion=$request->get('descripcion');
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
				$ps->save();

				if($request->hasFile('imagen')){
					$file=$request->file('imagen');
					$nombre=$ps->id_stock_clientes."_".$ps->nombre."_".$file->getClientOriginalName();
					$file->move(public_path().'/imagenes/articulosClientes/', $nombre);
					$ps->imagen=$nombre;
				}
				/*
				$file->move('/home/control3/public_unoa/imagenes/articulosClientes/', $nombre);
				*/
		 		$ps->update();

			 	return back()->with('msj','Producto guardado');
	 			}else{
	 				return back()->with('errormsj','¡Nombre ya registrado!');
	 			}
	 		}else{
	 				return back()->with('errormsj','¡Revise PLU o EAN!');
	 		}

			
		}



	 	public function show($id){
	 		
	 	}

}