<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppRating;
use Illuminate\Http\Request;

class AppRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'app_rating'   => 'required|integer|min:1|max:5',
            'app_feedback' => 'nullable|string',
        ]);

        $rating = AppRating::create([
            'user_id'      => $request->user()->id,
            'app_rating'   => $validated['app_rating'],
            'app_feedback' => $validated['app_feedback'] ?? null,
        ]);

        return response()->json([
            'message' => 'Terima kasih sudah memberi rating dan feedback!',
            'data'    => $rating,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
