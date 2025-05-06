<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complain;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ComplainController extends Controller
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
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'latitude'    => 'required|numeric',
            'longitude'   => 'required|numeric',
            'address'     => 'nullable|string',
            'city'        => 'nullable|string',
            'district'    => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('complains', 'public');
        }

        $complain = Complain::create($validated);

        return response()->json([
            'message' => 'Aduan berhasil dibuat',
            'data' => $complain,
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    // melihat semua aduan yang di buat oleh user yang login
    public function userComplains()
    {
        $complains = Complain::where('user_id', auth()->id())->get();

        return response()->json(['data' => $complains]);
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
    {
        $complain = Complain::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();   

        $validated = $request->validate([
            'title'       => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'latitude'    => 'sometimes|numeric',
            'longitude'   => 'sometimes|numeric',
            'address'     => 'nullable|string',
            'city'        => 'nullable|string',
            'district'    => 'nullable|string',
            'category_id' => 'sometimes|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            if ($complain->image) {
                Storage::disk('public')->delete($complain->image);
            }
            $validated['image'] = $request->file('image')->store('complains', 'public');
        }

        $complain->update($validated);

        return response()->json([
            'message' => 'Aduan berhasil diperbarui',
            'data' => $complain,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $complain = Complain::where('id', $id)
        ->where('user_id', auth()->id()) // hanya aduan milik user login
        ->firstOrFail();

    // Hapus gambar jika ada
    if ($complain->image) {
        Storage::disk('public')->delete($complain->image);
    }

    $complain->delete();

    return response()->json([
        'message' => 'Aduan berhasil dihapus',
    ]);
}

}
