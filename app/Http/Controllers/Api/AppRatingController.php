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
        $ratings = AppRating::with('user')->latest()->get();
        return response()->json([
            'success' => true,
            'data' => $ratings
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'app_rating' => 'required|integer|min:1|max:5',
            'app_feedback' => 'nullable|string',
            'version' => 'nullable|string|max:20',
        ]);

        $rating = AppRating::create([
            'user_id' => auth()->id(),
            'app_rating' => $request->app_rating,
            'app_feedback' => $request->app_feedback,
            'version' => $request->version,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for rating our app! 🥰',
            'data' => $rating
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rating = AppRating::with('user')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $rating
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rating = AppRating::findOrFail($id);

        $request->validate([
            'app_rating' => 'sometimes|integer|min:1|max:5',
            'app_feedback' => 'nullable|string',
            'version' => 'nullable|string|max:20',
        ]);

        $rating->update($request->only('app_rating', 'app_feedback', 'version'));

        return response()->json([
            'success' => true,
            'message' => 'Rating updated successfully.',
            'data' => $rating
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rating = AppRating::findOrFail($id);
        $rating->delete();

        return response()->json([
            'success' => true,
            'message' => 'Rating deleted successfully.'
        ]);
    }
}
