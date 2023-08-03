<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
{
    $viewData = [];
    $viewData["title"] = "Products - Online Store";
    $viewData["subtitle"] = "List of products";
    $viewData["products"] = Product::all();
    return view('product.index', compact('viewData'));
}

public function show($id)
{
    $viewData = [];
    $product = Product::findOrFail($id);
    $viewData["title"] = $product->name . " - Online Store";
    $viewData["subtitle"] = $product->name . " - Product information";
    $viewData["product"] = $product;
    return view('product.show', compact('viewData'));
}


    public function search(Request $request)
    {
        $viewData = [];
        $search = $request->input('search');
        $products = Product::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->get();

        $viewData["title"] = " - Online Store";
        $viewData["subtitle"] = " - Product information";
        return view('product.search', compact('products'));
    }
}
