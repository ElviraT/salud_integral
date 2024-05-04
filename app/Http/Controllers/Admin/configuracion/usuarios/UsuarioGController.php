<?php

namespace App\Http\Controllers\Admin\configuracion\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use Illuminate\Support\Facades\Hash;
use App\Model\UsuarioG;
use App\Model\LoginT;
use App\User;
use App\Model\Pais;
use App\Model\Sexo;
use App\Model\PrefijoDNI;
use App\Model\Civil;
use App\Model\Status;
use App\Limite;
use App\Model\HistoricoT;
use Spatie\Permission\Models\Role;
use Flash;
use DB;

class UsuarioGController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:usuario_g')->only('index');
      $this->middleware('can:usuario_g.add')->only('add');
      $this->middleware('can:usuario_g.edit')->only('edit','update');
      $this->middleware('can:usuario_g.delete')->only('delete');
    }

     public function index(UsuarioG $model)
  	{  
		    if(auth()->user()->name == 'Admin'){
		        $usuarioG = UsuarioG::all();
		    }else{
		        $usuarioG = UsuarioG::where('id', auth()->user()->id_usuarioG)->get();
		    }  
		    //dd($usuarioG);	
  		return view('admin.configuracion.usuarios.usuarioG.index', ['usuarioG' => $usuarioG]);
  	}

	public function create()
  	{
      
    	$sexo=Collection::make(Sexo::select(['id_Sexo','Sexo'])->orderBy('Sexo')->get())->pluck("Sexo", "id_Sexo");
    	$prefijo=Collection::make(PrefijoDNI::select(['id_Prefijo_CIDNI','Prefijo_CIDNI'])->orderBy('Prefijo_CIDNI')->get())->pluck("Prefijo_CIDNI", "id_Prefijo_CIDNI");
    	$status=Collection::make(Status::select(['id_Status','Status'])->orderBy('Status')->get())->pluck("Status", "id_Status");
    	$roles = Collection::make(Role::select(['id','name'])->orderBy('name')->get())->pluck("name", "id");
 
    	return view('admin.configuracion.usuarios.usuarioG.create')->with(compact('sexo','prefijo','status','roles')); 
  	}

    public function add(Request $request)
    {
        $data = $request->all();
        $data = $request->except('_token');
      $total = UsuarioG::where('id_status',1)->count();
      $limite = Limite::select('administrativo')->where('status',1)->first();
      if(!isset($limite)){
        Flash::error('Ocurrió un error,se debe agregar un limite de usuarios');
        return redirect()->route('usuario_g.create');
      }
      	if($request->id == null){
          if($total < $limite->administrativo){
              try {

              $usuarioG= UsuarioG::create($data);
              //dd($usuarioG->id);            

                  Flash::success("Registro Agregado Correctamente");            
              return redirect()->route('usuario_g.edit', $usuarioG->id);

              } catch (\Illuminate\Database\QueryException $e) {
                  Flash::error('Ocurrió un error, por favor intente de nuevo');
                  return redirect()->route('usuario_g.create');
              }
          }else{
          Flash::error('No se pueden crear mas de '.$limite->administrativo.' administrativos');
            return redirect()->route('usuario_g');
          }
        }else{
          try{
             if($total == $limite->administrativo){
                $data = $data->except('status');
              }
            $usuarioG= UsuarioG::where('id', $request['id'])->update($data);
            $login = LoginT::where('general_id', $request['id'])->first();
               if (isset($login)) {
                LoginT::where('general_id', $request['id'])->update([
                'Status_Medico_id' => $request['status'],
                ]);

                User::where('id_usuarioG', $request['id'])->update([
                'status' => $request['status']
                ]);
               }

              Flash::success("Registro Actualizado Correctamente");

              }catch(\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo'); 
              }
              return redirect()->route('usuario_g.edit', $request['id']);
        }
    }
   public function edit($id)
    {
      $login = LoginT::where('general_id', $id)->first();     
      $general = UsuarioG::where('id',$id)->first();

      $rol = DB::select("SELECT m.role_id FROM model_has_roles as m, users as u WHERE m.model_id = u.id and u.id_usuarioG ='$id'");
      
      $sexo=Collection::make(Sexo::select(['id_Sexo','Sexo'])->orderBy('Sexo')->get())->pluck("Sexo", "id_Sexo");
      $prefijo=Collection::make(PrefijoDNI::select(['id_Prefijo_CIDNI','Prefijo_CIDNI'])->orderBy('Prefijo_CIDNI')->get())->pluck("Prefijo_CIDNI", "id_Prefijo_CIDNI");
      $status=Collection::make(Status::select(['id_Status','Status'])->orderBy('Status')->get())->pluck("Status", "id_Status");
      $roles = Collection::make(Role::select(['id','name'])->orderBy('name')->get())->pluck("name", "id");

      return view('admin.configuracion.usuarios.usuarioG.edit')->with(compact('general','sexo','prefijo','status','login','rol','roles')); 
    }

  public function login(Request $request)
  {
    if($request->idL == null){
    	DB::beginTransaction();
      try {
            $login= new LoginT();
            $login->Usuario = ucfirst($request['nombre_usuario']);
            $login->Correo = $request['correo'];
            $login->Status_Medico_id = 1;
            $login->Contrasena = Hash::make($request['contrasena']);
            $login->general_id = $request['id'];
            $login->save();

            $login2= new User();
            $login2->name = ucfirst($request['nombre_usuario']);
            $login2->email = $request['correo'];
            $login2->password = Hash::make($request['contrasena']);
            $login2->status = $request['status'];
            $login2->id_usuarioG = $request['id'];
            $login2->save();

            $login2->assignRole($request['rol']);
		 DB::commit();
        Flash::success("Registro Agregado Correctamente");            
        } catch (\Illuminate\Database\QueryException $e) {
        	 DB::rollback();
            Flash::error('Ocurrió un error, por favor intente de nuevo');  
        }

        return redirect()->route('usuario_g.edit', $request['id']);
    }else{
      //dd($request);
          $id = (int)$request->id;
          $login= User::where('id_usuarioG', $id)->first();
          $fecha= date('Y-m-d');

           if(password_verify($request['contrasena'], $login->password)){
            Flash::error('Debe ingresar una contraseña distinta a las anterior');
            return redirect()->route('usuario_g.edit', $id);
           }else{
             DB::beginTransaction();
            try{
                    LoginT::where('general_id', $id)->update([
                    'Usuario' => ucfirst($request['nombre_usuario']),
                    'Correo' => $request['correo'],
                    'Status_Medico_id' => $request['status'],
                    'Contrasena' => Hash::make($request['contrasena'])
                    ]);

                    User::where('id_usuarioG', $id)->update([
                    'name' => ucfirst($request['nombre_usuario']),
                    'email' => $request['correo'],
                    'password' => Hash::make($request['contrasena']),
                    'status' => $request['status']
                    ]);

                    $rol= $login->roles()->first();                
                    $login->removeRole($rol);                  
                    $login->assignRole($request['rol']);

                  $loginT = LoginT::where('general_id', $id)->first();
                  $loginh= new HistoricoT();
                  $loginh->Login_Tranajador_id = $loginT->id_Login_Trabajador;
                  $loginh->Old_Constrasena = Hash::make($login->password);
                  $loginh->Fecha = $fecha;
                  $loginh->general_id = $id;
                  $loginh->Correo = $login->email;
                  $loginh->Nota = '';
                  $loginh->save();

                     DB::commit();
                Flash::success("Registro Actualizado Correctamente");

            }catch(\Illuminate\Database\QueryException $e) {
              DB::rollback();
              Flash::error('Ocurrió un error, por favor intente de nuevo'); 
            }
                return redirect()->route('usuario_g.edit', $id);
          }
    }
  }

  public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       UsuarioG::where('id', $id)->update(['id_status' => 2]);
       User::where('id_usuarioG', $id)->update(['status' => 0]);

       Flash::success('Registro desactivado correctamente');
         
      return redirect()->route('usuario_g');
    }
}
