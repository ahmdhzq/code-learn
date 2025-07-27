<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadController extends Controller
{
    /**
     * Upload image untuk CKEditor dari admin
     */
    public function uploadForAdmin(Request $request)
    {
        // Validasi hanya admin yang bisa upload
        if (!auth()->user()->hasRole(roles: 'admin')) {
            return response()->json([
                'error' => [
                    'message' => 'Unauthorized access'
                ]
            ], 403);
        }

        return $this->handleImageUpload($request, 'admin');
    }

    /**
     * Upload image untuk CKEditor dari user biasa
     */
    public function uploadForUser(Request $request)
    {
        // Validasi user sudah login dan punya permission upload-materi
        if (!auth()->check() || !auth()->user()->can('upload-materi')) {
            return response()->json([
                'error' => [
                    'message' => 'Unauthorized access'
                ]
            ], 403);
        }

        return $this->handleImageUpload($request, 'user');
    }

    /**
     * Handle upload image logic
     */
    private function handleImageUpload(Request $request, string $userType)
    {
        try {
            $request->validate([
                'upload' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Max 2MB
            ]);

            $file = $request->file('upload');
            
            // Generate unique filename
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            
            // Store in different directories based on user type
            $directory = $userType === 'admin' ? 'images/materials/admin' : 'images/materials/user';
            $path = $file->storeAs($directory, $fileName, 'public');
            
            // Get full URL - pastikan menggunakan asset() atau url() yang benar
            $fullUrl = asset('storage/' . $path);
            
            // CKEditor 4 expects this specific response format
            return response()->json([
                'uploaded' => 1,
                'fileName' => $fileName,
                'url' => $fullUrl
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'uploaded' => 0,
                'error' => [
                    'message' => 'Validation failed: ' . implode(', ', $e->errors()['upload'] ?? ['Unknown validation error'])
                ]
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'uploaded' => 0,
                'error' => [
                    'message' => 'Failed to upload image: ' . $e->getMessage()
                ]
            ], 500);
        }
    }

    /**
     * Delete uploaded image (optional - untuk cleanup)
     */
    public function deleteImage(Request $request)
    {
        $request->validate([
            'path' => 'required|string'
        ]);

        try {
            $path = str_replace('/storage/', '', $request->path);
            
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
                return response()->json(['success' => true]);
            }
            
            return response()->json(['error' => 'File not found'], 404);
            
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}