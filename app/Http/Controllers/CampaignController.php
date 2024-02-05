<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CampaignController extends Controller
{
    public function allCampaigns()
    {
        // Fetch all campaigns
        $campaigns = Campaign::all();

        return response()->json($campaigns, 200);
    }

    public function show($id)
    {
        // Fetch a specific user by ID
        // $campaign = Campaign::findOrFail($id);
        $campaign = Campaign::find($id);
        if($campaign ) {
            return response()->json($campaign, 200);
        } else {
            // User not found, return an error response
            return response()->json(['error' => 'campaign not found'], 404);
        }
    }

    public function createCampaign(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'CampaignName' => 'required|string',
            'Description' => 'required|string',
            'StartDate' => 'required|date',
            'EndDate' => 'required|date',
            'GoalAmount' => 'required|numeric',
            'CurrentAmount' => 'required|numeric',
            'CharityID' => 'required|exists:charities,CharityID',
            'Image' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Create a new campaign
        $campaign = Campaign::create($request->all());

        return response()->json($campaign, 201);
    }

    public function updateCampaign(Request $request, $id)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'CampaignName' => 'string',
            'Description' => 'string',
            'StartDate' => 'date',
            'EndDate' => 'date',
            'GoalAmount' => 'numeric',
            'CurrentAmount' => 'numeric',
            'CharityID' => 'exists:charities,CharityID',
            'Image' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Check if the campaign with the given ID exists
        $campaign = Campaign::find($id);

        if (!$campaign) {
            // ID not found, return an error response
            return response()->json(['error' => 'Campaign not found'], 404);
        }

        // Update the specified campaign
        $campaign->update($request->all());

        return response()->json($campaign, 200);
    }

    public function deleteCampaign($id)
    {
        // Delete the specified campaign
        $campaign = Campaign::findOrFail($id);
        $campaign->delete();
        return response()->json(['message' => 'Campaign deleted successfully'], 200);
    }
}
