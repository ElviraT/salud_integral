<?php

namespace App\Http\Controllers\Admin\configuracion\status;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Status;
use Flash;

class StatusController extends Controller
{
   public function __construct()
    {
      $this->middleware('can:status')->only('index');
      $this->middleware('can:status.add')->only('add');
      $this->middleware('can:status.edit')->only('edit');
    }
    public function index(Status $model)
  	{   	
  		return view('admin.configuracion.status.status.index', ['status' => $model->all()]);
  	}
  	public function add (Request $request)
    {   
  
       if($request->id == 0){
            try {
                $statu= new Status();
                $statu->Status = ucfirst($request['nombre']);
                $statu->color = $request['color'];
                $statu->Nota = $request['nota'];
                $statu->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 Status::where('id_Status', $id)->update([
                    'Status'=>ucfirst($request->nombre),
                    'color'=>$request->color,
                    'Nota'=>$request->nota,
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('status');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $status= Status::where('id_Status','=', $id)->first();
        return response()->json([$status]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $status= Status::where('id_Status', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('status');
    }
}
