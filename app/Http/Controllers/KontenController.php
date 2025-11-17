<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KontenController extends Controller
{
    public function index()
    {
        $kontens = Konten::all();
        return view('tampilan-admin.konten-index', compact('kontens'));
    }

    public function create()
    {
        return view('tampilan-admin.konten-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required|string',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('konten', 'public');
        }

        Konten::create($validated);
        return redirect()->route('admin.konten.index')->with('success', 'Konten berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $konten = Konten::findOrFail($id);
        return view('tampilan-admin.konten-edit', compact('konten'));
    }

    public function update(Request $request, $id)
    {
        $konten = Konten::findOrFail($id);

        $validated = $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required|string',
        ]);

        if ($request->hasFile('gambar')) {
            if ($konten->gambar) {
                Storage::disk('public')->delete($konten->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('konten', 'public');
        }

        $konten->update($validated);
        return redirect()->route('admin.konten.index')->with('success', 'Konten berhasil diupdate.');
    }

    public function destroy($id)
    {
        $konten = Konten::findOrFail($id);
        if ($konten->gambar) {
            Storage::disk('public')->delete($konten->gambar);
        }
        $konten->delete();
        return redirect()->route('admin.konten.index')->with('success', 'Konten berhasil dihapus.');
    }
}
