<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\ImgTicket;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Filesystem\FilesystemManager;
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
            if ($request->conment) {
                $resultado = [
                    'id_user' => Auth::user()->id,
                    'id_ticket' => $request->id_ticket,
                    'conment' => $request->conment
                ];
                Comment::create($resultado);
            }
            if ($request->state_id) {
                $ticket = Ticket::find($request->id_ticket);
                $ticket->update(['state_id' => $request->state_id]);
            }
            DB::commit();

            Toastr::success(__('added successfully'), 'Comentario');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return Redirect::back();
    }
    public function img($ticket)
    {
        $img = ImgTicket::where('id', $ticket)->first();
        return response()->json($img);
    }
    public function destroy_img($images)
    {
        $image = ImgTicket::where('id', $images)->first();
        $this->_eliminarArchivo($image->image);
        $image->delete();
        Toastr::success(__('Registry successfully deleted'), 'Delete');
        return redirect()->back();
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
        app(FilesystemManager::class)->disk('public')->delete($archivo);
        app(FilesystemManager::class)->disk('local')->delete($archivo);
        Storage::disk('public')->delete($archivo);
        Storage::disk('local')->delete($archivo);
    }
}
