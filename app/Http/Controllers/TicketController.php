<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tickets = Ticket::with('user:id,name,department')
            ->where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request): RedirectResponse
    {
        Ticket::create([
            ...$request->validated(),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('tickets.index')->with('success', 'Chamado criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket): View
    {
        abort_unless($ticket->user_id === auth()->id(), 403);
        $ticket->loadMissing('user:id,name,department');

        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket): View
    {
        abort_unless($ticket->user_id === auth()->id(), 403);

        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketRequest $request, Ticket $ticket): RedirectResponse
    {
        abort_unless($ticket->user_id === auth()->id(), 403);

        $ticket->update($request->validated());

        return redirect()->route('tickets.index')->with('success', 'Chamado atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket): RedirectResponse
    {
        abort_unless($ticket->user_id === auth()->id(), 403);

        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Chamado removido com sucesso.');
    }
}
