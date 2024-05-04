<?php

namespace App\Http\Controllers\Admin\configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\TipoPago;
use Flash;

class TipoPagoController extends Controller
{
   public function __construct()
    {
      $this->middleware('can:tpago')->only('index');
      $this->middleware('can:tpago.add')->only('add');
      $this->middleware('can:tpago.edit')->only('edit');
      $this->middleware('can:tpago.destroy')->only('destroy');
    }
    public function index(TipoPago $model)
  	{   	
  		return view('admin.configuracion.tpagos.index', ['tpagos' => $model->all()]);
  	}
  	public function add (Request $request)
    {   
  
       if($request->id == 0){
            try {
                $tpago= new TipoPago();
                $tpago->Tipo_Pago = ucfirst($request['nombre']);
                $tpago->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 TipoPago::where('id_Tipos_Pago', $id)->update([
                    'Tipo_Pago'=>ucfirst($request->nombre),
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('tpago');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');
        $tpagos= TipoPago::where('id_Tipos_Pago', $id)->first();
        return response()->json([$tpagos]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $tpagos= TipoPago::where('id_Tipos_Pago', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('tpago');
    }
}
