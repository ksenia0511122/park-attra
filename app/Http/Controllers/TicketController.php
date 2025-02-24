<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller {
    public function buy(Request $request) {
        $request->validate([
            'attraction_id' => 'required|exists:attractions,id',
        ]);

        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'attraction_id' => $request->attraction_id,
            'status' => 'active',
        ]);

        return response()->json(['message' => 'Ticket purchased successfully', 'ticket' => $ticket], 201);
    }

    public function cancel($id) {
        $ticket = Ticket::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found or unauthorized'], 404);
        }

        if ($ticket->status != 'active') {
            return response()->json(['message' => 'Ticket cannot be canceled'], 400);
        }

        $ticket->update(['status' => 'cancelled']);

        return response()->json(['message' => 'Ticket cancelled successfully']);
    }

    public function refund($id) {
        $ticket = Ticket::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found or unauthorized'], 404);
        }

        if ($ticket->status != 'active') {
            return response()->json(['message' => 'Ticket cannot be refunded'], 400);
        }

        $ticket->update(['status' => 'refunded']);

        return response()->json(['message' => 'Ticket refunded successfully']);
    }
}
