<?php

namespace App\Http\Controllers\Admin\configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use App\Model\Cripto;
use App\Model\Status;
use Flash;

class CriptosController extends Controller
{
     public function __construct()
    {
      $this->middleware('can:cripto')->only('index');
      $this->middleware('can:cripto.add')->only('add');
      $this->middleware('can:cripto.edit')->only('edit');
      $this->middleware('can:cripto.destroy')->only('destroy');
    }
    public function index(Cripto $model)
  	{   
  		$status=Collection::make(Status::select(['id_Status','Status'])->orderBy('Status')->get())->pluck("Status", "id_Status"); 	
  		return view('admin.configuracion.criptos.index', ['criptos' => $model->all(),'status'=>$status]);
  	}
  	public function add (Request $request)
    {   
  
       if($request->id == 0){
            try {
                $cripto= new Cripto();
                $cripto->Criptop = ucfirst($request['nombre']);
                $cripto->Siglas = $request['siglas'];
                $cripto->Status_id = $request['status'];
                $cripto->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error($e.'Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 Cripto::where('id_Cripto', $id)->update([
                    'Criptop'=>ucfirst($request->nombre),
                    'Siglas'=>$request->siglas,
                    'Status_id'=>$request->status,
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('cripto');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $criptos= Cripto::where('id_Cripto','=', $id)->first();
        return response()->json([$criptos]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $criptos= Cripto::where('id_Cripto', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('cripto');
    }
}
