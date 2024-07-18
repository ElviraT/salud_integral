<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppointmentType;
use App\Models\Cita;
use App\Models\Day;
use App\Models\Schedules;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitaController extends Controller
{
    public function index()
    {
        $medicals = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->join('medicals', 'users.id', '=', 'medicals.id_user')
            ->where('roles.name', 'Medico')
            ->where('users.status', 1)
            ->select('medicals.id as id', DB::raw('CONCAT(users.name, " ", users.last_name) AS name'))
            ->get();
        $patients = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->join('patients', 'users.id', '=', 'patients.id_user')
            ->where('roles.name', 'Paciente')
            ->where('users.status', 1)
            ->select('patients.id as id', DB::raw('CONCAT(users.name, " ", users.last_name) AS name'))
            ->get();
        $type = AppointmentType::all();
        $days = Day::all();
        return view('citas.index', compact('medicals', 'days', 'patients', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

    public function consulta($id)
    {
        $days = Day::join('schedules', 'days.id', 'schedules.id_day')
            ->join('medicals', 'schedules.id_medical', 'medicals.id')
            ->where('medicals.id', $id)
            ->select(['days.id', 'days.name'])
            ->get();
        return response()->json($days);
    }

    public function consulta2($id, $medical)
    {
        $hours = Schedules::where('id_day', $id)->where('id_medical', $medical)->first();
        return response()->json($hours);
    }
}