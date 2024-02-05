<?php

namespace App\Http\Controllers;

// app/Http/Controllers/Api/CharityCategoryController.php

use App\Models\CharityCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CharityCategoryController extends Controller
{
    public function index()
    {
        $charityCategories = CharityCategory::all();
        return response()->json($charityCategories);
    }

    public function show($id)
    {
        try {
            $charityCategory = CharityCategory::findOrFail($id);
            return response()->json($charityCategory, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'CharityCategory not found'], 404);
        }
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'charity_id' => 'required|exists:charities,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Create a new CharityCategory
        $charityCategory = CharityCategory::create($request->all());

        return response()->json($charityCategory, 201);
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'charity_id' => 'required|exists:charities,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            // Attempt to find and update the specified CharityCategory
            $charityCategory = CharityCategory::findOrFail($id);
            $charityCategory->update($request->all());

            return response()->json($charityCategory, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // ID is not found in the database, return an error response
            return response()->json(['error' => 'CharityCategory not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            // Attempt to find and delete the specified CharityCategory
            $charityCategory = CharityCategory::findOrFail($id);
            $charityCategory->delete();

            return response()->json(null, 204);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // ID is not found in the database, return an error response
            return response()->json(['error' => 'CharityCategory not found'], 404);
        }
    }
}

