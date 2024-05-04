<?php

namespace App\Http\Controllers\Admin\configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\TipoCuenta;
use Flash;

class TipoCuentaController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:tipoC')->only('index');
      $this->middleware('can:tipoC.add')->only('add');
      $this->middleware('can:tipoC.edit')->only('edit');
      $this->middleware('can:tipoC.destroy')->only('destroy');
    }
    public function index(TipoCuenta $model)
  	{    	
  		return view('admin.configuracion.tipoCs.index', ['tipoCs' => $model->all()]);
  	}
  	public function add (Request $request)
    {   
  
       if($request->id == 0){
            try {
                $tipoC= new TipoCuenta();
                $tipoC->descripcion = ucfirst($request['nombre']);
                $tipoC->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 TipoCuenta::where('id_Cuenta', $id)->update([
                    'descripcion'=>ucfirst($request->nombre),
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('tipoC');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $tipoCians= TipoCuenta::where('id_Cuenta', $id)->first();
        return response()->json([$tipoCians]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $tipoCians= TipoCuenta::where('id_Cuenta', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('tipoC');
    }
}
