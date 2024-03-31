<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TicketController extends Controller
{
    public function addTicket(Request $request)
    {
        try {
            $validatedData = $this->validateTicketRequest($request);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
        }

        $ticket = new Ticket();
        $ticket->user_id = $validatedData['user_id'];
        $ticket->ride_id = $validatedData['ride_id'];
        $ticket->save();

        return response()->json(['status' => 'success', 'ticket' => $ticket], 201);
    }

    public function getTickets($user_id)
    {
        $tickets = Ticket::with('ride')->where('user_id', $user_id)->get();

        if ($tickets->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'Tickets not found'], 404);
        }

        return response()->json(['status' => 'success', 'tickets' => $tickets], 200);
    }

    private function validateTicketRequest(Request $request)
    {
        return $request->validate([
            'user_id' => 'required|exists:users,id',
            'ride_id' => 'required|exists:rides,id'
        ]);
    }
}
