<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\ImgTicket;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    const UPLOAD_PATH = 'public/comment';
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            if ($request->image) {
                $image = $this->_procesarArchivo($request);
                ImgTicket::create($image);
            }
            $resultado = ['id_user' => Auth::user()->id, 'id_ticket' => $request->id_ticket, 'conment' => $request->comment];
            Comment::create($resultado);
            DB::commit();

            Toastr::success(__('added successfully'), 'Comentario');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            dd($e);
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return Redirect::back();
    }

    public function separadorDirectorios($path)
    {
        return str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
    }
    private function _procesarArchivo(Request $request)
    {
        $ruta = self::UPLOAD_PATH;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = date('Ymd') . '_' . $image->getClientOriginalName();
            $name = str_replace(' ', '_', $filename);
            $this->_eliminarArchivo($name);
            $image->storeAs($ruta, $name);
        }

        $img = array('id_ticket' => intval($request->id_ticket), 'id_user' => Auth::user()->id, 'image' => $name);
        return $img;
    }
    private function _eliminarArchivo($name)
    {
        $archivo = self::UPLOAD_PATH . '/' . $name;
        Storage::disk('public')->delete([$archivo]);
    }
}