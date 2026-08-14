<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeviceStoreRequest;
use App\Http\Requests\DeviceUpdateRequest;
use App\Models\Client;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DeviceController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $devices = Device::with('client')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('brand', 'like', "%{$search}%")
                        ->orWhere('model', 'like', "%{$search}%")
                        ->orWhere('serial_number', 'like', "%{$search}%")
                        ->orWhere('type', 'like', "%{$search}%")
                        ->orWhereHas('client', function ($clientQuery) use ($search) {
                            $clientQuery->where('first_name', 'like', "%{$search}%")
                                ->orWhere('last_name', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('brand')
            ->orderBy('model')
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('devices.index', compact('devices', 'search'));
    }

    public function create(): View
    {
        $clients = Client::orderBy('last_name')->get();

        return view('devices.create', compact('clients'));
    }

    public function store(DeviceStoreRequest $request)
    {
        Device::create($request->validated());

        return redirect()->route('devices.index')->with('success', 'Appareil ajouté avec succès.');
    }

    public function show(Device $device): View
    {
        return view('devices.show', compact('device'));
    }

    public function edit(Device $device): View
    {
        $clients = Client::orderBy('last_name')->get();

        return view('devices.edit', compact('device', 'clients'));
    }

    public function update(DeviceUpdateRequest $request, Device $device)
    {
        $device->update($request->validated());

        return redirect()->route('devices.index')->with('success', 'Appareil mis à jour avec succès.');
    }

    public function destroy(Device $device)
    {
        $device->delete();

        return redirect()->route('devices.index')->with('success', 'Appareil supprimé avec succès.');
    }
}
