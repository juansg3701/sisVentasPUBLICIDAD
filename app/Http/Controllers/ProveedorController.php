<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Proveedor;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\ProveedorFormRequest;
use DB;

class ProveedorController extends Controller
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
	 			/*$proveedores=DB::table('proveedor')
	 			->where('nombre_empresa','LIKE', '%'.$query0.'%')
	 			->where('documento','LIKE', '%'.$query1.'%')
	 			->orderBy('id_proveedor', 'desc')
				->paginate(10);*/
				 
				$proveedores=DB::table('proveedor as p')
	 			->join('empleado as u','p.empleado_id_empleado','=','u.id_empleado')
		 		->join('sede as s','p.sede_id_sede','=','s.id_sede')
		 		->select('p.id_proveedor','p.nombre_empresa','p.nombre_proveedor','p.direccion', 'p.telefono', 'p.correo', 'p.documento', 'p.verificacion_nit','s.nombre_sede as sede_id_sede', 'u.nombre as empleado_id_empleado', 'p.fecha')
	 			->where('p.nombre_empresa','LIKE', '%'.$query0.'%')
				->where('p.documento','LIKE', '%'.$query1.'%')
				->where('p.verificacion_nit','LIKE', '%'.$query2.'%')
	 			->where('p.nombre_proveedor','LIKE', '%'.$query3.'%')
	 			->orderBy('p.id_proveedor', 'desc')
	 			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			$proveedoresP=DB::table('proveedor')
	 			->orderBy('id_proveedor', 'desc')->get();

	 		
	 			return view('almacen.proveedor.index',["proveedores"=>$proveedores,"searchText0"=>$query0,"searchText1"=>$query1,"searchText2"=>$query2,"searchText3"=>$query3, "modulos"=>$modulos,"proveedoresP"=>$proveedoresP]);
	 		}
	 	}

	 	public function create(Request $request){

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$empleados=DB::table('empleado')
	 			->orderBy('id_empleado', 'desc')->get();
	 		
	 		return view('almacen.proveedor.registrar', ["modulos"=>$modulos,"empleados"=>$empleados]);
	 	}

	 	public function store(ProveedorFormRequest $request){
	 		$documentoR=$request->get('documento');
			$correoR=$request->get('correo');
			 
			$digitoR=$request->get('verificacion_nit');

	 		$DocumenRegis=DB::table('proveedor')
			->where('documento','=',$documentoR)
			->where('verificacion_nit','=',$digitoR) 
	 		->orderBy('id_proveedor','desc')->get();

	 		$CorreoRegis=DB::table('proveedor')
	 		->where('correo','=',$correoR)
	 		->orderBy('id_proveedor','desc')->get();

	 		if(count($DocumenRegis)==0){

	 			if(count($CorreoRegis)==0){
	 					$proveedor = new Proveedor;
				 		$proveedor->nombre_empresa=$request->get('nombre_empresa');
				 		$proveedor->nombre_proveedor=$request->get('nombre_proveedor');
				 		$proveedor->direccion=$request->get('direccion');
				 		$proveedor->telefono=$request->get('telefono');
				 		$proveedor->correo=$correoR;
						$proveedor->documento=$documentoR;
						
				 		$proveedor->verificacion_nit=$digitoR;
				 		$proveedor->fecha=$request->get('fecha');
				 		$proveedor->empleado_id_empleado=$request->get('empleado_id_empleado');
				 		$proveedor->save();
				 		return back()->with('msj','Proveedor guardado');
	 			}else{
	 				return back()->with('errormsj','Correo ya registrado!');
	 			}
	 		
	 		}else{
	 			return back()->with('errormsj','¡NIT ya registrado!');
	 		}
	 		
	 	}

	 	public function show($id){
	 		return view("almacen.proveedor.show",["proveedor"=>Proveedor::findOrFail($id)]);
	 	}

	 	public function edit($id){
			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
			$sedes=DB::table('sede')->get();
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
				 $usuarios=DB::table('empleado')->get();
				 
			
	 			
	 		return view("almacen.proveedor.edit",["proveedor"=>Proveedor::findOrFail($id), "modulos"=>$modulos,"usuarios"=>$usuarios,"sedes"=>$sedes]);
	 	}

	 	public function update(ProveedorFormRequest $request, $id){

	 		$id=$id;
	 		$documentoR=$request->get('documento');
	 		$correoR=$request->get('correo');

			$digitoR=$request->get('verificacion_nit');

	 		/*$DocumenRegis=DB::table('proveedor')
	 		->where('id_proveedor','!=',$id)
	 		->where('documento','=',$documentoR)
			->orderBy('id_proveedor','desc')->get();*/
			 
			$DocumenRegis=DB::table('proveedor')
	 		->where('id_proveedor','!=',$id)
			->where('documento','=',$documentoR)
			->where('verificacion_nit','=',$digitoR)
	 		->orderBy('id_proveedor','desc')->get();

	 		$CorreoRegis=DB::table('proveedor')
	 		->where('id_proveedor','!=',$id)
	 		->where('correo','=',$correoR)
	 		->orderBy('id_proveedor','desc')->get();

	 		if(count($DocumenRegis)==0){
	 			if(count($CorreoRegis)==0){
	 					$proveedor = Proveedor::findOrFail($id);
				 		$proveedor->nombre_empresa=$request->get('nombre_empresa');
				 		$proveedor->nombre_proveedor=$request->get('nombre_proveedor');
				 		$proveedor->direccion=$request->get('direccion');
				 		$proveedor->telefono=$request->get('telefono');
				 		$proveedor->correo=$correoR;
						$proveedor->documento=$documentoR;
				
				 		$proveedor->verificacion_nit=$digitoR;
				 		$proveedor->fecha=$request->get('fecha');
				 		$proveedor->empleado_id_empleado=$request->get('empleado_id_empleado');
				 		$proveedor->update();
				 		return back()->with('msj','Proveedor actualizado');
	 			}else{
	 				return back()->with('errormsj','Correo ya registrado!');
	 			}
	 		
	 		}else{
	 			return back()->with('errormsj','¡NIT ya registrado!');
	 		}

	 	}

	 	public function destroy($id){
	 		$id=$id;

	 		$existe=DB::table('stock')
	 		->where('proveedor_id_proveedor','=',$id)
	 		->orderBy('id_stock', 'desc')->get();

	 		if(count($existe)==0){
	 			$proveedor=Proveedor::findOrFail($id);
	 		$proveedor->delete();
	 		return back()->with('msj','Proveedor eliminado');
	 		}else{
	 				return back()->with('errormsj','¡Proveedor relacionado con stock!');
	 			}	 		
	 	}

}
