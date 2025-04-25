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
        
    }

    /**
     * Store a newly created response in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified response.
     */
    public function show(string $id)
    {

    }

    /**
     * Update the specified response in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified response from storage.
     */
    public function destroy(string $id)
    {

    }

    public function getResponseByComplain($complainId)
{
    $response = Response::with(['admin:id,name', 'updatedBy:id,name'])
        ->where('complain_id', $complainId)
        ->whereHas('complain', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->first();

    if (!$response) {
        return response()->json([
            'message' => 'Respon belum tersedia atau aduan tidak ditemukan.',
        ], 404);
    }

    return response()->json([
        'message' => 'Respon ditemukan.',
        'data' => [
            'response'     => $response->response,
            'admin_name'   => $response->admin->name ?? 'Admin',
            'updated_by'   => $response->updatedBy->name ?? null,
            'created_at'   => $response->created_at->toDateTimeString(),
            'updated_at'   => $response->updated_at->toDateTimeString(),
        ],
    ]);
}

}
