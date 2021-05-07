<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductResquest;
use App\PanelProduct;
use App\Scopes\AvailableScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
    
        return view('products.index')->with([
            'products' => PanelProduct::without('images')->get(),
        ]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductResquest $request)
    {
        dd();
        $product = PanelProduct::create($request->validated());

        foreach($request->images as $image){
            $product->images()->create([
                'path' => 'images/' . $image->store('products', 'images')
            ]);
        }

        return redirect()
                ->route('products.index')
                ->withSuccess("El nuevo producto con el ID {$product->id} has sido creado con exito");
    }

    public function show(PanelProduct $product)
    {

        return view('products.show')->with([
            'product' => $product,
        ]);
    }

    public function edit(PanelProduct $product)
    {
        return view('products.edit')->with([
            'product' => $product

        ]);
    }

    public function update(ProductResquest $request ,PanelProduct $product)
    {
        $product->update($request->validated());

        if($request->hasFile('images'))
        {
            foreach($product->images as $image)
            {
                $path = storage_path("app/public/{$image->path}");

                File::delete($path);

                $image->delete();
            }

            foreach($request->images as $image){
                $product->images()->create([
                    'path' => 'images/' . $image->store('products', 'images')
                ]);
            }
            dd($product);
        }

        return redirect()
                ->route('products.index')
                ->withSuccess("El producto con el ID {$product->id} has sido editado con exito");
    }

    public function destroy(PanelProduct $product)
    {
        $product->delete();

        return redirect()
                ->route('products.index')
                ->withSuccess("El producto con el ID {$product->id} has sido eliminado con exito");
    }
}
