<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConsultingRoom;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ConsultingRoomController extends Controller
{
    public function index()
    {
        $consulting = ConsultingRoom::all();
        $medical = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', 'Medico')
            ->where('users.status', 1)
            ->select('users.id as id', DB::raw('CONCAT(users.name, " ", users.last_name) AS name'))
            ->get();
        return view('consulting.index', compact('consulting', 'medical'));
    }

    public function store(Request $request)
    {
        try {
            $resultado = ($request->post());
            $consulting = ConsultingRoom::create($resultado);

            Toastr::success(__('added successfully'),  __('Consulting:') . $request->name);
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
