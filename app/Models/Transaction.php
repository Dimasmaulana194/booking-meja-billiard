<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    
    protected $fillable = [
        'user_id',
        'meja_id',
        'harga',        // tambahkan juga ini kalau kamu pakai
        'jumlah_jam',   // dan ini juga
        'asal',
        'order_id',
        'total_harga',  // <== tambahkan ini
    ];

    protected $casts = [
        'harga' => 'float',
        'total_harga' => 'float', // perhatikan penggunaan total_harga
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Meja
    public function meja()
    {
        return $this->belongsTo(Meja::class, 'meja_id');
    }

    // Hitung total harga (fallback)
    public function hitungTotalHarga(): float
    {
        return ($this->harga ?? 0) * ($this->jumlah_jam ?? 0);
    }

    // Format harga
    public function formatHarga(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    // Validasi sebelum menyimpan
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($transaction) {
            if ($transaction->harga < 0) {
                throw new \Exception("Harga tidak boleh negatif.");
            }
        });
    }

    /**
     * Ekspor semua data transaksi ke file CSV
     * Bisa dipanggil dari controller
     */
    public static function exportToCsv()
    {
        $transactions = self::all();
        $filename = storage_path('app/transactions.csv');
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['ID', 'User ID', 'Meja ID', 'Harga', 'Jumlah Jam', 'Total', 'Asal', 'Created At', 'Updated At']);

        foreach ($transactions as $transaction) {
            fputcsv($handle, [
                $transaction->id,
                $transaction->user_id,
                $transaction->meja_id,
                $transaction->harga,
                $transaction->jumlah_jam,
                $transaction->total_harga,
                $transaction->asal,
                $transaction->created_at,
                $transaction->updated_at,
            ]);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
