<?php

namespace App\Http\Controllers\Admin\configuracion\status;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StatusF;
use Flash;

class StatusFController extends Controller
{
   public function __construct()
    {
      $this->middleware('can:status_f')->only('index');
      $this->middleware('can:status_f.add')->only('add');
      $this->middleware('can:status_f.edit')->only('edit');
    }
    public function index(StatusF $model)
  	{   	
  		return view('admin.configuracion.status.statusF.index', ['statusfs' => $model->all()]);
  	}
  	public function add (Request $request)
    {   
  
       if($request->id == 0){
            try {
                $statusf= new StatusF();
                $statusf->Status_Factura = ucfirst($request['nombre']);
                $statusf->color = $request['color'];
                $statusf->Nota = $request['nota'];
                $statusf->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 StatusF::where('id_Status_Factura', $id)->update([
                    'Status_Factura'=>ucfirst($request->nombre),
                    'color'=>$request->color,
                    'Nota'=>$request->nota,
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('status_f');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $statusfs= StatusF::where('id_Status_Factura','=', $id)->first();
        return response()->json([$statusfs]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $statusfs= StatusF::where('id_Status_Factura', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('status_f');
    }
}
