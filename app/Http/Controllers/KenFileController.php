<?php

namespace App\Http\Controllers;

use App\Models\KenFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Log;

class KenFileController extends Controller
{
    /**
     * Display a listing of files.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $files = KenFile::all(['id', 'path', 'created_at']);
        return response()->json([
            'status' => 'success',
            'message' => 'List of files retrieved successfully.',
            'data' => $files,
        ], 200);
    }

    /**
     * Store a newly uploaded file.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|max:2048',
        ]);

        try {
            $file = $validated['file'];
            $path = $file->store('files');

            $kenFile = KenFile::create(['path' => $path]);

            return response()->json([
                'status' => 'success',
                'message' => 'File uploaded successfully.',
                'data' => ['id' => $kenFile->id, 'path' => $kenFile->url()],
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'File upload failed.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified file.
     *
     * @param \App\Models\KenFile $kenFile
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        try {
            $kenFile = KenFile::find($id);
            if (!$kenFile) {
            return response()->json([
                'status' => 'error',
                'message' => 'File not found.',
            ], 404);
            }
            return response()->json([
                'status' => 'success',
                'message' => 'File retrieved successfully.',
                'data' => ['id' => $kenFile->id, 'path' => $kenFile->url()],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve file.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified file.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        
        if (!$request->hasFile('file')) {
            return response()->json([
            'status' => 'error',
            'message' => 'No file provided.',
            ], 400);
        }

        $validated = $request->validate([
            'file' => 'required|file|max:2048',
        ]);


        $kenFile = KenFile::find($id);

        if (!$kenFile) {
            return response()->json([
                'status' => 'error',
                'message' => 'File not found.',
            ], 404);
        }

        try {
            // Delete the old file
            Storage::delete($kenFile->path);

            $file = $request->file('file');
            $path = $file->store('files');

            $kenFile->update(['path' => $path]);

            return response()->json([
                'status' => 'success',
                'message' => 'File updated successfully.',
                'data' => ['id' => $kenFile->id, 'path' => $kenFile->url()],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'File update failed.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified file.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $kenFile = KenFile::find($id);
        try {
            Storage::delete($kenFile->path);
            $kenFile->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'File deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'File deletion failed.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
