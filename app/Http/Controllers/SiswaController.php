<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Siswa::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nisn' => 'required|integer|max:255',
            'nama' => 'required|string|max:255|unique:siswas',
            'kelas' => 'required|string|min:1',
        ]);

        $siswa = Siswa::create($validatedData);

        return response()->json($siswa, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json(['message' => 'Siswa not found'], 404);
        }

        return response()->json($siswa, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json(['message' => 'Siswa not found'], 404);
        }

        $validatedData = $request->validate([
            'nisn' => 'sometimes|required|string|max:255',
            'nama' => 'sometimes|required|string|max:255|unique:siswas,nama,' . $id,
            'kelas' => 'sometimes|required|integer|min:1',
        ]);

        $siswa->update($validatedData);

        return response()->json($siswa, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json(['message' => 'Siswa not found'], 404);
        }

        $siswa->delete();

        return response()->json(['message' => 'Siswa deleted successfully'], 200);
    }
}
