<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\Medical;
use App\Models\Schedules;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $days = Day::all();
        $shedules = Schedules::all();
        $id_medical = $_GET['id'];

        return view('shedules.index', compact('days', 'shedules', 'id_medical'));
    }


    public function store(Request $request)
    {
        try {
            $resultado = ($request->post());
            $shedule = Schedules::create($resultado);

            Toastr::success(__('added successfully'),  __('shedule'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return Redirect::back();
    }

    public function edit(string $id)
    {
        $shedule = Schedules::find($id);
        return response()->json($shedule);
    }

    public function update(Request $request, string $id)
    {
        $input = $request->all();
        try {
            $shedule = Schedules::find($id);
            $shedule->update($input);

            Toastr::success(__('Updated registration'),  __('Shedule'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedules $schedule)
    {
        $schedule->delete();
        Toastr::success(__('Registration Successfully Disabled'), 'Disabled');
        return redirect()->back();
    }
}
