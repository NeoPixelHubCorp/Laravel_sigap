<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ComplainRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplainRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan semua data complain rating
        $complainRatings = ComplainRating::all();
        return response()->json($complainRatings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'complains_id' => 'required|exists:complains,id', // Pastikan complain_id valid
            'user_id' => 'required|exists:users,id', // Pastikan user_id valid
            'complain_rating' => 'required|integer|min:1|max:5', // Rating antara 1 hingga 5
            'complain_feedback' => 'nullable|string', // Feedback bersifat opsional
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Menyimpan data complain rating
        $complainRating = ComplainRating::create([
            'complains_id' => $request->complains_id,
            'user_id' => $request->user_id,
            'complain_rating' => $request->complain_rating,
            'complain_feedback' => $request->complain_feedback,
        ]);

        return response()->json($complainRating, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menampilkan satu complain rating berdasarkan id
        $complainRating = ComplainRating::find($id);

        if (!$complainRating) {
            return response()->json(['message' => 'Complain Rating not found'], 404);
        }

        return response()->json($complainRating);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'complains_id' => 'required|exists:complains,id', // Pastikan complain_id valid
            'user_id' => 'required|exists:users,id', // Pastikan user_id valid
            'complain_rating' => 'required|integer|min:1|max:5', // Rating antara 1 hingga 5
            'complain_feedback' => 'nullable|string', // Feedback bersifat opsional
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Mencari complain rating berdasarkan ID
        $complainRating = ComplainRating::find($id);

        if (!$complainRating) {
            return response()->json(['message' => 'Complain Rating not found'], 404);
        }

        // Mengupdate data complain rating
        $complainRating->update([
            'complains_id' => $request->complains_id,
            'user_id' => $request->user_id,
            'complain_rating' => $request->complain_rating,
            'complain_feedback' => $request->complain_feedback,
        ]);

        return response()->json($complainRating);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari complain rating berdasarkan ID
        $complainRating = ComplainRating::find($id);

        if (!$complainRating) {
            return response()->json(['message' => 'Complain Rating not found'], 404);
        }

        // Menghapus complain rating
        $complainRating->delete();

        return response()->json(['message' => 'Complain Rating deleted successfully']);
    }
}
