<?php

namespace App\Http\Controllers;

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
        ]);

        $reportRequest = \App\Models\ReportRequest::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'scores' => $validated['scores'],
            'profile' => $validated['profile'],
            'strengths' => $validated['strengths'],
            'growth_areas' => $validated['growth_areas'],
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Report request saved successfully.',
            'data' => clone $reportRequest, // Return the saved request (excluding sensitive info if any)
        ], 201);
    }
}
