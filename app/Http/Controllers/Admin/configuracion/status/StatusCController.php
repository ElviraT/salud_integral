<?php

namespace App\Http\Controllers\Admin\configuracion\status;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StatusC;
use Flash;

class StatusCController extends Controller
{
  public function __construct()
    {
      $this->middleware('can:status_c')->only('index');
      $this->middleware('can:status_c.add')->only('add');
      $this->middleware('can:status_c.edit')->only('edit');
    }
   public function index(StatusC $model)
  	{   	
  		return view('admin.configuracion.status.statusC.index', ['statuscs' => $model->all()]);
  	}
  	public function add (Request $request)
    {   
  
       if($request->id == 0){
            try {
                $statusc= new StatusC();
                $statusc->Consulta = ucfirst($request['nombre']);
                $statusc->color = $request['color'];
                $statusc->Nota = $request['nota'];
                $statusc->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 StatusC::where('id_Consulta', $id)->update([
                    'Consulta'=>ucfirst($request->nombre),
                    'color'=>$request->color,
                    'Nota'=>$request->nota,
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('status_c');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $statuscs= StatusC::where('id_Consulta','=', $id)->first();
        return response()->json([$statuscs]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $statuscs= StatusC::where('id_Consulta', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('status_c');
    }
}
