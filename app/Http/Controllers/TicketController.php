<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketStoreRequest;
use App\Http\Requests\TicketUpdateRequest;
use App\Models\Client;
use App\Models\Device;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $status = $request->query('status');
        $priority = $request->query('priority');

        $tickets = Ticket::with(['client', 'device'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('ticket_number', 'like', "%{$search}%")
                        ->orWhere('problem_description', 'like', "%{$search}%")
                        ->orWhereHas('client', function ($clientQuery) use ($search) {
                            $clientQuery->where('first_name', 'like', "%{$search}%")
                                ->orWhere('last_name', 'like', "%{$search}%");
                        });
                });
            })
            ->when($status, fn ($query, $value) => $query->where('status', $value))
            ->when($priority, fn ($query, $value) => $query->where('priority', $value))
            ->orderByDesc('received_at')
            ->paginate(10)
            ->appends(['search' => $search, 'status' => $status, 'priority' => $priority]);

        return view('tickets.index', compact('tickets', 'search', 'status', 'priority'));
    }

    public function create(): View
    {
        $clients = Client::orderBy('last_name')->get();
        $devices = Device::with('client')->orderBy('brand')->get();

        return view('tickets.create', compact('clients', 'devices'));
    }

    public function store(TicketStoreRequest $request)
    {
        $ticketNumber = $this->generateTicketNumber();

        $data = $request->validated();
        $data['ticket_number'] = $ticketNumber;
        $data['received_at'] = $data['received_at'] ?? now();

        Ticket::create($data);

        return redirect()->route('tickets.index')->with('success', 'Ticket créé avec succès.');
    }

    public function show(Ticket $ticket): View
    {
        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket): View
    {
        $clients = Client::orderBy('last_name')->get();
        $devices = Device::with('client')->orderBy('brand')->get();

        return view('tickets.edit', compact('ticket', 'clients', 'devices'));
    }

    public function update(TicketUpdateRequest $request, Ticket $ticket)
    {
        $ticket->update($request->validated());

        return redirect()->route('tickets.index')->with('success', 'Ticket mis à jour avec succès.');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Ticket supprimé avec succès.');
    }

    protected function generateTicketNumber(): string
    {
        $year = now()->format('Y');
        $lastTicket = Ticket::whereYear('created_at', $year)->orderByDesc('id')->first();
        $number = $lastTicket ? ((int) str_replace(['SAV-' . $year . '-', 'SAV-' . $year], '', $lastTicket->ticket_number)) + 1 : 1;

        return sprintf('SAV-%s-%04d', $year, $number);
    }
}
