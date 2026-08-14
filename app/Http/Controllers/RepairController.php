<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepairStoreRequest;
use App\Http\Requests\RepairUpdateRequest;
use App\Models\Repair;
use App\Models\Technician;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RepairController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $status = $request->query('status');

        $repairs = Repair::with(['ticket.client', 'ticket.device', 'technician'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('diagnosis', 'like', "%{$search}%")
                        ->orWhere('repair_description', 'like', "%{$search}%")
                        ->orWhereHas('ticket', function ($ticketQuery) use ($search) {
                            $ticketQuery->where('ticket_number', 'like', "%{$search}%");
                        })
                        ->orWhereHas('technician', function ($technicianQuery) use ($search) {
                            $technicianQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->when($status, fn ($query, $value) => $query->where('status', $value))
            ->orderByDesc('created_at')
            ->paginate(10)
            ->appends(['search' => $search, 'status' => $status]);

        return view('repairs.index', compact('repairs', 'search', 'status'));
    }

    public function create(): View
    {
        $tickets = Ticket::with(['client', 'device'])->orderByDesc('created_at')->get();
        $technicians = Technician::orderBy('name')->get();

        return view('repairs.create', compact('tickets', 'technicians'));
    }

    public function store(RepairStoreRequest $request)
    {
        Repair::create($request->validated());

        return redirect()->route('repairs.index')->with('success', 'Intervention créée avec succès.');
    }

    public function show(Repair $repair): View
    {
        return view('repairs.show', compact('repair'));
    }

    public function edit(Repair $repair): View
    {
        $tickets = Ticket::with(['client', 'device'])->orderByDesc('created_at')->get();
        $technicians = Technician::orderBy('name')->get();

        return view('repairs.edit', compact('repair', 'tickets', 'technicians'));
    }

    public function update(RepairUpdateRequest $request, Repair $repair)
    {
        $repair->update($request->validated());

        return redirect()->route('repairs.index')->with('success', 'Intervention mise à jour avec succès.');
    }

    public function destroy(Repair $repair)
    {
        $repair->delete();

        return redirect()->route('repairs.index')->with('success', 'Intervention supprimée avec succès.');
    }
}
