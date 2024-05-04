<?php

namespace App\Http\Controllers\Admin\configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use App\Model\CuentaUSD;
use App\Model\Status;
use App\Model\EntidadesUSD;
use App\Model\UsuarioM;
use App\Model\TipoCuenta;
use Flash;
use DB;
class CuentaUSDController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:cuentaUSD')->only('index');
      $this->middleware('can:cuentaUSD.add')->only('add');
      $this->middleware('can:cuentaUSD.edit')->only('edit');
      $this->middleware('can:cuentaUSD.destroy')->only('destroy');
    }
    public function index(CuentaUSD $model)
  	{   
  		$status=Collection::make(Status::select(['id_Status','Status'])->orderBy('Status')->get())->pluck("Status", "id_Status"); 	
      $entidades=Collection::make(EntidadesUSD::select(['id_Entidad_USD','Entidad_USD'])->where('Status_id',1)->orderBy('Entidad_USD')->get())->pluck("Entidad_USD", "id_Entidad_USD");   
  		$tipo=Collection::make(TipoCuenta::select(['id_Cuenta','descripcion'])->orderBy('descripcion')->get())->pluck("descripcion", "id_Cuenta"); 
      	
  		$medico=Collection::make(UsuarioM::select(['id_Medico',DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->orderBy('Nombres_Medico')->pluck("Nombre", "id_Medico"));

  		return view('admin.configuracion.cuentas.index', ['cuentas' => $model->all(),'status'=>$status, 'entidades' => $entidades, 'medico' => $medico, 'tipo' => $tipo]);
  	}
  	public function add (Request $request)
    {   
  
       if($request->id == 0){
            try {
                $cuentaUSD= new CuentaUSD();
                $cuentaUSD->Entidad_USD_id = $request['entidad'];
                $cuentaUSD->Medico_id = $request['medico'];
                $cuentaUSD->Status_Pago = $request['status'];
                $cuentaUSD->Numero_Cuenta = $request['numero'];
                $cuentaUSD->Tipo = $request['tipo'];
                $cuentaUSD->Fecha = $request['fecha'];
                $cuentaUSD->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error($e.'Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 CuentaUSD::where('id_Cuenta_USD', $id)->update([
                    'Entidad_USD_id'=>$request->entidad,
                    'Medico_id'=>$request->medico,
                    'Status_Pago'=>$request->status,
                    'Numero_Cuenta'=>$request->numero,
                    'Tipo'=>$request->tipo,
                    'Fecha'=>$request->fecha,
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('cuentaUSD');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $cuenta= CuentaUSD::where('id_Cuenta_USD','=', $id)->first();
        return response()->json([$cuenta]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $cuenta= CuentaUSD::where('id_Cuenta_USD', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('cuentaUSD');
    }
}
