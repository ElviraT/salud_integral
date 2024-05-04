<?php

namespace App\Http\Controllers\Admin\configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use App\Model\TipoCambio;
use App\Model\StatusT;
use Flash;

class TasaCambioController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:tcambio')->only('index');
      $this->middleware('can:tcambio.add')->only('add');
      $this->middleware('can:tcambio.edit')->only('edit');
      $this->middleware('can:tcambio.destroy')->only('destroy');
    }
    public function index(TipoCambio $model)
  	{   
  		$status=Collection::make(StatusT::select(['id_Status_Tasa','Tasa'])->orderBy('Tasa')->get())->pluck("Tasa", "id_Status_Tasa"); 	
  		return view('admin.tcambios.index', ['tcambios' => $model->all(),'status'=>$status]);
  	}
  	public function add (Request $request)
    {   
  
       if($request->id == 0){
            try {
                $tcambio= new TipoCambio();
                $tcambio->BS = $request['bs'];
                $tcambio->USD = $request['usd'];
                $tcambio->BitCoins = $request['btc'];
                $tcambio->Ethereum = $request['eth'];
                $tcambio->Fecha = $request['fecha'];
                $tcambio->Status_Tasa_id = $request['status'];
                $tcambio->save();

                if($request->status == 1){
                      TipoCambio::where('id_Tasa_Cambio','<>',$tcambio->id)->update([
                            'Status_Tasa_id'=>2,
                        ]);
                }

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 TipoCambio::where('id_Tasa_Cambio', $id)->update([
                    'BS'=>$request->bs,
                    'USD'=>$request->usd,
                    'BitCoins'=>$request->btc,
                    'Ethereum'=>$request->eth,
                    'Fecha'=>$request->fecha,
                    'Status_Tasa_id'=>$request->status,
                ]);

                 if($request->status == 1){
                      TipoCambio::where('id_Tasa_Cambio','<>',$id)->update([
                            'Status_Tasa_id'=>2,
                        ]);
                }

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('tcambio');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $tcambio= TipoCambio::where('id_Tasa_Cambio', $id)->first();
        return response()->json([$tcambio]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
        TipoCambio::where('id_Tasa_Cambio', $id)->update(['Status_Tasa_id'=>2]);
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('tcambio');
    }
}
