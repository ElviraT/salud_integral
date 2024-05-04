<?php

namespace App\Http\Controllers\Admin\configuracion\status;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StatusT;
use Flash;

class StatusTController extends Controller
{
   public function __construct()
    {
      $this->middleware('can:status_t')->only('index');
      $this->middleware('can:status_t.add')->only('add');
      $this->middleware('can:status_t.edit')->only('edit');
    }
    public function index(StatusT $model)
  	{   	
  		return view('admin.configuracion.status.statusT.index', ['statusts' => $model->all()]);
  	}
  	public function add (Request $request)
    {   
  
       if($request->id == 0){
            try {
                $statust= new StatusT();
                $statust->Tasa = ucfirst($request['nombre']);
                $statust->color = $request['color'];
                $statust->Nota = $request['nota'];
                $statust->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 StatusT::where('id_Status_Tasa', $id)->update([
                    'Tasa'=>ucfirst($request->nombre),
                    'color'=>$request->color,
                    'Nota'=>$request->nota,
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('status_t');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $statusts= StatusT::where('id_Status_Tasa','=', $id)->first();
        return response()->json([$statusts]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $statusts= StatusT::where('id_Status_Tasa', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('status_t');
    }
}
