<?php
namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MejaController extends Controller
{
    public function index()
    {
        $mejas = Meja::all();
        return view('crud', compact('mejas'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'          => 'required|string|max:255',
            'harga_per_jam' => 'required|numeric',
            'asal'          => 'required|in:vip,regular',
            'deskripsi'     => 'required|string',
            'gambar'        => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')
                                    ->store('meja_images', 'public');
        }

        Meja::create($data);

        return redirect()->route('admin.meja.index')
                         ->with('success','Meja berhasil ditambahkan.');
    }

    public function edit(Meja $meja)
    {
        return view('edit', compact('meja'));
    }

    public function update(Request $request, Meja $meja)
    {
        $data = $request->validate([
            'nama'          => 'required|string|max:255',
            'harga_per_jam' => 'required|numeric',
            'asal'          => 'required|in:vip,regular',
            'deskripsi'     => 'required|string',
            'gambar'        => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($meja->gambar) {
                Storage::disk('public')->delete($meja->gambar);
            }
            $data['gambar'] = $request->file('gambar')
                                    ->store('meja_images','public');
        }

        $meja->update($data);

        return redirect()->route('admin.meja.index')
                         ->with('success','Meja berhasil diperbarui.');
    }

    public function destroy(Meja $meja)
    {
        if ($meja->gambar) {
            Storage::disk('public')->delete($meja->gambar);
        }
        $meja->delete();

        return redirect()->route('admin.meja.index')
                         ->with('success','Meja berhasil dihapus.');
    }
}
