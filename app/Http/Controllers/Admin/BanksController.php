<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banks;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class BanksController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:banks,name',
            'account' => 'required|unique:banks,account',
        ]);
        try {
            $user = array('user_id' => auth()->user()->id);
            $resultado = array_merge($request->post(), $user);
            $bank = Banks::create($resultado);
            Toastr::success(__('Added successfully'), __('Bank') . ': ' . $request->input('name'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }

        return redirect()->back();
    }

    public function edit($id)
    {
        $bank = Banks::find($id);
        return response()->json([$bank]);
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'account' => 'required',
        ]);
        try {
            $Bank = Banks::find($id);
            $Bank->name = $request->input('name');
            $Bank->account = $request->input('account');
            $Bank->titular = $request->input('titular');
            $Bank->amount = $request->input('amount');
            $Bank->save();
            Toastr::success(__('Updated registration'), __('Bank') . ': ' . $request->input('name'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banks $bank)
    {
        $bank->delete();
        Toastr::success(__('Registry successfully deleted'), 'Delete');
        return redirect()->back();
    }
}
