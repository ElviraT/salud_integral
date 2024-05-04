<?php

namespace App\Http\Controllers\Admin\configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use App\Model\Consultorio;
use App\Model\Especialidad;
use App\Model\Ciudad;
use App\Model\Estado;
use App\Model\Municipio;
use App\Model\Parroquia;
use App\Model\Status;
use Flash;

class ConsultorioController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:consultorio')->only('index');
      $this->middleware('can:consultorio.add')->only('add');
      $this->middleware('can:consultorio.edit')->only('edit');
      $this->middleware('can:consultorio.destroy')->only('destroy');
    }
    public function index(Consultorio $model)
  	{   
  		$especialidad=Collection::make(Especialidad::select(['id_Especialidad_Medica','Espacialiadad_Medica'])->orderBy('Espacialiadad_Medica')->get())->pluck("Espacialiadad_Medica", "id_Especialidad_Medica"); 
  		
  		$estado=Collection::make(Estado::select(['id_Estado','Estado'])->orderBy('Estado')->get())->pluck("Estado", "id_Estado"); 
  		
  		$status=Collection::make(Status::select(['id_Status','Status'])->orderBy('Status')->get())->pluck("Status", "id_Status"); 

      $ciudad=Collection::make(Ciudad::select(['id_Ciudad','Ciudad'])->orderBy('Ciudad')->get())->pluck("Ciudad", "id_Ciudad"); 
      $municipio=Collection::make(Municipio::select(['id_Municipio','Municipio'])->orderBy('Municipio')->get())->pluck("Municipio", "id_Municipio"); 
      $parroquia=Collection::make(Parroquia::select(['id_Parroquia','Parroquia'])->orderBy('Parroquia')->get())->pluck("Parroquia", "id_Parroquia");

  		return view('admin.configuracion.consultorios.index', ['consultorios' => $model->all(),'status'=>$status,'especialidad'=>$especialidad,'estado'=>$estado,'ciudad'=>$ciudad,'municipio'=>$municipio,'parroquia'=>$parroquia]);
  	}
  	public function add (Request $request)
    {   
  
       if($request->id == 0){
            try {
                $consultorio= new Consultorio();
                $consultorio->Direccion = ucfirst($request['direccion']);
                $consultorio->Local = $request['local'];
                $consultorio->Telefono = $request['telefono'];
                $consultorio->Celular = $request['celular'];
                $consultorio->Correo = $request['correo'];
                $consultorio->Especialidad_Medica_id = $request['especialidad'];
                $consultorio->Ciudad_id = $request['ciudad'];
                $consultorio->Estado_id = $request['estado'];
                $consultorio->Municipio_id = $request['municipio'];
                $consultorio->Parroquia_id = $request['parroquia'];
                $consultorio->Status_Id = $request['status'];
                $consultorio->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 Consultorio::where('id_Consultorio', $id)->update([
                    'Direccion' => ucfirst($request['direccion']),
	                'Local' => $request['local'],
	                'Telefono' => $request['telefono'],
	                'Celular' => $request['celular'],
	                'Correo' => $request['correo'],
	                'Especialidad_Medica_id' => $request['especialidad'],
	                'Ciudad_id' => $request['ciudad'],
	                'Estado_id' => $request['estado'],
	                'Municipio_id' => $request['municipio'],
	                'Parroquia_id' => $request['parroquia'],
	                'Status_Id' => $request['status'],
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('consultorio');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $consultorio= Consultorio::where('id_Consultorio','=', $id)->first();
        return response()->json([$consultorio]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $consultorio= Consultorio::where('id_Consultorio', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('consultorio');
    }
}
