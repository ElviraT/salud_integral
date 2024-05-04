<?php

namespace App\Http\Controllers\Admin\configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use App\Model\Billetera;
use App\Model\Status;
use App\Model\Cripto;
use App\Model\UsuarioM;
use Flash;
use DB;

class BilleteraCriptosController extends Controller
{
   public function __construct()
    {
      $this->middleware('can:billetera')->only('index');
      $this->middleware('can:billetera.add')->only('add');
      $this->middleware('can:billetera.edit')->only('edit');
      $this->middleware('can:billetera.destroy')->only('destroy');
    }
    public function index(Billetera $model)
  	{   
  		$status=Collection::make(Status::select(['id_Status','Status'])->orderBy('Status')->get())->pluck("Status", "id_Status"); 	
  		$cripto=Collection::make(Cripto::select(['id_Cripto','Criptop'])->where('Status_id',1)->orderBy('Criptop')->get())->pluck("Criptop", "id_Cripto"); 	
  		$medico=Collection::make(UsuarioM::select(['id_Medico',DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->orderBy('Nombres_Medico')->pluck("Nombre", "id_Medico"));

  		return view('admin.configuracion.billeteras.index', ['billeteras' => $model->all(),'status'=>$status, 'cripto' => $cripto, 'medico' => $medico]);
  	}
  	public function add (Request $request)
    {   
  
       if($request->id == 0){
            try {
                $billetera= new Billetera();
                $billetera->Billetera = ucfirst($request['nombre']);
                $billetera->Status_Id = $request['status'];
                $billetera->Medicos_id = $request['medico'];
                $billetera->Cripto_id = $request['cripto'];
                $billetera->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 Billetera::where('id_Billetera_Cripto', $id)->update([
                    'Billetera'=>ucfirst($request->nombre),
                    'Status_Id'=>$request->status,
                    'Medicos_id'=>$request->medico,
                    'Cripto_id'=>$request->cripto,
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('billetera');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $billeteras= Billetera::where('id_Billetera_Cripto','=', $id)->first();
        return response()->json([$billeteras]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $billeteras= Billetera::where('id_Billetera_Cripto', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('billetera');
    }
}
