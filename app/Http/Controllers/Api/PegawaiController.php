<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        return response()->json(Pegawai::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'umur' => 'required|integer|min:0',
            'tanggal_masuk' => 'required|string',
        ]);

        $pegawai = Pegawai::create($validated);

        return response()->json($pegawai, 201);
    }

    public function show(Pegawai $pegawai)
    {
        return response()->json($pegawai);
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'umur' => 'sometimes|required|integer|min:0',
            'tanggal_masuk' => 'sometimes|required|string',
        ]);

        $pegawai->update($validated);

        return response()->json($pegawai);
    }

    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();

        return response()->json(null, 204);
    }
};