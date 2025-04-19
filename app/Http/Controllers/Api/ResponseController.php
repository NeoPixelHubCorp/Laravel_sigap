<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Response;
use Illuminate\Support\Facades\Validator;

class ResponseController extends Controller
{
    /**
     * Display a listing of the responses.
     */
    public function index()
    {
        $responses = Response::with(['complain', 'admin', 'updatedBy', 'handledBy'])->get();
        return response()->json($responses);
    }

    /**
     * Store a newly created response in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'complain_id' => 'required|exists:complains,id',
            'admin_id' => 'required|exists:users,id',
            'response' => 'nullable|string',
            'updated_by' => 'nullable|exists:users,id',
            'handled_by' => 'nullable|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $response = Response::create($request->all());

        return response()->json([
            'message' => 'Respon berhasil dibuat.',
            'data' => $response,
        ], 201);
    }

    /**
     * Display the specified response.
     */
    public function show(string $id)
    {
        $response = Response::with(['complain', 'admin', 'updatedBy', 'handledBy'])->find($id);

        if (!$response) {
            return response()->json(['message' => 'Respon tidak ditemukan.'], 404);
        }

        return response()->json($response);
    }

    /**
     * Update the specified response in storage.
     */
    public function update(Request $request, string $id)
    {
        $response = Response::find($id);

        if (!$response) {
            return response()->json(['message' => 'Respon tidak ditemukan.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'complain_id' => 'sometimes|exists:complains,id',
            'admin_id' => 'sometimes|exists:users,id',
            'response' => 'nullable|string',
            'updated_by' => 'nullable|exists:users,id',
            'handled_by' => 'nullable|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $response->update($request->all());

        return response()->json([
            'message' => 'Respon berhasil diperbarui.',
            'data' => $response,
        ]);
    }

    /**
     * Remove the specified response from storage.
     */
    public function destroy(string $id)
    {
        $response = Response::find($id);

        if (!$response) {
            return response()->json(['message' => 'Respon tidak ditemukan.'], 404);
        }

        $response->delete();

        return response()->json(['message' => 'Respon berhasil dihapus.']);
    }
}
