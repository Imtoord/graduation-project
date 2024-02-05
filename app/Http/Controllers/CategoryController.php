<?php

namespace App\Http\Controllers;

// app/Http/Controllers/Api/CategoryController.php


use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'Description' => 'nullable',
            'Image' => 'nullable',
        ]);

        $category = Category::create($request->all());

        return response()->json($category, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|unique:categories,name,' . $id,
            'Description' => 'nullable',
            'Image' => 'nullable',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return response()->json($category, 200);
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return response()->json(null, 204);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found'], 404);
        }
    }

}

