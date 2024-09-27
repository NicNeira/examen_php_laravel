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
        // Retorna la vista del dashboard de clientes
        return view('client.dashboard', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Si no utilizas esta función, puedes eliminarla o dejarla vacía.
    }

    /**
     * Store a newly created resource in storage.
     */
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

        $client = new Client();
        $client->rut_empresa = $validatedData['rut_empresa'];
        $client->rubro = $validatedData['rubro'];
        $client->razon_social = $validatedData['razon_social'];
        $client->telefono = $validatedData['telefono'];
        $client->direccion = $validatedData['direccion'];
        $client->nombre_contacto = $validatedData['nombre_contacto'];
        $client->email_contacto = $validatedData['email_contacto'];
        $client->save();

        // Puedes redirigir al dashboard con un mensaje de éxito
        return redirect()->route('client.dashboard')->with('success', 'Cliente creado exitosamente');
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
        $client = Client::findOrFail($id);
        return response()->json($client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

        if (isset($validatedData['rut_empresa'])) {
            $client->rut_empresa = $validatedData['rut_empresa'];
        }
        if (isset($validatedData['rubro'])) {
            $client->rubro = $validatedData['rubro'];
        }
        if (isset($validatedData['razon_social'])) {
            $client->razon_social = $validatedData['razon_social'];
        }
        if (isset($validatedData['telefono'])) {
            $client->telefono = $validatedData['telefono'];
        }
        if (isset($validatedData['direccion'])) {
            $client->direccion = $validatedData['direccion'];
        }
        if (isset($validatedData['nombre_contacto'])) {
            $client->nombre_contacto = $validatedData['nombre_contacto'];
        }
        if (isset($validatedData['email_contacto'])) {
            $client->email_contacto = $validatedData['email_contacto'];
        }

        $client->save();

        // Puedes redirigir al dashboard con un mensaje de éxito
        return redirect()->route('client.dashboard')->with('success', 'Cliente actualizado exitosamente');
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
