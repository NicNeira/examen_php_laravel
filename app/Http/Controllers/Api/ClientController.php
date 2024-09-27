<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return response()->json($clients);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'rut_empresa' => 'required|string|unique:clients',
            'rubro' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'nombre_contacto' => 'required|string|max:255',
            'email_contacto' => 'required|string|email|max:255|unique:clients',
        ]);

        $client = Client::create($validatedData);

        return response()->json(['message' => 'Cliente creado exitosamente', 'client' => $client], 201);
    }

    public function show($id)
    {
        $client = Client::findOrFail($id);
        return response()->json($client);
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $validatedData = $request->validate([
            'rut_empresa' => 'sometimes|required|string|unique:clients,rut_empresa,' . $id,
            'rubro' => 'sometimes|required|string|max:255',
            'razon_social' => 'sometimes|required|string|max:255',
            'telefono' => 'sometimes|required|string|max:20',
            'direccion' => 'sometimes|required|string|max:255',
            'nombre_contacto' => 'sometimes|required|string|max:255',
            'email_contacto' => 'sometimes|required|string|email|max:255|unique:clients,email_contacto,' . $id,
        ]);

        $client->fill($validatedData);
        $client->save();

        return response()->json(['message' => 'Cliente actualizado exitosamente', 'client' => $client], 200);
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return response()->json(['message' => 'Cliente eliminado exitosamente'], 200);
    }
}
