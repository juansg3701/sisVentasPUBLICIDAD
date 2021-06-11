<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\RPedidos2;
use sisVentas\EmpresaCategoria;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RPedidos2FormRequest;
use DB;

class reportesPedidos2 extends Controller
{
	public function __construct(){
			$this->middleware('auth');	
	} 
	public function index(Request $request){
		if ($request) {
			$query=trim($request->get('searchText'));
	 		$sedes=DB::table('usuario')->where('nombre_sede','LIKE', '%'.$query.'%');

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 		$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();
	 			
	 		$reportes=DB::table('reportepedidos2')
	 		->orderBy('id_rPedidos','desc')->get();

	 		return view('almacen.reportes.pedidos2.pedidos',["sedes"=>$sedes,"searchText"=>$query, "modulos"=>$modulos, "reportes"=>$reportes]);
	 	}
	}



	public function store(RPedidos2FormRequest $request){

		$fechaInicialR=$request->get('fechaInicial');
	 		$fechaFinalR=$request->get('fechaFinal');

	 		if($fechaInicialR<=$fechaFinalR){

		$reporte = new RPedidos2;
	 	$reporte->fechaInicial=$fechaInicialR;
	 	$reporte->fechaFinal=$fechaFinalR;
	 	$reporte->fechaActual=$request->get('fechaActual');

	 	$no="SELECT SUM(df.cantidad) FROM detalle_factura as df,factura as f WHERE df.factura_id_factura=f.id_factura";

	 	$nop="SELECT SUM(pro.stock_minimo) FROM producto as pro";

	 	$reporte->noProductos=$nop;
		$reporte->total=$request->get('total');
 		$reporte->save();
	 			return back()->with('msj','Reporte guardado');
	 		}else{
	 			return back()->with('errormsj','¡Las fechas no son correctas!');
	 		}
	}
	public function update(Request $request,$id){
		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 	$modulos=DB::table('cargo_modulo')
	 	->where('id_cargo','=',$cargoUsuario)
	 	->orderBy('id_cargo', 'desc')->get();

	 	$inicio=$request->get('inicio');
	 	$fin=$request->get('fin');
	 	$tipo_reporte=$request->get('tipo_reporte');

	 	//dd($inicio.' '.$fin.' '.$tipo_reporte);

	 	if($inicio=="" || $fin=="" || $tipo_reporte==""){
	 		return back()->with('errormsj','¡¡Los datos deben estar completos!!');
	 	}else{
	 		if($inicio<=$fin){
	 			//codigo de reporte
	 			$pedidos=DB::table('t_p_cliente as tpc')
	 			->join('sede as sed','tpc.sede_id_sede','=','sed.id_sede')
	 			->join('empresa as em','tpc.empresa_pedido','=','em.id_empresa')
	 			->select('tpc.id_remision',
				 DB::raw('sum(tpc.noproductos) as noproductos'),DB::raw('count(tpc.id_remision) as numero_pedidos'), 'tpc.fecha_entrega as fecha','em.nombre as empresa','tpc.subempresa_pedido as subempresa')
	 			->where('tpc.fecha_solicitud','>=',$inicio)
	 			->where('tpc.fecha_solicitud','<=',$fin)
	 			->where('tpc.estado','=',$tipo_reporte)
	 			->orderBy('tpc.id_remision', 'asc')
	 			->groupBy('tpc.empresa_pedido')
	 			->get();

	 			$nombre_tipo_reporte="";
	 			foreach ($pedidos as $key => $value) {
	 				$pedidos[$key]->subempresa=self::nombre_subempresa($pedidos[$key]->subempresa);
	 				
	 			}
	 			switch ($tipo_reporte) {
	 					case '3':
	 						$nombre_tipo_reporte="Despachados";
	 						break;
	 					case '2':
	 						$nombre_tipo_reporte="Pendientes";
	 						break;	
	 				}

	 			return view("almacen.reportes.pedidos2.graficad2",["modulos"=>$modulos,"pedidos"=>$pedidos,"inicio"=>$inicio,"fin"=>$fin,"nombre_tipo_reporte"=>$nombre_tipo_reporte,"tipo_reporte"=>$tipo_reporte]);

	 		}else{
	 			return back()->with('errormsj','¡¡La fecha final debe ser mayor a la inicial!!');
	 		}
	 	}

	} 
	public function nombre_subempresa($id){
		$nombre="";
		if($id!=""){
			$subempresa= EmpresaCategoria::findOrFail($id);
			$nombre=$subempresa->nombre;
		}else{
			$nombre="No tiene";
		}
		return $nombre;
	}

	public function destroy($id){
	 	$reporte = RPedidos2::findOrFail($id);
	 	$reporte->delete();
	 	return back()->with('msj','Reporte eliminado');
	}


	public function downloadPDFReport($id){
		$cadena=$id;
		$separador = ".";
		$separada = explode($separador, $cadena);

		$inicio=0;
		$fin=0;
		$tipo_reporte=0;
		$valor=0;


		if(count($separada)==4){

			$inicio=$separada[0];
			$fin=$separada[1];
			$tipo_reporte=$separada[2];
			$valor=$separada[3];
		}
		
		//dd($inicio.' '.$fin.' '.$tipo_reporte);

		$pedidos=DB::table('t_p_cliente as tpc')
	 	->join('sede as sed','tpc.sede_id_sede','=','sed.id_sede')
	 	->join('empresa as em','tpc.empresa_pedido','=','em.id_empresa')
	 	->select('tpc.id_remision',DB::raw('sum(tpc.noproductos) as noproductos'),DB::raw('count(tpc.id_remision) as numero_pedidos'), 'tpc.fecha_entrega as fecha','em.nombre as empresa','tpc.subempresa_pedido as subempresa')
	 	->where('tpc.fecha_solicitud','>=',$inicio)
	 	->where('tpc.fecha_solicitud','<=',$fin)
	 	->where('tpc.estado','=',$tipo_reporte)
		->orderBy('tpc.id_remision', 'asc')
		->groupBy('tpc.empresa_pedido')
	 	->get();

		$nombre_tipo_reporte="";
		foreach ($pedidos as $key => $value) {
			 $pedidos[$key]->subempresa=self::nombre_subempresa($pedidos[$key]->subempresa);	 
		}
		switch ($tipo_reporte) {
			case '3':
				$nombre_tipo_reporte="Despachados";
			break;
			case '2':
				$nombre_tipo_reporte="Pendientes";
			break;	
		}

		return view('almacen.reportes.pedidos2.reportePDF.pdf',["inicio"=>$inicio, "fin"=>$fin, "tipo_reporte"=>$tipo_reporte, "pedidos"=>$pedidos,"nombre_tipo_reporte"=>$nombre_tipo_reporte]);

	}


	public function downloadExcelReport($id){
		$cadena=$id;
		$separador = ".";
		$separada = explode($separador, $cadena);

		$inicio=0;
		$fin=0;
		$tipo_reporte=0;
		$valor=0;


		if(count($separada)==4){

			$inicio=$separada[0];
			$fin=$separada[1];
			$tipo_reporte=$separada[2];
			$valor=$separada[3];
		}
		
		//dd($inicio.' '.$fin.' '.$tipo_reporte);

		$pedidos=DB::table('t_p_cliente as tpc')
	 	->join('sede as sed','tpc.sede_id_sede','=','sed.id_sede')
	 	->join('empresa as em','tpc.empresa_pedido','=','em.id_empresa')
	 	->select('tpc.id_remision',DB::raw('sum(tpc.noproductos) as noproductos'),DB::raw('count(tpc.id_remision) as numero_pedidos'), 'tpc.fecha_entrega as fecha','em.nombre as empresa','tpc.subempresa_pedido as subempresa')
	 	->where('tpc.fecha_solicitud','>=',$inicio)
	 	->where('tpc.fecha_solicitud','<=',$fin)
	 	->where('tpc.estado','=',$tipo_reporte)
		->orderBy('tpc.id_remision', 'asc')
		->groupBy('tpc.empresa_pedido')
	 	->get();

		$nombre_tipo_reporte="";
		foreach ($pedidos as $key => $value) {
			 $pedidos[$key]->subempresa=self::nombre_subempresa($pedidos[$key]->subempresa);	 
		}
		switch ($tipo_reporte) {
			case '3':
				$nombre_tipo_reporte="Despachados";
			break;
			case '2':
				$nombre_tipo_reporte="Pendientes";
			break;	
		}

		return view('almacen.reportes.pedidos2.reporteExcel.excel',["inicio"=>$inicio, "fin"=>$fin, "tipo_reporte"=>$tipo_reporte, "pedidos"=>$pedidos,"nombre_tipo_reporte"=>$nombre_tipo_reporte]);
	}

	 
}


	 

