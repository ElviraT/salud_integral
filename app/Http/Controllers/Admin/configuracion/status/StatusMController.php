<?php

namespace App\Http\Controllers\Admin\configuracion\status;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StatusM;
use Flash;

class StatusMController extends Controller
{
   public function __construct()
    {
      $this->middleware('can:status_m')->only('index');
      $this->middleware('can:status_m.add')->only('add');
      $this->middleware('can:status_m.edit')->only('edit');
    }
    public function index(StatusM $model)
  	{   	
  		return view('admin.configuracion.status.statusM.index', ['statusms' => $model->all()]);
  	}
  	public function add (Request $request)
    {   
  
       if($request->id == 0){
            try {
                $statusm= new StatusM();
                $statusm->Status_Medico = ucfirst($request['nombre']);
                $statusm->color = $request['color'];
                $statusm->Nota = $request['nota'];
                $statusm->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 StatusM::where('id_Status_Medico', $id)->update([
                    'Status_Medico'=>ucfirst($request->nombre),
                    'color'=>$request->color,
                    'Nota'=>$request->nota,
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('status_m');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $statusMs= StatusM::where('id_Status_Medico','=', $id)->first();
        return response()->json([$statusMs]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $statusMs= StatusM::where('id_Status_Medico', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('status_m');
    }
}
