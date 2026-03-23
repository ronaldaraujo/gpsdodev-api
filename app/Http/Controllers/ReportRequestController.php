<?php

namespace App\Http\Controllers;

use App\Models\BussolaSubmission;
use App\Models\ReportRequest;
use Illuminate\Http\Request;

class ReportRequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'scores' => 'required|array',
            'profile' => 'required|array',
            'strengths' => 'required|array',
            'growth_areas' => 'required|array',
            'submission_token' => 'nullable|string|uuid',
        ]);

        $reportRequest = ReportRequest::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'scores' => $validated['scores'],
            'profile' => $validated['profile'],
            'strengths' => $validated['strengths'],
            'growth_areas' => $validated['growth_areas'],
            'status' => 'pending',
        ]);

        // Link anonymous submission if token was provided
        if (!empty($validated['submission_token'])) {
            BussolaSubmission::where('token', $validated['submission_token'])
                ->whereNull('report_request_id')
                ->update(['report_request_id' => $reportRequest->id]);
        }

        return response()->json([
            'message' => 'Report request saved successfully.',
            'data' => $reportRequest,
        ], 201);
    }
}
