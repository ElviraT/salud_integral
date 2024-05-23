<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaritalStatus;
use App\Models\PatientFamily;
use App\Models\Relationship;
use App\Models\Sex;
use App\Models\Status;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PatientFamilyController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasAnyRole('SuperAdmin', 'Admin')) {
            $patients = PatientFamily::where('id_patient', $_GET['id'])->get();
        } else {
            $patients = PatientFamily::all();
        }
        $status = Status::all();
        $maritals = MaritalStatus::all();
        $relacion = Relationship::all();
        $genders = Sex::all();
        $id_pariente = $_GET['id'];
        return view('patients.family.index', compact('patients', 'status', 'maritals', 'relacion', 'genders', 'id_pariente'));
    }

    public function store(Request $request)
    {
        try {
            $resultado = ($request->post());
            $patient = PatientFamily::create($resultado);

            Toastr::success(__('added successfully'),  __('Patient'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return Redirect::back();
    }

    public function edit(string $id)
    {
        $family = PatientFamily::find($id);
        return response()->json($family);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        try {
            $patient = PatientFamily::find($id);
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
    public function destroy(PatientFamily $patient)
    {
        $patient->delete();
        Toastr::success(__('Registration Successfully Disabled'), 'Disabled');
        return redirect()->back();
    }
}
