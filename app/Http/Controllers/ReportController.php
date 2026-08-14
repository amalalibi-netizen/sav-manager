<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Repair;
use App\Models\SparePart;
use App\Models\Client;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        $totalTickets = Ticket::count();
        $completedTickets = Ticket::where('status', 'completed')->count();
        $totalRepairs = Repair::count();
        $totalClients = Client::count();
        $totalParts = SparePart::count();

        $totalRevenue = Repair::sum('total_cost');
        $totalLabor = Repair::sum('labor_cost');
        $totalPartsCost = Repair::sum('parts_cost');

        return view('reports.index', compact(
            'totalTickets',
            'completedTickets',
            'totalRepairs',
            'totalClients',
            'totalParts',
            'totalRevenue',
            'totalLabor',
            'totalPartsCost'
        ));
    }
}