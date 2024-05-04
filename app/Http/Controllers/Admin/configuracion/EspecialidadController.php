<?php

namespace App\Http\Controllers\Admin\configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use App\Model\Especialidad;
use Flash;


class EspecialidadController extends Controller
{
     public function __construct()
    {
      $this->middleware('can:especialidad')->only('index');
      $this->middleware('can:especialidad.add')->only('add');
      $this->middleware('can:especialidad.edit')->only('edit');
      $this->middleware('can:especialidad.destroy')->only('destroy');
    }
    public function index(Especialidad $model)
  	{   
  		return view('admin.configuracion.especialidades.index', ['especialidades' => $model->all()]);
  	}
  	public function add (Request $request)
    {   
  
       if($request->id == 0){
            try {
                $especialidad= new Especialidad();
                $especialidad->Espacialiadad_Medica = ucfirst($request['nombre']);
                $especialidad->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error($e.'Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 Especialidad::where('id_Especialidad_Medica', $id)->update([
                    'Espacialiadad_Medica'=>ucfirst($request->nombre),
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('especialidad');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $especial= Especialidad::where('id_Especialidad_Medica', $id)->first();
        return response()->json([$especial]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $especial= Especialidad::where('id_Especialidad_Medica', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('especialidad');
    }
}
