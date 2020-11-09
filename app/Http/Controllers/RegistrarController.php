<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\User;
use sisVentas\Usuario;
use sisVentas\Cliente;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\UsersFormRequest;
use DB;

class RegistrarController extends Controller
{
	    public function __construct(){
			$this->middleware('auth');	

			 	}
	//Redirige para registrar los usuarios
	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$cargos=DB::table('tipo_cargo')->get();
	 			$sedes=DB::table('sede')->get();
	 			$usuarios=DB::table('empleado as u')
	 			->join('tipo_cargo as c','u.tipo_cargo_id_cargo','=','c.id_cargo')
	 			->join('sede as s','u.sede_id_sede','=','s.id_sede')
	 			->select('u.id_empleado','u.nombre','u.correo','c.nombre as tipo_cargo','s.nombre_sede as sede','u.codigo')
	 			->where('u.nombre','LIKE', '%'.$query.'%')
	 			->orderBy('u.id_empleado', 'desc')
	 			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			

	 			return view('almacen.usuario.registrar.index',["cargos"=>$cargos,"sedes"=>$sedes, "usuarios"=>$usuarios,"searchText"=>$query, "modulos"=>$modulos]);
	 		}
	 	}

	 	public function create(){ 

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 				
	 		return view("almacen.usuario.iniciar.sesionIniciada", ["modulos"=>$modulos]);	
	 	}

	 	//Registrar usuarios sean empleados o clientes
	 	public function store(Request $request){

	 		$nombreR=$request->get('name');
	 		$correoR=$request->get('email');
	 		$contrasenaR=$request->get('password');
	 		$cargoR=$request->get('tipo_cargo_id_cargo');
	 		$sedeR=$request->get('sede_id_sede');
	 		$codigoR=$request->get('codigo');
	 		$tipo_cuentaR=$request->get('tipo_cuenta');
	 		$documentoR=$request->get('documento');

	 		$CorreoRegis=DB::table('empleado')
	 		->where('correo','=',$correoR)
	 		->orderBy('id_empleado','desc')->get();

	 		$CodigoRegis=DB::table('empleado')
	 		->where('codigo','=',$codigoR)
	 		->orderBy('id_empleado','desc')->get();

	 		$documentoE=DB::table('cliente')
	 		->where('documento','=',$documentoR)
	 		->orderBy('id_cliente','desc')->get();

	 		if(count($CorreoRegis)==0){
	 			if(count($CodigoRegis)==0){
	 				if(count($documentoE)==0){

	 				$usuario = new User;
			 		$usuario->name=$nombreR;
			 		$usuario->email=$correoR;
			 		$usuario->password=bcrypt($contrasenaR);
			 		$usuario->tipo_cargo_id_cargo=$cargoR;
			 		$usuario->sede_id_sede=$sedeR;
			 		$usuario->superusuario=$request->get('superusuario');
			 		$usuario->tipo_cuenta=$tipo_cuentaR;
			 		$usuario->save();

	 				if($tipo_cuentaR==0){


			 		$empleadoU= new Usuario;
			 		$empleadoU->nombre=$nombreR;
			 		$empleadoU->user_id_user=$usuario->id;
			 		$empleadoU->correo=$correoR;	
			 		$empleadoU->tipo_cargo_id_cargo=$cargoR;
			 		$empleadoU->sede_id_sede=$sedeR;
			 		$empleadoU->codigo=$codigoR;
			 		$empleadoU->direccion=$request->get('direccion');
			 		$empleadoU->telefono=$request->get('telefono');
			 		$empleadoU->documento=$request->get('documento');
			 		$empleadoU->fecha=$request->get('fecha');
			 		$empleadoU->save();
	 				}else{

	 				$cliente = new Cliente;
			 		$cliente->nombre=$nombreR;
			 		$cliente->user_id_user=$usuario->id;
			 		$cliente->tipo_cargo_id_cargo=$cargoR;
			 		$cliente->sede_id_sede=$sedeR;
			 		$cliente->direccion=$request->get('direccion');
			 		$cliente->telefono=$request->get('telefono');
			 		$cliente->documento=$request->get('documento');
			 		$cliente->empresa_categoria_id=$request->get('empresa_categoria_id');
			 		$cliente->verificacion_nit=$request->get('verificacion_nit');
			 		$cliente->empresa_id_empresa=$request->get('empresa_id_empresa');
			 		$cliente->fecha=$request->get('fecha');
			 		$cliente->save();	
	 				}
	 				
   	
					return back()->with('msj','Usuario guardado');
					}else{
	 					return back()->with('errormsj','¡NIT ya registrado!');	
	 				}
	 			}else{
	 				return back()->with('errormsj','¡Código ya registrado!');
	 			}
	 		}else{
	 				return back()->with('errormsj','¡Correo ya registrado!');
	 		}
	 		
	 		
	 	}


	
	 	public function update(UsersFormRequest $request, $id){
	 		$usuario = User::findOrFail($id);
	 		$usuario->name=$request->get('name');
	 		$usuario->email=$request->get('email');
	 		$usuario->password=bcrypt($request->get('password'));
	 		$usuario->tipo_cargo_id_cargo=$request->get('tipo_cargo_id_cargo');
	 		$usuario->sede_id_sede=$request->get('sede_id_sede');
	 		$usuario->update();
   	
			return Redirect::to('almacen/usuario/registrar');
	 		
	 	}

	 	
	 	public function show($id){
	 		return view("almacen.usuario.registrar.index.show",["usuario"=>Usuario::findOrFail($id)]);
	 	}


	 
}
