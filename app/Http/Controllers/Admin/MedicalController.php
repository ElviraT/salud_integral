<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medical;
use App\Models\Sex;
use App\Models\Speciality;
use App\Models\Status;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class MedicalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicals = Medical::all();
        $sexs = Sex::all();
        $specialities = Speciality::all();
        $status = Status::all();
        $users = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', 'Medico')
            ->where('users.status', 1)
            ->select('users.id as id', DB::raw('CONCAT(users.name, " ", users.last_name) AS name'))
            ->get();
        return view('medicales.index', compact('medicals', 'users', 'sexs', 'specialities', 'status'));
    }

    public function store(Request $request)
    {
        try {
            $resultado = ($request->post());

            $medical = Medical::create($resultado);

            Toastr::success(__('added successfully'),  __('Medical'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return Redirect::back();
    }

    public function edit(string $id)
    {
        $medical = Medical::find($id);
        return response()->json($medical);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        try {
            $medical = Medical::find($id);
            $medical->update($input);

            Toastr::success(__('Updated registration'),  __('Medical'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medical $medical)
    {
        $medical->id_status = "2";
        $medical->update();
        Toastr::success(__('Registration Successfully Disabled'), 'Disabled');
        return redirect()->back();
    }
}
