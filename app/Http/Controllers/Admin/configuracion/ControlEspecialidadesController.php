<?php

namespace App\Http\Controllers\Admin\configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use App\Model\ControlEspecialidades;
use App\Model\Especialidad;
use App\Model\StatusM;
use App\Model\UsuarioM;
use Flash;
use DB;

class ControlEspecialidadesController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:controlE')->only('index');
      $this->middleware('can:controlE.add')->only('add');
      $this->middleware('can:controlE.edit')->only('edit');
      $this->middleware('can:controlE.destroy')->only('destroy');
    }
    public function index(ControlEspecialidades $model)
  	{   
  		$especialidad=Collection::make(Especialidad::select(['id_Especialidad_Medica','Espacialiadad_Medica'])->orderBy('Espacialiadad_Medica')->get())->pluck("Espacialiadad_Medica", "id_Especialidad_Medica"); 
      if(auth()->user()->name == 'Admin'){
         $medico=Collection::make(UsuarioM::select(['id_Medico',DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->where('Status_Medico_id',1)->orderBy('Nombres_Medico')->pluck("Nombre", "id_Medico"));

      }else{
          $medico=Collection::make(UsuarioM::select(['id_Medico',DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->where('Status_Medico_id',1)->where('id_Medico',auth()->user()->id_usuario)->orderBy('Nombres_Medico')->pluck("Nombre", "id_Medico"));

      }
  		
  		$statusM=Collection::make(StatusM::select(['id_Status_Medico','Status_Medico'])->orderBy('Status_Medico')->get())->pluck("Status_Medico", "id_Status_Medico"); 

      if(auth()->user()->name == 'Admin'){
          $controlEs = ControlEspecialidades::all();
      }else{
          $controlEs = ControlEspecialidades::where('Medico_id', auth()->user()->id_usuario)->get();
      } 
  		return view('admin.configuracion.controlEs.index', ['controlEs' => $controlEs,'statusM'=>$statusM,'especialidad'=>$especialidad,'medico'=>$medico]);
  	}
  	public function add (Request $request)
    {   
  
       if($request->id == 0){
            try {
                $controlE= new ControlEspecialidades();
                $controlE->Medico_id = $request['medico'];
                $controlE->Especialidades_Medicas_id = $request['especialidad'];
                $controlE->Status_Medico_id = $request['status'];
                $controlE->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 ControlEspecialidades::where('id_Control_Especialidad', $id)->update([
	                'Medico_id' => $request['medico'],
	                'Especialidades_Medicas_id' => $request['especialidad'],
	                'Status_Medico_id' => $request['status'],
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('controlE');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $controlE= ControlEspecialidades::where('id_Control_Especialidad','=', $id)->first();
        return response()->json([$controlE]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $controlE= ControlEspecialidades::where('id_Control_Especialidad', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('controlE');
    }
}
