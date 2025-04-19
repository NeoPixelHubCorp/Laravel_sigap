<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complain;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua aduan yang ada
        $complains = Complain::with(['user', 'category'])->get();

        return response()->json([
            'complains' => $complains
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validated = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'status' => 'in:pending,diverifikasi,diteruskan_ke_instansi,dalam_penanganan,selesai',
            'visibility' => 'in:public,private',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_aduan' => 'nullable|date',
        ])->validate();

        // Mengupload gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('complains', 'public');
        }

        // Membuat aduan baru
        $complain = Complain::create([
            'user_id' => auth()->id(), // Menggunakan ID user yang login
            'category_id' => $validated['category_id'],
            'no_aduan' => 'ADUAN-' . strtoupper(uniqid()),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'location' => $validated['location'],
            'status' => $validated['status'] ?? 'pending',
            'visibility' => $validated['visibility'] ?? 'private',
            'tanggal_aduan' => $validated['tanggal_aduan'],
        ]);

        return response()->json([
            'message' => 'Complain created successfully',
            'complain' => $complain
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Cari aduan berdasarkan ID
        $complain = Complain::with(['user', 'category'])->find($id);

        if (!$complain) {
            return response()->json([
                'message' => 'Complain not found'
            ], 404);
        }

        return response()->json([
            'complain' => $complain
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data
        $validated = Validator::make($request->all(), [
            'category_id' => 'sometimes|required|exists:categories,id',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'location' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|in:pending,diverifikasi,diteruskan_ke_instansi,dalam_penanganan,selesai',
            'visibility' => 'sometimes|in:public,private',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_aduan' => 'nullable|date',
        ])->validate();

        // Cari aduan berdasarkan ID
        $complain = Complain::find($id);

        if (!$complain) {
            return response()->json([
                'message' => 'Complain not found'
            ], 404);
        }

        // Mengupdate gambar jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($complain->image) {
                \Storage::delete('public/' . $complain->image);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('complains', 'public');
            $complain->image = $imagePath;
        }

        // Update aduan dengan data baru
        $complain->update($validated);

        return response()->json([
            'message' => 'Complain updated successfully',
            'complain' => $complain
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari aduan berdasarkan ID
        $complain = Complain::find($id);

        if (!$complain) {
            return response()->json([
                'message' => 'Complain not found'
            ], 404);
        }

        // Hapus gambar jika ada
        if ($complain->image) {
            \Storage::delete('public/' . $complain->image);
        }

        // Hapus aduan
        $complain->delete();

        return response()->json([
            'message' => 'Complain deleted successfully'
        ], 200);
    }
}
