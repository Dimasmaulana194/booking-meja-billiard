<?php

namespace App\Http\Controllers;

use Midtrans\Config;
use Midtrans\Notification;
use Illuminate\Http\Request;
use App\Models\Meja;
use App\Models\Transaction;
use Midtrans\Snap;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function show($id, $harga, $asal)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $meja = Meja::find($id);
        if (!$meja) abort(404);

        try {
            $transactionData = [
                'transaction_details' => [
                    'order_id' => 'ORDER-' . now()->format('YmdHis'),
                    'gross_amount' => $harga * 1,
                ],
            ];

            $snapToken = Snap::getSnapToken($transactionData);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error generating payment link: ' . $e->getMessage(),
            ]);
        }

        return view('pembayaran', [
            'meja' => $meja,
            'snapToken' => $snapToken,
        ]);
    }

    public function sukses()
    {
        return view('sukses');
    }

    public function simpanPembayaran(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $validated = $request->validate([
            'meja_id'    => 'required|exists:mejas,id',
            'harga'      => 'required|numeric',
            'asal'       => 'required|string|in:vip,regular',
            'jumlah_jam' => 'required|integer|min:1',
        ]);

        $total_harga = $validated['harga'] * $validated['jumlah_jam'];
        $orderId = 'ORDER-' . now()->format('YmdHis');

        while (Transaction::where('order_id', $orderId)->exists()) {
            $orderId = 'ORDER-' . now()->addSeconds(1)->format('YmdHis');
        }

        $transaksi = Transaction::create([
            'user_id'     => auth()->id(),
            'meja_id'     => $validated['meja_id'],
            'asal'        => $validated['asal'],
            'order_id'    => $orderId,
            'total_harga' => $total_harga,
            'status'      => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil disimpan',
            'data' => $transaksi,
        ]);
    }

    public function handleNotification(Request $request)
    {
        $notification = new Notification();

        $order_id = $notification->order_id;
        $transaction_status = $notification->transaction_status;
        $fraud_status = $notification->fraud_status;

        $transaction = Transaction::where('order_id', $order_id)->first();

        if ($transaction) {
            switch ($transaction_status) {
                case 'capture':
                    if ($fraud_status == 'challenge') {
                        $transaction->status = 'challenge';
                    } else {
                        $transaction->status = 'capture'; // sukses
                    }
                    break;
                case 'settlement':
                    $transaction->status = 'settlement'; // sukses
                    break;
                case 'pending':
                    $transaction->status = 'pending';
                    break;
                case 'deny':
                    $transaction->status = 'denied';
                    break;
                case 'cancel':
                    $transaction->status = 'cancelled';
                    break;
                case 'expire':
                    $transaction->status = 'expired';
                    break;
                case 'failure':
                    $transaction->status = 'failure';
                    break;
                default:
                    $transaction->status = 'unknown';
                    break;
            }

            $transaction->save();
        }

        return response()->json(['status' => 'success']);
    }
}
