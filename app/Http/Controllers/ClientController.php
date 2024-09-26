<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return response()->json($clients);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retorna la vista para crear un nuevo cliente
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'rut' => 'required|string|unique:clients',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
        ]);

        $client = new Client();
        $client->rut = $validatedData['rut'];
        $client->name = $validatedData['name'];
        $client->email = $validatedData['email'];
        $client->save();

        return response()->json(['message' => 'Cliente creado exitosamente', 'client' => $client], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::findOrFail($id);
        return response()->json($client);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Encuentra el cliente por su ID
        $client = Client::findOrFail($id);

        // Retorna la vista para editar un cliente, pasando el cliente a la vista
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = Client::findOrFail($id);

        $validatedData = $request->validate([
            'rut' => 'sometimes|required|string|unique:clients,rut,' . $id,
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:clients,email,' . $id,
        ]);

        if (isset($validatedData['rut'])) {
            $client->rut = $validatedData['rut'];
        }
        if (isset($validatedData['name'])) {
            $client->name = $validatedData['name'];
        }
        if (isset($validatedData['email'])) {
            $client->email = $validatedData['email'];
        }

        $client->save();

        return response()->json(['message' => 'Cliente actualizado exitosamente', 'client' => $client], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return response()->json(['message' => 'Cliente eliminado exitosamente'], 200);
    }
}
