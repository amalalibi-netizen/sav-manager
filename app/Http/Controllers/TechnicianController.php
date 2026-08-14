<?php

namespace App\Http\Controllers;

use App\Http\Requests\TechnicianStoreRequest;
use App\Http\Requests\TechnicianUpdateRequest;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TechnicianController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $technicians = Technician::when($search !== '', function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        })
            ->orderBy('name')
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('technicians.index', compact('technicians', 'search'));
    }

    public function create(): View
    {
        return view('technicians.create');
    }

    public function store(TechnicianStoreRequest $request)
    {
        Technician::create($request->validated());

        return redirect()->route('technicians.index')->with('success', 'Technicien ajouté avec succès.');
    }

    public function show(Technician $technician): View
    {
        return view('technicians.show', compact('technician'));
    }

    public function edit(Technician $technician): View
    {
        return view('technicians.edit', compact('technician'));
    }

    public function update(TechnicianUpdateRequest $request, Technician $technician)
    {
        $technician->update($request->validated());

        return redirect()->route('technicians.index')->with('success', 'Technicien mis à jour avec succès.');
    }

    public function destroy(Technician $technician)
    {
        $technician->delete();

        return redirect()->route('technicians.index')->with('success', 'Technicien supprimé avec succès.');
    }
}
