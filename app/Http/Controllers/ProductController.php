<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retorna la vista para crear un nuevo producto
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sku' => 'required|string|unique:products',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $product = new Product();
        $product->sku = $validatedData['sku'];
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->save();

        return response()->json(['message' => 'Producto creado exitosamente', 'product' => $product], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Encuentra el producto por su ID
        $product = Product::findOrFail($id);

        // Retorna la vista para editar un producto, pasando el producto a la vista
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'sku' => 'sometimes|required|string|unique:products,sku,' . $id,
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
        ]);

        if (isset($validatedData['sku'])) {
            $product->sku = $validatedData['sku'];
        }
        if (isset($validatedData['name'])) {
            $product->name = $validatedData['name'];
        }
        if (isset($validatedData['description'])) {
            $product->description = $validatedData['description'];
        }
        if (isset($validatedData['price'])) {
            $product->price = $validatedData['price'];
        }

        $product->save();

        return response()->json(['message' => 'Producto actualizado exitosamente', 'product' => $product], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Producto eliminado exitosamente'], 200);
    }
}
