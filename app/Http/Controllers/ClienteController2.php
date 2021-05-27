<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Cliente;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\ClienteFormRequest;
use DB;

class ClienteController2 extends Controller
{
	   public function __construct(){
			$this->middleware('auth');	

			 	} 
	 	public function index(Request $request){
	 		if ($request) {
	 			$query0=trim($request->get('empresa_id_empresa'));
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			$cargos=DB::table('tipo_cargo')
	 			->orderBy('id_cargo','desc')->get();
	 			$sedes=DB::table('sede')->get();
	 			$empresas=DB::table('empresa')->get();
	 			$subempresas=DB::table('empresa_categoria as ec')
	 			->join('empresa as e','ec.empresa_id_empresa','=','e.id_empresa')
	 			->select('ec.id_empresa_categoria','ec.nombre as nombreSubempresa','e.nombre as nombreEmpresa')
	 			->where('empresa_id_empresa','=',$query0)
	 			->orderBy('ec.id_empresa_categoria','desc')->get();
	 			
	 			return view("almacen.cliente.cliente.registrar",["modulos"=>$modulos,"cargos"=>$cargos,"sedes"=>$sedes,"empresas"=>$empresas,"subempresas"=>$subempresas,"empresa_id_empresa"=>$query0]);
	 		}
	 	}
	 	public function create(){
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			return view("almacen.cliente.registrar",["modulos"=>$modulos]);
	 		
	 	}

	 	public function store(ClienteFormRequest $request){
	 		$documentoR=$request->get('documento');
	 		$correoR=$request->get('correo');

	 		$DocumenRegis=DB::table('cliente')
	 		->where('documento','=',$documentoR)
	 		->orderBy('id_cliente','desc')->get();

	 		$CorreoRegis=DB::table('cliente')
	 		->where('correo','=',$correoR)
	 		->orderBy('id_cliente','desc')->get();

	 		if(count($DocumenRegis)==0){
	 			if(count($CorreoRegis)==0){
	 				$cliente = new Cliente;
			 		$cliente->nombre=$request->get('nombre');
			 		$cliente->direccion=$request->get('direccion');
			 		$cliente->telefono=$request->get('telefono');
			 		$cliente->correo=$correoR;
			 		$cliente->documento=$documentoR;
			 		$cliente->verificacion_nit=$request->get('verificacion_nit');
			 		$cliente->nombre_empresa=$request->get('nombre_empresa');
			 		$cliente->cartera_activa=$request->get('cartera_activa');
			 		$cliente->save();	


				 		return back()->with('msj','Cliente guardado');

	 			}else{
	 				return back()->with('errormsj','Correo ya registrado!');
	 			}

	 		}else{
	 			return back()->with('errormsj','¡Documento ya registrado!');
	 		}
	
	 	}

	 	public function edit($id){
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			
	 		return view("almacen.cliente.edit",["cliente"=>Cliente::findOrFail($id), "modulos"=>$modulos]);
	 	}
	 		public function show($id){
	 		return view("almacen.cliente.show",["cliente"=>Cliente::findOrFail($id)]);
	 	}

	 	public function update(ClienteFormRequest $request, $id){
	 		$id=$id;
	 		$documentoR=$request->get('documento');
	 		$correoR=$request->get('correo');

	 		$DocumenRegis=DB::table('cliente')
	 		->where('id_cliente','!=',$id)
	 		->where('documento','=',$documentoR)
	 		->orderBy('id_cliente','desc')->get();

	 		$CorreoRegis=DB::table('cliente')
	 		->where('id_cliente','!=',$id)
	 		->where('correo','=',$correoR)
	 		->orderBy('id_cliente','desc')->get();

	 		if(count($DocumenRegis)==0){
	 			if(count($CorreoRegis)==0){
	 				$cliente = Cliente::findOrFail($id);
			 		$cliente->nombre=$request->get('nombre');
			 		$cliente->direccion=$request->get('direccion');
			 		$cliente->telefono=$request->get('telefono');
			 		$cliente->correo=$correoR;
			 		$cliente->documento=$documentoR;
			 		$cliente->verificacion_nit=$request->get('verificacion_nit');
			 		$cliente->nombre_empresa=$request->get('nombre_empresa');
			 		$cliente->cartera_activa=$request->get('cartera_activa');
			 		$cliente->update();
			 		return back()->with('msj','Cliente actualizado');

	 			}else{
	 				return back()->with('errormsj','Correo ya registrado!');
	 			}

	 		}else{
	 			return back()->with('errormsj','¡Documento ya registrado!');
	 		}

	 	}

	 	public function destroy($id){
	 	$id=$id;

	 		$existe=DB::table('factura')
	 		->where('cliente_id_cliente','=',$id)
	 		->orderBy('id_factura', 'desc')->get();

	 		$existeC=DB::table('cartera')
	 		->where('cliente_id_cliente','=',$id)
	 		->orderBy('id_cartera', 'desc')->get();

	 		if(count($existe)==0 && count($existeC)==0){
	 			$cliente=Cliente::findOrFail($id);
		 		$cliente->delete();
		 		return back()->with('msj','Cliente eliminado');
	 		}else{
	 				return back()->with('errormsj','¡Cliente relacionado con factura o cartera!');
	 			}

	 		
	 	}
}
