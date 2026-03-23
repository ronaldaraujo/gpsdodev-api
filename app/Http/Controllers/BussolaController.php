<?php

namespace App\Http\Controllers;

use App\Models\BussolaSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BussolaController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'answers' => 'required|array',
            'scores' => 'required|array',
            'profile' => 'required|array',
            'strengths' => 'required|array',
            'growth_areas' => 'required|array',
        ]);

        $submission = BussolaSubmission::create([
            'token' => Str::uuid()->toString(),
            'answers' => $validated['answers'],
            'scores' => $validated['scores'],
            'profile' => $validated['profile'],
            'strengths' => $validated['strengths'],
            'growth_areas' => $validated['growth_areas'],
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json([
            'message' => 'Submission saved successfully.',
            'token' => $submission->token,
        ], 201);
    }
}
