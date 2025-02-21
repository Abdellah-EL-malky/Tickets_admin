<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    // Show the form for creating a new ticket.
    public function create()
    {
        return view('tickets.create');
    }

    // Store a new ticket in the database.
    public function store(Request $request)
    {
        // Validate the incoming request data.
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Optionally, if you want to restrict this functionality only to users with role 'user'
        if (Auth::user()->role !== 'user') {
            abort(403, 'Unauthorized action.');
        }

        // Create and save the ticket.
        $ticket = new Ticket();
        $ticket->title       = $request->title;
        $ticket->description = $request->description;
        $ticket->status      = 'En cours';   // override default status
        $ticket->user_id     = Auth::id();
        $ticket->save();

        return redirect()->back()->with('success', 'Ticket created successfully!');
    }
}
