<?php

namespace App\Http\Controllers\Admin\configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Civil;
use Flash;

class CivilController extends Controller
{
   public function __construct()
    {
      $this->middleware('can:civil')->only('index');
      $this->middleware('can:civil.add')->only('add');
      $this->middleware('can:civil.edit')->only('edit');
      $this->middleware('can:civil.destroy')->only('destroy');
    }
    public function index(Civil $model)
  	{    	
  		return view('admin.configuracion.civiles.index', ['civiles' => $model->all()]);
  	}
  	public function add (Request $request)
    {   
  
       if($request->id == 0){
            try {
                $civil= new Civil();
                $civil->Civil = ucfirst($request['nombre']);
                $civil->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 Civil::where('id_Civil', $id)->update([
                    'Civil'=>ucfirst($request->nombre),
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('civil');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $civilians= Civil::where('id_Civil','=', $id)->first();
        return response()->json([$civilians]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $civilians= Civil::where('id_Civil', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('civil');
    }
}
