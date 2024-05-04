<?php

namespace App\Http\Controllers\Admin\configuracion\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\DireccionPaciente;
use Flash;

class DireccionPController extends Controller
{
	public function __construct()
    {
      $this->middleware('can:usuario_p.add')->only('add');
      $this->middleware('can:usuario_p.edit')->only('edit','update');
    }
    public function add(Request $request)
    {
    	if($request->id == 0){
        try {
            $direccion= new DireccionPaciente();
            $direccion->Paciente_id = $request['idP'];
            $direccion->Direccion = ucfirst($request['direccion']);
            $direccion->Numero_Casa = $request['ncasa'];
            $direccion->Telefono = $request['telefono'];
            $direccion->Celular = $request['celular'];
            $direccion->Correo = $request['correo'];
            $direccion->Cuidad_id = $request['ciudad'];
            $direccion->Estado_id = $request['estado'];
            $direccion->Municipio_id = $request['municipio'];
            $direccion->Parroquia_id = $request['parroquia'];
            $direccion->save();            
            
            Flash::success("Registro Agregado Correctamente");            
        return redirect()->route('usuario_p.edit', $request['idP']);
        } catch (\Illuminate\Database\QueryException $e) {
            Flash::error($e.'Ocurrió un error, por favor intente de nuevo');
            return redirect()->route('usuario_p.create');
        }
      }else{
        try{
                $id = (int)$request->id;
                 DireccionPaciente::where('id_Direccion_Paciente', $id)->update([
                'Paciente_id' => $request['idP'],
                'Direccion' => ucfirst($request['direccion']),
                'Numero_Casa' => $request['ncasa'],
                'Telefono' => $request['telefono'],
                'Celular' => $request['celular'],
                'Correo' => $request['correo'],
                'Cuidad_id' => $request['ciudad'],
                'Estado_id' => $request['estado'],
                'Municipio_id' => $request['municipio'],
                'Parroquia_id' => $request['parroquia'],
                ]);

                Flash::success("Registro Actualizado Correctamente");

            }catch(\Illuminate\Database\QueryException $e) {
              Flash::error($e.'Ocurrió un error, por favor intente de nuevo'); 
            }
            return redirect()->route('usuario_p.edit', $request['idP']);
      }
    }
}
