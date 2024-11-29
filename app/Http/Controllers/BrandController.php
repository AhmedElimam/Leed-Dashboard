<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return response()->json(['brands' => $brands]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands',
        ]);

        $brand = Brand::create([
            'name' => $request->name,
        ]);

        return response()->json(['brand' => $brand, 'message' => 'Brand created successfully']);
    }

    public function show($id)
    {
        $brand = Brand::with('products')->find($id);

        if (!$brand) {
            return response()->json(['message' => 'Brand not found'], 404);
        }

        return response()->json(['brand' => $brand]);
    }
}
