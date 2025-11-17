<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Meja;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Exports\TransactionsExport;

class AdminController extends Controller
{
    // Dashboard admin
    public function index(Request $request)
    {
        // User filter
        $searchUser = $request->input('search_user');
        $users = User::when($searchUser, fn($query) =>
            $query->where('name', 'like', "%$searchUser%")
                  ->orWhere('email', 'like', "%$searchUser%")
        )->paginate(10);

        // Transaksi filter
        $searchTrx  = $request->input('search_transaksi');
        $filterStat = $request->input('status');

        $transaksis = Transaction::when($searchTrx, fn($query) =>
                            $query->where('order_id', 'like', "%$searchTrx%")
                                  ->orWhereHas('user', fn($q) =>
                                      $q->where('name', 'like', "%$searchTrx%")
                                  )
                        )
                        ->when($filterStat, fn($query) =>
                            $query->where('status', $filterStat)
                        )
                        ->with('user')
                        ->latest()
                        ->paginate(10);

        return view('index', compact('users', 'transaksis'));
    }

    // Update user
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('users')->ignore($id),
            ],
            'role' => 'required|in:admin,user',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email', 'role']));

        return redirect()->route('admin.dashboard')->with('success', 'User berhasil diperbarui.');
    }

    // Hapus user
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->transactions()->exists()) {
            return redirect()->route('admin.dashboard')->with('error', 'User memiliki transaksi yang terkait dan tidak dapat dihapus.');
        }

        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User berhasil dihapus.');
    }

    // Tambah transaksi
    public function createTransaction()
    {
        $users = User::all();
        $mejas = Meja::all();
        return view('admin.create-transaction', compact('users', 'mejas'));
    }

    public function storeTransaction(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'meja_id' => 'required|exists:mejas,id',
            'harga' => 'required|numeric|min:0',
            'jumlah_jam' => 'required|integer|min:1',
            'asal' => 'required|string|max:255',
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        Transaction::create($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function editTransaction($id)
    {
        $transaction = Transaction::with('user')->findOrFail($id);
        return view('admin.edit-transaction', compact('transaction'));
    }

    public function updateTransaction(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
            'harga' => 'required|numeric|min:0',
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->only(['status', 'harga']));

        return redirect()->route('admin.dashboard')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function deleteTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Transaksi berhasil dihapus.');
    }

    // Export ke Excel
    public function exportUsers()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function exportTransactions()
    {
        return Excel::download(new TransactionsExport, 'transactions.xlsx');
    }

    // Daftar meja
    public function daftarTransaksi()
{
    $transaksis = Transaction::with(['user', 'meja'])
        ->latest()
        ->paginate(10); // atau get() kalau tidak pakai pagination

    return view('admin.transaksi.index', compact('transaksis'));
}


    public function createMeja()
    {
        return view('admin.meja.create');
    }

    public function storeMeja(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        Meja::create($request->all());

        return redirect()->route('admin.meja.index')->with('success', 'Meja berhasil ditambahkan.');
    }

    public function editMeja($id)
    {
        $meja = Meja::findOrFail($id);
        return view('admin.meja.edit', compact('meja'));
    }

    public function updateMeja(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        $meja = Meja::findOrFail($id);
        $meja->update($request->all());

        return redirect()->route('admin.meja.index')->with('success', 'Meja berhasil diperbarui.');
    }

    public function deleteMeja($id)
    {
        $meja = Meja::findOrFail($id);
        $meja->delete();

        return redirect()->route('admin.meja.index')->with('success', 'Meja berhasil dihapus.');
    }
}
