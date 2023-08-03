<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerHomeController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Seller Page - Seller - Online Store";
        return view('seller.home.index')->with("viewData", $viewData);
    }
}