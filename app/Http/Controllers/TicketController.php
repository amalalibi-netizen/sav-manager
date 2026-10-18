<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketStoreRequest;
use App\Http\Requests\TicketUpdateRequest;
use App\Models\Client;
use App\Models\Device;
use App\Models\Ticket;
use App\Notifications\StatusChangedNotification;
use App\Notifications\TicketCreatedNotification;
use Illuminate\Support\Facades\Notification;
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
            ->appends([
                'search' => $search,
                'status' => $status,
                'priority' => $priority,
            ]);

        return view('tickets.index', compact(
            'tickets', 'search', 'status', 'priority'
        ));
    }

    public function create(): View
    {
        $clients = Client::orderBy('last_name')->get();
        $devices = Device::with('client')->orderBy('brand')->get();

        return view('tickets.create', compact('clients', 'devices'));
    }

    public function store(TicketStoreRequest $request)
    {
        $data = $request->validated();
        $data['ticket_number'] = $this->generateTicketNumber();
        $data['received_at'] = $data['received_at'] ?? now();

        $ticket = Ticket::create($data);
        $ticket->load('client');

        if ($ticket->client && $ticket->client->email) {
            Notification::route('mail', $ticket->client->email)
                ->notify(new TicketCreatedNotification(
                    $ticket->ticket_number,
                    $ticket->status,
                    $ticket->client->first_name . ' ' .
                        $ticket->client->last_name
                ));
        }

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Ticket créé avec succès.');
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
        $data = $request->validated();

        $ticket->load('client');

        $oldStatus = $ticket->status;

        $ticket->update($data);

        if (
            isset($data['status']) &&
            $oldStatus !== $ticket->status &&
            $ticket->client &&
            $ticket->client->email
        ) {
            $clientName = $ticket->client->first_name . ' ' .
                $ticket->client->last_name;

            Notification::route('mail', $ticket->client->email)
                ->notify(new StatusChangedNotification(
                    'ticket',
                    $ticket->ticket_number,
                    $oldStatus,
                    $ticket->status,
                    $clientName
                ));
        }

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Ticket mis à jour avec succès.');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Ticket supprimé avec succès.');
    }

    protected function generateTicketNumber(): string
    {
        $year = now()->format('Y');

        $lastTicket = Ticket::whereYear('created_at', $year)
            ->orderByDesc('id')
            ->first();

        $number = $lastTicket
            ? ((int) str_replace(
                ['SAV-' . $year . '-', 'SAV-' . $year],
                '',
                $lastTicket->ticket_number
            )) + 1
            : 1;

        return sprintf('SAV-%s-%04d', $year, $number);
    }
}