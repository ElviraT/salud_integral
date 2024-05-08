<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\ImgTicket;
use App\Models\Priority;
use App\Models\StatusTicket;
use App\Models\Ticket;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketsController extends Controller
{
    public function index($id)
    {
        $status = StatusTicket::orderBy('id', 'DESC')->get();
        $priorities = Priority::all();
        $users = User::select('name', 'last_name', 'id')->where('name', '<>', Auth::user()->name)->get();
        $ticketCounts = Ticket::select('status_tickets.name as status_name', 'status_tickets.color as color', DB::raw('COUNT(*) as ticket_count'))
            ->join('status_tickets', 'tickets.state_id', '=', 'status_tickets.id')
            ->groupBy('status_tickets.name', 'status_tickets.color')
            ->get();
        $total = Ticket::count('id');
        if (Auth::user()->hasAnyRole('SuperAdmin', 'Admin')) {
            if ($id != 5) {
                $tickets = Ticket::where('state_id', $id)->orderBy('created_at', 'DESC')->paginate(5);
            } else {
                $tickets = Ticket::paginate(5);
            }
        } else {
            if ($id != 5) {
                $tickets = Ticket::where('user_id', Auth::user()->id)->where('state_id', $id)->orderBy('created_at', 'DESC')->paginate(5);
            } else {
                $tickets = Ticket::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(5);
            }
        }
        return view('tickets.index', compact('tickets', 'status', 'priorities', 'users', 'ticketCounts', 'total'));
    }

    public function store(Request $request)
    {
        try {
            $otro = ['assigned_due' => date('d-m-y')];
            $resultado = array_merge($request->post(), $otro);
            $ticket = Ticket::create($resultado);
            Toastr::success(__('Added successfully'), __('Ticket') . ': ' . $request->input('subjet'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }

        return redirect()->back();
    }

    public function edit(Ticket $ticket)
    {
        $comments = Comment::where('id_ticket', $ticket->id)->get();
        $images = ImgTicket::where('id_ticket', $ticket->id)->get();
        $status = StatusTicket::orderBy('id', 'DESC')->get();
        return view('tickets.edit', compact('ticket', 'comments', 'images', 'status'));
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy(): never
    {
        abort(404);
    }
}
