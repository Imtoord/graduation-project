<?php

namespace App\Http\Controllers;

use App\Models\Charity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CharityController extends Controller
{
    public function allCharity()
    {
        // Fetch all charities
        $charities = Charity::all();

        return response()->json($charities, 200);
    }

    public function show($id)
    {
        $charity = Charity::find($id);
        if($charity) {
            return response()->json($charity, 200);
        } else {
            // User not found, return an error response
            return response()->json(['error' => 'charity not found'], 404);
        }
    }

     public function createCharity(Request $request)
    {
        // Validate request data
      $validator = Validator::make($request->all(), [
            'CharityName' => 'required|string|unique:charities,CharityName',
            'Description' => 'required|string',
            'Email' => 'required|email|unique:charities,Email',
            'Phone' => 'required|string|unique:charities,Phone',
            'Address' => 'required|string',
            'Logo' => 'nullable|string',
            'RegistrationDate' => 'required|date',
            'FounderName' => 'required|string',
            'EstablishedYear' => 'required|integer',
            'DonationTotal' => 'required|numeric',
            'IsActive' => 'required|boolean',
        ]);


        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Create a new charity
        $charity = Charity::create($request->all());

        return response()->json($charity, 201);
    }



    public function updateCharity(Request $request, $id)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'CharityName' => 'nullable|string',
            'Description' => 'nullable|string',
            'Email' => 'nullable|email',
            'Phone' => 'nullable|string',
            'Address' => 'nullable|string',
            'Logo' => 'nullable|string',
            'RegistrationDate' => 'nullable|date',
            'FounderName' => 'nullable|string',
            'EstablishedYear' => 'nullable|integer',
            'DonationTotal' => 'nullable|numeric',
            'IsActive' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            // Attempt to find and update the specified charity
            $charity = Charity::findOrFail($id);
            $charity->update($request->all());

            return response()->json($charity, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // ID is not found in the database, return an error response
            return response()->json(['error' => 'Charity not found'], 404);
        }
    }


    
   public function deleteCharity($id)
    {
        try {
            // Attempt to find and delete the specified charity
            $charity = Charity::findOrFail($id);
            $charity->delete();
            
            return response()->json(['message' => 'Charity deleted successfully'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // ID is not found in the database, return an error response
            return response()->json(['error' => 'Charity not found'], 404);
        }
    }

}
