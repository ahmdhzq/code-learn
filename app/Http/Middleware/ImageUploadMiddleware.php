<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ImageUploadMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Limit upload rate (optional)
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            
            // Additional security checks
            $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
            
            if (!in_array($file->getMimeType(), $allowedMimes)) {
                return response()->json([
                    'uploaded' => false,
                    'error' => [
                        'message' => 'Invalid file type. Only JPEG, PNG, JPG, GIF, and WebP are allowed.'
                    ]
                ], 400);
            }
            
            // Check file size (2MB max)
            if ($file->getSize() > 2 * 1024 * 1024) {
                return response()->json([
                    'uploaded' => false,
                    'error' => [
                        'message' => 'File size too large. Maximum size is 2MB.'
                    ]
                ], 400);
            }
        }

        return $next($request);
    }
}