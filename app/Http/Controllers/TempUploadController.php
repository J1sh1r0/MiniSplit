<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TempUploadController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('verification_video')) {
            $path = $request->file('verification_video')->store('temp_videos');

            // Guardar ruta en la sesión
            session(['verification_video_path' => $path]);

            return response()->json(['success' => true, 'path' => $path]);
        }

        return response()->json(['success' => false, 'message' => 'No se recibió el archivo.']);
    }
}
