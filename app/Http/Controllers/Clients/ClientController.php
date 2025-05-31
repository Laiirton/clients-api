<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Exibe uma lista de todos os clientes.
     */
    public function index()
    {
        $clients = Client::latest()->get();
        return view('clients.index', compact('clients'));
    }

    /**
     * Mostra o formulário para criar um novo cliente.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Armazena um cliente recém-criado.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'site' => 'nullable|url|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Gerar API key automaticamente
        $data = $request->all();
        $data['api_key'] = Client::generateApiKey();

        Client::create($data);

        return redirect()->route('clients.index')
            ->with('success', 'Cliente criado com sucesso!');
    }

    /**
     * Mostra o formulário para editar um cliente específico.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Atualiza um cliente específico.
     */
    public function update(Request $request, Client $client)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'site' => 'nullable|url|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $client->update($request->all());

        return redirect()->route('clients.index')
            ->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove um cliente específico.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Cliente removido com sucesso!');
    }

    /**
     * Regenera a API key para um cliente específico.
     */
    public function regenerateApiKey(Client $client)
    {
        $client->api_key = Client::generateApiKey();
        $client->save();

        return redirect()->route('clients.edit', $client)
            ->with('success', 'API Key regenerada com sucesso!');
    }
}
