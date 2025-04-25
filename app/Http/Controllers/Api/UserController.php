<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
public function update(Request $request)
{
    $user = $request->user();

    $data = $request->validate([
        'name' => 'sometimes|string|max:255',
        'email' => 'sometimes|email|max:255|unique:users,email,' . $user->id,
        'phone_number' => 'nullable|string|unique:users,phone_number,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed',
        'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Upload foto jika ada
    if ($request->hasFile('profile_photo')) {
        // Hapus foto lama kalau ada
        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }
        // Simpan foto baru
        $data['profile_photo'] = $request->file('profile_photo')->store('profile_photos', 'public');
    }

    // Hash password jika diisi
    if (!empty($data['password'])) {
        $data['password'] = Hash::make($data['password']);
    } else {
        unset($data['password']);
    }

    $user->update($data);

    $freshUser = $user->fresh(); // Ambil ulang user dari DB

    return response()->json([
        'message' => 'Profile Kamu Sudah Di Perbarui Ya',
        'user' => $freshUser,
        'photo_url' => $freshUser->profile_photo
            ? asset('storage/' . $freshUser->profile_photo)
            : null
    ]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
public function profile(Request $request)
{
    $user = $request->user();

    return response()->json([
        'message' => 'Ini profilmu',
        'user' => $user,
        'photo_url' => $user->profile_photo
            ? asset('storage/' . $user->profile_photo)
            : null
    ]);
}

}
