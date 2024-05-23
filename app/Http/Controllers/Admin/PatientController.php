<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaritalStatus;
use App\Models\Patient;
use App\Models\Status;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class PatientController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasAnyRole('Paciente')) {
            $patients = Patient::all();
        } else {
            $patients = Patient::where('id', Auth::user()->id)->get();
        }
        $status = Status::all();
        $users = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', 'Paciente')
            ->where('users.status', 1)
            ->select('users.id as id', DB::raw('CONCAT(users.name, " ", users.last_name) AS name'))
            ->get();
        $maritals = MaritalStatus::all();
        return view('patients.index', compact('patients', 'status', 'users', 'maritals'));
    }

    public function store(Request $request)
    {
        try {
            $resultado = ($request->post());

            $patient = Patient::create($resultado);

            Toastr::success(__('added successfully'),  __('Patient'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return Redirect::back();
    }

    public function edit(string $id)
    {
        $patient = Patient::find($id);
        return response()->json($patient);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        try {
            $patient = Patient::find($id);
            $patient->update($input);

            Toastr::success(__('Updated registration'),  __('Patient'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->id_status = "2";
        $patient->update();
        Toastr::success(__('Registration Successfully Disabled'), 'Disabled');
        return redirect()->back();
    }
}
