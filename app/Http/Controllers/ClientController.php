<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $clients = Client::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('city', 'like', "%{$search}%");
                });
            })
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('clients.index', compact('clients', 'search'));
    }

    public function create(): View
    {
        return view('clients.create');
    }

    public function store(ClientStoreRequest $request)
    {
        Client::create($request->validated());

        return redirect()->route('clients.index')->with('success', 'Client ajouté avec succès.');
    }

    public function show(Client $client): View
    {
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client): View
    {
        return view('clients.edit', compact('client'));
    }

    public function update(ClientUpdateRequest $request, Client $client)
    {
        $client->update($request->validated());

        return redirect()->route('clients.index')->with('success', 'Client mis à jour avec succès.');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès.');
    }
}
