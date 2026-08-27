<?php

namespace App\Http\Controllers;

use App\Http\Requests\SparePartStoreRequest;
use App\Http\Requests\SparePartUpdateRequest;
use App\Models\SparePart;
use App\Models\User;
use App\Notifications\LowStockNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;

class SparePartController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $spareParts = SparePart::when($search !== '', function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('reference_code', 'like', "%{$search}%")
                    ->orWhere('supplier', 'like', "%{$search}%");
            });
        })
            ->orderBy('name')
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('spare-parts.index', compact('spareParts', 'search'));
    }

    public function create(): View
    {
        return view('spare-parts.create');
    }

    public function store(SparePartStoreRequest $request)
    {
        $sparePart = SparePart::create($request->validated());
        $this->notifyAdminsIfLowStock($sparePart);

        return redirect()->route('spare-parts.index')->with('success', 'Pièce ajoutée avec succès.');
    }

    public function show(SparePart $sparePart): View
    {
        return view('spare-parts.show', compact('sparePart'));
    }

    public function edit(SparePart $sparePart): View
    {
        return view('spare-parts.edit', compact('sparePart'));
    }

    public function update(SparePartUpdateRequest $request, SparePart $sparePart)
    {
        $sparePart->update($request->validated());
        $this->notifyAdminsIfLowStock($sparePart);

        return redirect()->route('spare-parts.index')->with('success', 'Pièce mise à jour avec succès.');
    }

    public function destroy(SparePart $sparePart)
    {
        $sparePart->delete();

        return redirect()->route('spare-parts.index')->with('success', 'Pièce supprimée avec succès.');
    }

    protected function notifyAdminsIfLowStock(SparePart $sparePart): void
    {
        if ($sparePart->quantity_in_stock > $sparePart->minimum_stock) {
            return;
        }

        $admins = User::query()
            ->where('role', 'admin')
            ->whereNotNull('email')
            ->get();

        if ($admins->isEmpty()) {
            return;
        }

        Notification::send($admins, new LowStockNotification($sparePart));
    }
}
