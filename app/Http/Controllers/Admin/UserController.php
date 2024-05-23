<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sex;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Arr;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    const UPLOAD_PATH = 'public/avatar';
    public function index(Request $request)
    {
        if (Auth::user()->hasAnyRole('SuperAdmin', 'Admin')) {
            $users = User::orderBy('id', 'DESC')->get();
        } else {
            $users = User::where('id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        }
        $status = Status::all();
        $roles = Role::all();
        $genders = Sex::all();
        $countries = Country::get();
        $states = State::get();
        $cities = City::get();
        return view('users.index', compact('users', 'status', 'roles', 'genders', 'countries', 'states', 'cities'));
    }

    public function store(Request $request)
    {
        try {
            if ($request->file('avatar')) {
                $logo = $this->_procesarArchivo($request);
            } else {
                $logo = [];
            }
            $request['password'] = Hash::make($request['password']);
            $resultado = array_merge($request->post(), $logo);

            $user = User::create($resultado);
            $user->assignRole($resultado['roles']);

            Toastr::success(__('added successfully'),  __('User') . ': ' . $request->input('name'));
        } catch (\Illuminate\Database\QueryException $e) {

            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return Redirect::back();
    }

    public function edit($id)
    {
        $user = User::find($id);
        return response()->json([$user]);
    }

    public function update(Request $request, $id)
    {
        $logo = $this->_procesarArchivo($request);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        $resultado = array_merge($input, $logo);
        try {
            $user = User::find($id);
            $user->update($resultado);
            if ($request['roles'] != 'Select Role') {
                DB::table('model_has_roles')->where('model_id', $id)->delete();
                $user->assignRole($request->input('roles'));
            }
            Toastr::success(__('Updated registration'),  __('User') . ': ' . $request->input('name'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return Redirect::back();
    }

    public function destroy(User $user)
    {
        $this->_eliminarArchivo($user->avatar);
        DB::table('model_has_roles')->where('model_id', ($user->id))->delete();
        $user->delete();
        Toastr::success(__('Registry successfully deleted'), 'Delete');
        return redirect()->back();
    }

    public function separadorDirectorios($path)
    {
        return str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
    }
    private function _procesarArchivo(Request $request)
    {

        $request->validate([
            'avatar' => 'file|image|max:2048',
        ]);

        $ruta = self::UPLOAD_PATH;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = date('Ymd') . '_' . $avatar->getClientOriginalName();
            $name = str_replace(' ', '_', $filename);
            $this->_eliminarArchivo($name);
            $avatar->storeAs($ruta, $name);
        } else {
            $user = User::where('id', $request->id)->first();
            if ($user) {
                $name = $user->avatar;
            }
        }

        $img = array('avatar' => $name);
        return $img;
    }
    private function _eliminarArchivo($name)
    {
        $archivo = self::UPLOAD_PATH . '/' . $name;
        app(FilesystemManager::class)->disk('public')->delete($archivo);
        app(FilesystemManager::class)->disk('local')->delete($archivo);
        Storage::disk('public')->delete($archivo);
        Storage::disk('local')->delete($archivo);
    }
}