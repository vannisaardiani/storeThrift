<?php

namespace App\Http\Controllers\Seller;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SellerProductController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Seller Page - Products - Online Store";
        $viewData["products"] = Product::all();
        return view('seller.product.index')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        Product::validate($request);

        $newProduct = new Product();
        $newProduct->setName($request->input('name'));
        $newProduct->setDescription($request->input('description'));
        $newProduct->setPrice($request->input('price'));
        $newProduct->setImage("game.png");
        $newProduct->save();

        if ($request->hasFile('image')) {
            $imageName = $newProduct->getId().".".$request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $newProduct->setImage($imageName);
            $newProduct->save();
        }

        return back();
    }

    public function delete($id)
    {
        Product::destroy($id);
        return back();
    }

    public function edit($id)
    {
        $viewData = [];
        $viewData["title"] = "Seller Page - Edit Product - Online Store";
        $viewData["product"] = Product::findOrFail($id);
        return view('seller.product.edit')->with("viewData", $viewData);
    }

    public function update(Request $request, $id)
    {
        Product::validate($request);

        $product = Product::findOrFail($id);
        $product->setName($request->input('name'));
        $product->setDescription($request->input('description'));
        $product->setPrice($request->input('price'));

        if ($request->hasFile('image')) {
            $imageName = $product->getId().".".$request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $product->setImage($imageName);
        }

        $product->save();
        return redirect()->route('seller.product.index');
    }
    public function search(Request$request) {
        if($request->has('search')) {
            $product = Product::where('products','LIKE','%'.$request->search. '%')->get();
        }
        else{
            $product = Product::all();
        }

        return view('product.index', ['products' => $product]);
    }
}