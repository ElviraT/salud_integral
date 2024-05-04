<?php

namespace App\Http\Controllers\Admin\configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use App\Model\CuentaBanco;
use App\Model\Status;
use App\Model\Banco;
use App\Model\UsuarioM;
use App\Model\TipoCuenta;
use Flash;
use DB;

class CuentaBancoController extends Controller
{
   public function __construct()
    {
      $this->middleware('can:cuenta_banco')->only('index');
      $this->middleware('can:cuenta_banco.add')->only('add');
      $this->middleware('can:cuenta_banco.edit')->only('edit');
      $this->middleware('can:cuenta_banco.destroy')->only('destroy');
    }
    public function index(CuentaBanco $model)
  	{   
  		$status=Collection::make(Status::select(['id_Status','Status'])->orderBy('Status')->get())->pluck("Status", "id_Status"); 	
      $banco=Collection::make(Banco::select(['id_Bancos_Bs','Bancos'])->where('Status_Id',1)->orderBy('Bancos')->get())->pluck("Bancos", "id_Bancos_Bs");   
  		$tipo=Collection::make(TipoCuenta::select(['id_Cuenta','descripcion'])->orderBy('descripcion')->get())->pluck("descripcion", "id_Cuenta"); 
      	
  		$medico=Collection::make(UsuarioM::select(['id_Medico',DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->orderBy('Nombres_Medico')->pluck("Nombre", "id_Medico"));

  		return view('admin.configuracion.cuenta_bancos.index', ['cuenta_bancos' => $model->all(),'status'=>$status, 'banco' => $banco, 'medico' => $medico, 'tipo' => $tipo]);
  	}
  	public function add (Request $request)
    {   
  
       if($request->id == 0){
            try {
                $cuenta_banco= new CuentaBanco();
                $cuenta_banco->Banco_id = $request['banco'];
                $cuenta_banco->Medico_id = $request['medico'];
                $cuenta_banco->Status_id = $request['status'];
                $cuenta_banco->Numero_Cuenta = $request['numero'];
                $cuenta_banco->Tipo = $request['tipo'];
                $cuenta_banco->Fecha = $request['fecha'];
                $cuenta_banco->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error($e.'Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 CuentaBanco::where('id_Cuenta_Bancaria_BS', $id)->update([
                    'Banco_id'=>$request->banco,
                    'Medico_id'=>$request->medico,
                    'Status_id'=>$request->status,
                    'Numero_Cuenta'=>$request->numero,
                    'Tipo'=>$request->tipo,
                    'Fecha'=>$request->fecha,
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error($e.'Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('cuenta_banco');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $cuenta_bancos= CuentaBanco::where('id_Cuenta_Bancaria_BS','=', $id)->first();
        return response()->json([$cuenta_bancos]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $cuenta_bancos= CuentaBanco::where('id_Cuenta_Bancaria_BS', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('cuenta_banco');
    }
}
