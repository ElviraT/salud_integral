<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppointmentType;
use App\Models\Cita;
use App\Models\Color;
use App\Models\Day;
use App\Models\Schedules;
use App\Models\Service;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CitaController extends Controller
{
    public function index()
    {
        $medicals = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->join('medicals', 'users.id', '=', 'medicals.id_user')
            ->join('specialities', 'medicals.id_speciality', '=', 'specialities.id')
            ->where('roles.name', 'Medico')
            ->where('users.status', 1)
            ->select('medicals.id as id', DB::raw('CONCAT(users.name, " ", users.last_name," - ",specialities.name) AS name'))
            ->get();
        $patients = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->join('patients', 'users.id', '=', 'patients.id_user')
            ->where('roles.name', 'Paciente')
            ->where('users.status', 1)
            ->select('patients.id as id', DB::raw('CONCAT(users.name, " ", users.last_name) AS name'))
            ->get();

        $colores = Color::all();
        $type = AppointmentType::all();
        $days = Day::all();
        $services = Service::all();
        return view('citas.index', compact('medicals', 'days', 'patients', 'type', 'colores', 'services'));
    }

    public function store(Request $request)
    {
        try {
            $request['start'] = DateTime::createFromFormat("d/m/Y H:i:s", $request['start'] . ' ' . $request['startime'])->format("Y-m-d H:i:s");
            $request['end'] = DateTime::createFromFormat("d/m/Y H:i:s", $request['end'] . ' ' . $request['endtime'])->format("Y-m-d H:i:s");

            $cita = Cita::create($request->post());
            Toastr::success(__('added successfully'),  __('Cita'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error' . ' ' . $e->getMessage());
        }

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function mostrar($id)
    {
        $event = Cita::where('id_medical', $id)->get();
        return response()->json($event);
    }

    public function medical_time($id)
    {
        $time = Schedules::where('id_medical', $id)->get();
        return response()->json($time);
    }
}
