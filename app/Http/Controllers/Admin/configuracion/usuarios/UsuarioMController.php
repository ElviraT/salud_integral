<?php

namespace App\Http\Controllers\Admin\configuracion\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Model\UsuarioM;
use App\Model\LoginT;
use App\Model\Seniat;
use App\User;
use App\Model\Pais;
use App\Model\Sexo;
use App\Model\PrefijoDNI;
use App\Model\Civil;
use App\Model\StatusM;
use App\Model\HistoricoT;
use App\Model\Ciudad;
use App\Model\Estado;
use App\Model\Municipio;
use App\Model\Parroquia;
use App\Limite;
use Spatie\Permission\Models\Role;
use Session;
use Image;
use DB;
use Flash;

class UsuarioMController extends Controller
{
	 public function __construct()
    {
      $this->middleware('can:usuario_m')->only('index');
      $this->middleware('can:usuario_m.add')->only('add','create','login','seniat');
      $this->middleware('can:usuario_m.edit')->only('edit','update');
      $this->middleware('can:usuario_m.destroy')->only('destroy');
    }
	const UPLOAD_PATH = 'medico';
    public function index(UsuarioM $model)
  	{   
  		Session::put('medico', null); 
  		if(auth()->user()->name == 'Admin'){
		    $usuariosM = UsuarioM::all();
		}else{
		    $usuariosM = UsuarioM::where('id_Medico', auth()->user()->id_usuario)->get();
		}	
  		return view('admin.configuracion.usuarios.usuariosM.index', ['usuariosM' =>$usuariosM]);
  	}

  	public function create()
  	{
    	$sexo=Collection::make(Sexo::select(['id_Sexo','Sexo'])->orderBy('Sexo')->get())->pluck("Sexo", "id_Sexo");
    	$prefijo=Collection::make(PrefijoDNI::select(['id_Prefijo_CIDNI','Prefijo_CIDNI'])->orderBy('Prefijo_CIDNI')->get())->pluck("Prefijo_CIDNI", "id_Prefijo_CIDNI");
    	$estadoC=Collection::make(Civil::select(['id_Civil','Civil'])->orderBy('Civil')->get())->pluck("Civil", "id_Civil");
    	$statusM=Collection::make(StatusM::select(['id_Status_Medico','Status_Medico'])->orderBy('Status_Medico')->get())->pluck("Status_Medico", "id_Status_Medico");
    	$nacionalidad = Collection::make(Pais::select(['id_Pais','Pais'])->orderBy('Pais')->get())->pluck("Pais", "id_Pais");
    	$ciudad=Collection::make(Ciudad::select(['id_Ciudad','Ciudad'])->orderBy('Ciudad')->get())->pluck("Ciudad", "id_Ciudad"); 
        $estado=Collection::make(Estado::select(['id_Estado','Estado'])->orderBy('Estado')->get())->pluck("Estado", "id_Estado"); 
        $municipio=Collection::make(Municipio::select(['id_Municipio','Municipio'])->orderBy('Municipio')->get())->pluck("Municipio", "id_Municipio"); 
        $parroquia=Collection::make(Parroquia::select(['id_Parroquia','Parroquia'])->orderBy('Parroquia')->get())->pluck("Parroquia", "id_Parroquia"); 
        $roles = Collection::make(Role::select(['id','name'])->orderBy('name')->get())->pluck("name", "id");

    	return view('admin.configuracion.usuarios.usuariosM.create')->with(compact('sexo','prefijo','estadoC','statusM','nacionalidad','ciudad','estado','municipio','parroquia','roles')); 
  	}
	public function add(Request $request)
	{
	  $total = UsuarioM::where('Status_Medico_id',1)->count();
      $limite = Limite::select('medico')->where('status',1)->first();
      if(!isset($limite)){
        Flash::error('Ocurrió un error, se debe agregar un limite de usuarios');
        return redirect()->route('usuario_m.create');
      }
		if($request->id == null){
      		if($total < $limite->medico){
			  	try {
			        $medico= new UsuarioM();
			        $medico->Nombres_Medico = ucfirst($request['nombre']);
			        $medico->Prefijo_CIDNI_id = $request['prefijo'];
			        $medico->Apellidos_Medicos = ucfirst($request['apellido']);
			        $medico->CIDNI = $request['cedula'];
			        $medico->Fecha_Nacimiento_Medico = $request['fechNac'];
			        $medico->Sexo_id = $request['sexo'];
			        $medico->Registro_MPPS = $request['registro'];
			        $medico->Numero_Colegio_de_Medico = $request['ncm'];
			        $medico->Status_Medico_id = $request['statusm'];
			        $medico->Civil_id = $request['civil'];
			        $medico->Pais_id = $request['nacionalidad'];
			        $medico->id_Estado = $request['estado'];
			        $medico->id_Ciudad = $request['ciudad'];
			        $medico->id_Municipio = $request['municipio'];
			        $medico->id_Parroquia = $request['parroquia'];
			        $medico->save();
			        Session::put('medico', $medico);

			    //dd($medico->id);
			        $this->_procesarArchivo($request, $medico->id, 'medico');

			        Flash::success("Registro Agregado Correctamente");            
		    	return redirect()->route('usuario_m.edit', $medico->id);
			    } catch (\Illuminate\Database\QueryException $e) {
			        Flash::error('Ocurrió un error, por favor intente de nuevo');
			        return redirect()->route('usuario_m.create');
			    }
		    }else{
		          Flash::error('No se pueden crear mas de '.$limite->medico.' medicos');
		                return redirect()->route('usuario_m');
		      }
		}else{
	        $id = (int)$request->id;
			try{
			if($total == $limite->medico){
                UsuarioM::where('id_Medico', $id)->update([
	             	'Nombres_Medico' => ucfirst($request['nombre']),
			        'Prefijo_CIDNI_id' => $request['prefijo'],
			        'Apellidos_Medicos' => ucfirst($request['apellido']),
			        'CIDNI' => $request['cedula'],
			        'Fecha_Nacimiento_Medico' => $request['fechNac'],
			        'Sexo_id' => $request['sexo'],
			        'Registro_MPPS' => $request['registro'],
			        'Numero_Colegio_de_Medico' => $request['ncm'],
			        'Civil_id' => $request['civil'],
			        'Pais_id' => $request['nacionalidad'],
			        'id_Estado' => $request['estado'],
			        'id_Ciudad' => $request['ciudad'],
		        	'id_Municipio' => $request['municipio'],
		        	'id_Parroquia' => $request['parroquia'],
	            ]);
              }else{
	             UsuarioM::where('id_Medico', $id)->update([
	             	'Nombres_Medico' => ucfirst($request['nombre']),
			        'Prefijo_CIDNI_id' => $request['prefijo'],
			        'Apellidos_Medicos' => ucfirst($request['apellido']),
			        'CIDNI' => $request['cedula'],
			        'Fecha_Nacimiento_Medico' => $request['fechNac'],
			        'Sexo_id' => $request['sexo'],
			        'Registro_MPPS' => $request['registro'],
			        'Numero_Colegio_de_Medico' => $request['ncm'],
			        'Status_Medico_id' => $request['statusm'],
			        'Civil_id' => $request['civil'],
			        'Pais_id' => $request['nacionalidad'],
			        'id_Estado' => $request['estado'],
			        'id_Ciudad' => $request['ciudad'],
		        	'id_Municipio' => $request['municipio'],
		        	'id_Parroquia' => $request['parroquia'],
	            ]);
              }

	             $login = LoginT::where('Medico_id', $id)->first();
	             if (isset($login)) {
	             	LoginT::where('Medico_id', $id)->update([
				        'Status_Medico_id' => $request['statusm'],
		            ]);

		            User::where('id_usuario', $id)->update([
				        'status' => $request['statusm']
		            ]);
	             }

	            $this->_procesarArchivo($request, $id, 'medico');
	            Flash::success("Registro Actualizado Correctamente");

	        }catch(\Illuminate\Database\QueryException $e) {
		        Flash::error('Ocurrió un error, por favor intente de nuevo'); 
	        }
	        return redirect()->route('usuario_m.edit', $id);
		}
	}
	public function edit($id)
	{
		$medico = UsuarioM::where('id_Medico', $id)->first();
		$login = LoginT::where('Medico_id', $medico->id_Medico)->first();
		//dd($login);
		$seniat = Seniat::where('Medico_id', $medico->id_Medico)->first();
		Session::put('medico', $medico);
		$rol = DB::select("SELECT m.role_id FROM model_has_roles as m, users as u WHERE m.model_id = u.id and u.id_usuario ='$id'");
		//COMBOS
		$sexo=Collection::make(Sexo::select(['id_Sexo','Sexo'])->orderBy('Sexo')->get())->pluck("Sexo", "id_Sexo");
    	$prefijo=Collection::make(PrefijoDNI::select(['id_Prefijo_CIDNI','Prefijo_CIDNI'])->orderBy('Prefijo_CIDNI')->get())->pluck("Prefijo_CIDNI", "id_Prefijo_CIDNI");
    	$estadoC=Collection::make(Civil::select(['id_Civil','Civil'])->orderBy('Civil')->get())->pluck("Civil", "id_Civil");
    	$statusM=Collection::make(StatusM::select(['id_Status_Medico','Status_Medico'])->orderBy('Status_Medico')->get())->pluck("Status_Medico", "id_Status_Medico");
    	$nacionalidad = Collection::make(Pais::select(['id_Pais','Pais'])->orderBy('Pais')->get())->pluck("Pais", "id_Pais");
    	$ciudad=Collection::make(Ciudad::select(['id_Ciudad','Ciudad'])->orderBy('Ciudad')->get())->pluck("Ciudad", "id_Ciudad"); 
        $estado=Collection::make(Estado::select(['id_Estado','Estado'])->orderBy('Estado')->get())->pluck("Estado", "id_Estado"); 
        $municipio=Collection::make(Municipio::select(['id_Municipio','Municipio'])->orderBy('Municipio')->get())->pluck("Municipio", "id_Municipio"); 
        $parroquia=Collection::make(Parroquia::select(['id_Parroquia','Parroquia'])->orderBy('Parroquia')->get())->pluck("Parroquia", "id_Parroquia");
        $roles = Collection::make(Role::select(['id','name'])->orderBy('name')->get())->pluck("name", "id");
		return view('admin.configuracion.usuarios.usuariosM.edit')->with(compact('medico','login','seniat','sexo','prefijo','estadoC','statusM','nacionalidad','ciudad','estado','municipio','parroquia','rol','roles'));
	}

	public function login(Request $request)
	{
		if($request->idL == null){
			DB::beginTransaction();
			try {
		        $login= new LoginT();
		        $login->Usuario = ucfirst($request['nombre_usuario']);
		        $login->Correo = $request['correo'];
		        $login->Status_Medico_id = $request['statusm'];
		        $login->Contrasena = Hash::make($request['contrasena']);
		        $login->Medico_id = $request['id'];
		        $login->save();

		        $login2= new User();
		        $login2->name = ucfirst($request['nombre_usuario']);
		        $login2->email = $request['correo'];
		        $login2->password = Hash::make($request['contrasena']);
		        $login2->status = $request['statusm'];
		        $login2->id_usuario = $request['id'];
		        $login2->save();

		        $login2->assignRole($request['rol']);
		        DB::commit();
				Flash::success("Registro Agregado Correctamente");            
		    } catch (\Illuminate\Database\QueryException $e) {
		    	DB::rollback();
		        Flash::error($e->getMessage().'Ocurrió un error, por favor intente de nuevo');  
		    }

	    	return redirect()->route('usuario_m.edit', $request['id']);
		}else{
			
	        $id = (int)$request->id;
			$login= User::where('id_usuario', $id)->first();
	        $fecha= date('Y-m-d');

	    	switch ($request['contrasena']) {
	        	case '':
	        		// code...
	        		 DB::beginTransaction();
				try{
		            LoginT::where('Medico_id', $id)->update([
				        'Correo' => $request['correo'],
				        'Status_Medico_id' => $request['statusm']
		            ]);

		            User::where('id_usuario', $id)->update([
                    	'email' => $request['correo'],
				        'status' => $request['statusm']
		            ]);

		            $rol= $login->roles()->first();            
                    $login->removeRole($rol);                  
                    $login->assignRole($request['rol']);
							
		        	$loginT = LoginT::where('Medico_id', $id)->first();
		            $loginh= new HistoricoT();
			        $loginh->Login_Tranajador_id = $loginT->id_Login_Trabajador;
			        $loginh->Old_Constrasena = Hash::make($login->password);
			        $loginh->Fecha = $fecha;
			        $loginh->Medico_id = $id;
			        $loginh->Correo = $login->email;
			        $loginh->Nota = '';
			        $loginh->save();

			         DB::commit();
		            Flash::success("Registro Actualizado Correctamente");

			        }catch(\Illuminate\Database\QueryException $e) {
			        	DB::rollback();
				        Flash::error('Ocurrió un error, por favor intente de nuevo'); 
			        }
	        		break;
	        	
	        	default:
	        		// code...
	        		
			        if(isset($login->password) && password_verify($request['contrasena'], $login->password)){
			         	Flash::error('Debe ingresar una contraseña distinta a las anterior');
			         	return redirect()->route('usuario_m.edit', $id);
			        }else{
			         	 DB::beginTransaction();
						try{
				            LoginT::where('Medico_id', $id)->update([
				             	'Usuario' => ucfirst($request['nombre_usuario']),
						        'Correo' => $request['correo'],
						        'Status_Medico_id' => $request['statusm'],
						        'Contrasena' => Hash::make($request['contrasena'])
				            ]);

				            User::where('id_usuario', $id)->update([
				             	'name' => ucfirst($request['nombre_usuario']),
		                    	'email' => $request['correo'],
						        'password' => Hash::make($request['contrasena']),
						        'status' => $request['statusm']
				            ]);

				            $rol= $login->roles()->first();            
		                    $login->removeRole($rol);                  
		                    $login->assignRole($request['rol']);
									
				        	$loginT = LoginT::where('Medico_id', $id)->first();
				            $loginh= new HistoricoT();
					        $loginh->Login_Tranajador_id = $loginT->id_Login_Trabajador;
					        $loginh->Old_Constrasena = Hash::make($login->password);
					        $loginh->Fecha = $fecha;
					        $loginh->Medico_id = $id;
					        $loginh->Correo = $login->email;
					        $loginh->Nota = '';
					        $loginh->save();

					         DB::commit();
				            Flash::success("Registro Actualizado Correctamente");

				        }catch(\Illuminate\Database\QueryException $e) {
				        	DB::rollback();
					        Flash::error('Ocurrió un error, por favor intente de nuevo'); 
				        }
	        		}
		        break;
			}
		        return redirect()->route('usuario_m.edit', $id);
		}
	}


	public function seniat(Request $request)
	{
		if($request->idS == null){			
			try {
		        $seniat= new Seniat();
		        $seniat->RIF = $request['rif'];
		        $seniat->Direccion = $request['direccion'];
		        $seniat->Medico_id = $request['id'];
		        $seniat->Fecha = $request['fecha'];
		        $seniat->save();

				Flash::success("Registro Agregado Correctamente"); 
		    } catch (\Illuminate\Database\QueryException $e) {
		        Flash::error('Ocurrió un error, por favor intente de nuevo');    
		    }
           
	    }else{
	    	try{
	    	 	Seniat::where('Medico_id', $request->id)->update([
	             	'RIF' => $request['rif'],
			        'Direccion' => $request['direccion'],
			        'Fecha' => $request['fecha'],
	            ]);

	            Flash::success("Registro Actualizado Correctamente");

	        }catch(\Illuminate\Database\QueryException $e) {
		        Flash::error('Ocurrió un error, por favor intente de nuevo'); 
	        }
	    }
	        return redirect()->route('usuario_m.edit', $request->id);
	}

	private function _procesarArchivo(Request $request, $id, $tipo)
    {
        if ($request->hasFile('avatar')) {
           $tmp = $request->file('avatar');
           
           $nombre= str_replace(' ', '', $request->input("cedula"));
        
            if ($tmp->isValid()) {
                $extension = $tmp->extension();
                $nombreArchivo = sprintf('%s_%s_%s.%s', $tipo, $id, $nombre, $extension);
                $this->_eliminarArchivo($nombreArchivo);
                $ubicacion = $tmp->storeAs(
                    self::UPLOAD_PATH,
                    $nombreArchivo
                );
                    $ubicacion = $this->separadorDirectorios($ubicacion);			       
                    UsuarioM::where('id_Medico', $id)->update(['Foto_Medico'=>$ubicacion]);
            }
        }
    }
    private function _eliminarArchivo($nombreArchivo){
        $archivo = self::UPLOAD_PATH.'/'.$nombreArchivo;
        Storage::disk('public')->delete([$archivo.'.jpg']);
        Storage::disk('public')->delete([$archivo.'.jpeg']);
        Storage::disk('public')->delete([$archivo.'.png']);
        Storage::disk('public')->delete([$archivo.'.gif']);
        Storage::disk('public')->delete([$archivo.'.pdf']);
    }

    public function separadorDirectorios($path){

      return str_replace(['\\','/'], DIRECTORY_SEPARATOR, $path);
    }
	public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       UsuarioM::where('id_Medico', $id)->update(['Status_Medico_id' => 2]);
       User::where('id_usuario', $id)->update(['status' => 0]);

       Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('usuario_m');
    }
}
