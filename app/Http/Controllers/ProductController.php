<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('product.dashboard', compact('products'));
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
            'nombre' => 'required|string|max:255',
            'descripcion_corta' => 'required|string|max:255',
            'descripcion_larga' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'precio_neto' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'stock_actual' => 'required|integer',
            'stock_minimo' => 'required|integer',
            'stock_bajo' => 'required|integer',
            'stock_alto' => 'required|integer',
        ]);

        $product = new Product();
        $product->sku = $validatedData['sku'];
        $product->nombre = $validatedData['nombre'];
        $product->descripcion_corta = $validatedData['descripcion_corta'];
        $product->descripcion_larga = $validatedData['descripcion_larga'];
        // Almacenar la imagen si está presente
        if ($request->hasFile('imagen')) {
            $imagePath = $request->file('imagen')->store('products', 'public');
            $product->imagen = $imagePath; // Guardar la ruta en la base de datos
        }
        $product->precio_neto = $validatedData['precio_neto'];
        $product->precio_venta = $validatedData['precio_venta'];
        $product->stock_actual = $validatedData['stock_actual'];
        $product->stock_minimo = $validatedData['stock_minimo'];
        $product->stock_bajo = $validatedData['stock_bajo'];
        $product->stock_alto = $validatedData['stock_alto'];
        $product->save();

        return redirect()->route('product.dashboard');
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
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'sku' => 'sometimes|required|string|unique:products,sku,' . $id,
            'nombre' => 'sometimes|required|string|max:255',
            'descripcion_corta' => 'sometimes|required|string|max:255',
            'descripcion_larga' => 'sometimes|required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'precio_neto' => 'sometimes|required|numeric',
            'precio_venta' => 'sometimes|required|numeric',
            'stock_actual' => 'sometimes|required|integer',
            'stock_minimo' => 'sometimes|required|integer',
            'stock_bajo' => 'sometimes|required|integer',
            'stock_alto' => 'sometimes|required|integer',
        ]);

        if (isset($validatedData['sku'])) {
            $product->sku = $validatedData['sku'];
        }
        if (isset($validatedData['nombre'])) {
            $product->nombre = $validatedData['nombre'];
        }
        if (isset($validatedData['descripcion_corta'])) {
            $product->descripcion_corta = $validatedData['descripcion_corta'];
        }
        if (isset($validatedData['descripcion_larga'])) {
            $product->descripcion_larga = $validatedData['descripcion_larga'];
        }
        // Almacenar la nueva imagen si se proporciona
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($product->imagen && Storage::disk('public')->exists($product->imagen)) {
                Storage::disk('public')->delete($product->imagen);
            }

            // Almacenar la nueva imagen
            $imagePath = $request->file('imagen')->store('products', 'public');
            $product->imagen = $imagePath;
        }
        if (isset($validatedData['precio_neto'])) {
            $product->precio_neto = $validatedData['precio_neto'];
        }
        if (isset($validatedData['precio_venta'])) {
            $product->precio_venta = $validatedData['precio_venta'];
        }
        if (isset($validatedData['stock_actual'])) {
            $product->stock_actual = $validatedData['stock_actual'];
        }
        if (isset($validatedData['stock_minimo'])) {
            $product->stock_minimo = $validatedData['stock_minimo'];
        }
        if (isset($validatedData['stock_bajo'])) {
            $product->stock_bajo = $validatedData['stock_bajo'];
        }
        if (isset($validatedData['stock_alto'])) {
            $product->stock_alto = $validatedData['stock_alto'];
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
