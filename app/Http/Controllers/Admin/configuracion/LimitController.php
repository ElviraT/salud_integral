<?php

namespace App\Http\Controllers\Admin\configuracion;

use App\Http\Controllers\Controller;
use App\Models\Limit;
use App\Models\Status;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class LimitController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:limits.index|limits.create|limits.edit|limits.destroy', ['only' => ['index', 'store']]);
        $this->middleware('permission:limits.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:limits.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:limits.destroy', ['only' => ['destroy']]);
    }


    public function index(Request $request)
    {
        $limits = Limit::orderBy('id', 'ASC')->get();
        return view('admin.configuracion.limites.index', compact('limits'));
    }
    public function create()
    {
        $status = Status::pluck('name', 'id');

        return view('admin.configuracion.limites.create')->with(compact('status'));
    }
    public function store(Request $request)
    {
        try {
            $data = $request->except('_token');
            $limite = Limit::create($data);
            if ($request->status == 1) {
                Limit::where('id', '<>', $limite->id)->update([
                    'status' => 2,
                ]);
            }

            Toastr::success(__('Record added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }

        return to_route('limits.index');
    }
    public function edit(Limit $limit)
    {
        $status = Status::pluck('name', 'id');

        return view('admin.configuracion.limites.edit', compact('limit', 'status'));
    }

    public function update(Request $request, Limit $limit)
    {
        $data = $request->except('_token');
        try {
            $limit->update($data);
            if ($request->status == 1) {
                Limit::where('id', '<>', $request->id)->update([
                    'status' => 2,
                ]);
            }

            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }

        return to_route('limits.index');
    }
}
