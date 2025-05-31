<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Exibe o painel de controle com informações sobre os clientes.
     */
    public function index()
    {
        $totalClients = Client::count();
        $activeClients = Client::where('status', 'active')->count();
        $inactiveClients = Client::where('status', 'inactive')->count();
        
        $latestClients = Client::latest()->take(5)->get();
        
        return view('dashboard', compact('totalClients', 'activeClients', 'inactiveClients', 'latestClients'));
    }
}
