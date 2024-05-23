<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Speciality;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        $speciality = Speciality::all();
        return view('services.index', compact('services', 'speciality'));
    }

    public function store(Request $request)
    {
        try {
            $resultado = ($request->post());
            $service = Service::create($resultado);

            Toastr::success(__('added successfully'),  __('Service:') . $request->name);
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return Redirect::back();
    }

    public function edit(string $id)
    {
        $service = Service::find($id);
        return response()->json($service);
    }

    public function update(Request $request, string $id)
    {
        $input = $request->all();
        try {
            $service = Service::find($id);
            $service->update($input);

            Toastr::success(__('Updated registration'),  __('Service') . $request->nam);
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return Redirect::back();
    }

    public function destroy(Service $service)
    {
        $service->delete();
        Toastr::success(__('Registry successfully deleted'), 'Delete');
        return redirect()->back();
    }
}
