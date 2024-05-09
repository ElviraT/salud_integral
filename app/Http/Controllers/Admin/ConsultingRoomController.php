<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConsultingRoom;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ConsultingRoomController extends Controller
{
    public function index()
    {
        $consulting = ConsultingRoom::all();
        return view('consulting.index', compact('consulting'));
    }

    public function store(Request $request)
    {
        try {
            $resultado = ($request->post());
            $consulting = ConsultingRoom::create($resultado);

            Toastr::success(__('added successfully'),  __('Consulting:' . $request->name));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return Redirect::back();
    }

    public function edit($id)
    {
        $consulting = ConsultingRoom::find($id);
        return response()->json($consulting);
    }

    public function update(Request $request, string $id)
    {
        $input = $request->all();
        try {
            $consulting = ConsultingRoom::find($id);
            $consulting->update($input);

            Toastr::success(__('Updated registration'),  __('Consulting'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConsultingRoom $consulting)
    {
        $consulting->delete();
        Toastr::success(__('Registry successfully deleted'), 'Delete');
        return redirect()->back();
    }
}
