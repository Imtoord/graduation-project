<?php

namespace App\Http\Controllers;

use App\Models\FavoriteCharity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoriteCharityController extends Controller
{
    public function index()
    {
        $favoriteCharities = FavoriteCharity::all();
        return response()->json($favoriteCharities);
    }

    public function show($id)
    {
        try {
            $favoriteCharity = FavoriteCharity::findOrFail($id);
            return response()->json($favoriteCharity, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'FavoriteCharity not found'], 404);
        }
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'UserID' => 'required|exists:users,id',
            'CharityID' => 'required|exists:charities,CharityID',
        ]);

        // Create a new FavoriteCharity
        $favoriteCharity = FavoriteCharity::create($request->all());

        return response()->json($favoriteCharity, 201);
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'UserID' => 'required|exists:users,id',
            'CharityID' => 'required|exists:charities,CharityID',
        ]);

        try {
            // Attempt to find and update the specified FavoriteCharity
            $favoriteCharity = FavoriteCharity::findOrFail($id);
            $favoriteCharity->update($request->all());

            return response()->json($favoriteCharity, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // ID is not found in the database, return an error response
            return response()->json(['error' => 'FavoriteCharity not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            // Attempt to find and delete the specified FavoriteCharity
            $favoriteCharity = FavoriteCharity::findOrFail($id);
            $favoriteCharity->delete();

            return response()->json(null, 204);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // ID is not found in the database, return an error response
            return response()->json(['error' => 'FavoriteCharity not found'], 404);
        }
    }
}


