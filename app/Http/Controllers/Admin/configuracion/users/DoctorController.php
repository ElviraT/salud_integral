<?php

namespace App\Http\Controllers\Admin\configuracion\users;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Doctor;
use App\Models\Limit;
use App\Models\MaritalStatus;
use App\Models\Municipality;
use App\Models\Parish;
use App\Models\Prefix;
use Spatie\Permission\Models\Role;
use App\Models\Sex;
use App\Models\State;
use App\Models\Status;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:usersm.index|usersm.create|usersm.edit|usersm.destroy', ['only' => ['index', 'store']]);
        $this->middleware('permission:usersm.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:usersm.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:usersm.destroy', ['only' => ['destroy']]);
    }
    const UPLOAD_PATH = 'Doctor';
    public function index(Request $request)
    {
        $usersm = Doctor::orderBy('id', 'ASC')->get();
        return view('admin.configuracion.usuarios.userm.index', compact('usersm'));
    }

    public function create()
    {
        $total = Doctor::where('idStatus', 1)->count();
        $limite = Limit::select('medico')->where('status', 1)->first();
        if (!isset($limite)) {
            Toastr::success('Ocurrió un error, se debe agregar un limite de usuarios');
            return to_route('usersm.index');
        }
        if ($total < $limite->medico) {
            $sexo = Sex::pluck("name", "id");
            $prefijo = Prefix::pluck("name", "id");
            $estadoC = MaritalStatus::pluck("name", "id");
            $status = Status::pluck("name", "id");
            $nacionalidad = Country::pluck("name", "id");
            $ciudad = City::pluck("name", "id");
            $estado = State::pluck("name", "id");
            $municipio = Municipality::pluck("name", "id");
            $parroquia = Parish::pluck("name", "id");
            return view('admin.configuracion.usuarios.userm.create')->with(compact('sexo', 'prefijo', 'estadoC', 'status', 'nacionalidad', 'ciudad', 'estado', 'municipio', 'parroquia', 'roles'));
        } else {
            Toastr::error('No se pueden crear mas de ' . $limite->medico . ' medicos');
            return to_route('usersm.index');
        }
    }

    public function store(Request $request)
    {
        if ($request->step == 1) {
            try {
                DB::beginTransaction();
                $datau = [
                    'name' => $request->name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'password' => Hash::make($request->name . '123'),
                    'idPrefix' => $request->idPrefix,
                    'dni' => $request->dni,
                    'status' => $request->idStatus,
                ];
                $user = User::create($datau);
                $user->assignRole('2');
                $datam = [
                    'idUser' => $user->id,
                    'idSex' => $request->idSex,
                    'idStatus' => $request->idStatus,
                    'idMaritalState' => $request->idMaritalState,
                    'idCountry' => $request->idCountry,
                    'idState' => $request->idState,
                    'idCity' => $request->idCity,
                    'idMunicipality' => $request->idMunicipality,
                    'idParish' => $request->idParish,
                    'brithday' => $request->brithday,
                    'register' => $request->register,
                    'ncolegio' => $request->ncolegio,
                ];

                $medico = Doctor::create($datam);

                $this->_procesarArchivo($request, $user->id, 'medico');
                DB::commit();
                Toastr::success(__('Record added successfully'), 'Success');
                return to_route('usersm.edit', $medico->id);
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                Toastr::error(__('An error occurred please try again'), 'error');
                return to_route('usersm.create');
            }
        }
    }

    private function _procesarArchivo(Request $request, $id, $tipo)
    {
        if ($request->hasFile('avatar')) {
            $tmp = $request->file('avatar');

            $nombre = str_replace(' ', '', $request->input("dni"));

            if ($tmp->isValid()) {
                $extension = $tmp->extension();
                $nombreArchivo = sprintf('%s_%s_%s.%s', $tipo, $id, $nombre, $extension);
                $this->_eliminarArchivo($nombreArchivo);
                $ubicacion = $tmp->storeAs(
                    self::UPLOAD_PATH,
                    $nombreArchivo
                );
                $ubicacion = $this->separadorDirectorios($ubicacion);
                User::where('id', $id)->update(['avatar' => $ubicacion]);
            }
        }
    }
    private function _eliminarArchivo($nombreArchivo)
    {
        $archivo = self::UPLOAD_PATH . '/' . $nombreArchivo;
        Storage::disk('public')->delete([$archivo . '.jpg']);
        Storage::disk('public')->delete([$archivo . '.jpeg']);
        Storage::disk('public')->delete([$archivo . '.png']);
        Storage::disk('public')->delete([$archivo . '.gif']);
        Storage::disk('public')->delete([$archivo . '.pdf']);
    }

    public function separadorDirectorios($path)
    {
        return str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
    }
    public function edit(Doctor $usersm)
    {
        $sexo = Sex::pluck("name", "id");
        $prefijo = Prefix::pluck("name", "id");
        $estadoC = MaritalStatus::pluck("name", "id");
        $status = Status::pluck("name", "id");
        $nacionalidad = Country::pluck("name", "id");
        $ciudad = City::pluck("name", "id");
        $estado = State::pluck("name", "id");
        $municipio = Municipality::pluck("name", "id");
        $parroquia = Parish::pluck("name", "id");
        return view('admin.configuracion.usuarios.userm.edit')->with(compact('usersm', 'sexo', 'prefijo', 'estadoC', 'status', 'nacionalidad', 'ciudad', 'estado', 'municipio', 'parroquia'));
    }
}
