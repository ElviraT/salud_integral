<?php

namespace App\Http\Controllers\Admin\configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use App\Model\EntidadesUSD;
use App\Model\Status;
use Flash;

class EntidadesUSDController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:entidad')->only('index');
      $this->middleware('can:entidad.add')->only('add');
      $this->middleware('can:entidad.edit')->only('edit');
      $this->middleware('can:entidad.destroy')->only('destroy');
    }
    public function index(EntidadesUSD $model)
  	{   
  		$status=Collection::make(Status::select(['id_Status','Status'])->orderBy('Status')->get())->pluck("Status", "id_Status"); 	
  		return view('admin.configuracion.entidades.index', ['entidades' => $model->all(),'status'=>$status]);
  	}
  	public function add (Request $request)
    {   
  
       if($request->id == 0){
            try {
                $entidad= new EntidadesUSD();
                $entidad->Entidad_USD = ucfirst($request['nombre']);
                $entidad->Status_id = $request['status'];
                $entidad->Referencia = $request['referencia'];
                $entidad->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 EntidadesUSD::where('id_Entidad_USD', $id)->update([
                    'Entidad_USD'=>ucfirst($request->nombre),
                    'Status_id'=>$request->status,
                    'Referencia'=>$request->referencia,
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('entidad');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $entidades= EntidadesUSD::where('id_Entidad_USD', $id)->first();
        return response()->json([$entidades]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $entidad= EntidadesUSD::where('id_Entidad_USD', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('entidad');
    }
}
