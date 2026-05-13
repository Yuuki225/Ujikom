<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    // GET ALL TRANSACTIONS
    public function index(Request $request)
    {
        $transactions = Transaction::where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'message' => 'Data transactions',
            'data' => $transactions
        ]);
    }

    // CREATE TRANSACTION
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'amount' => 'required|numeric',
            'type' => 'required|in:income,expense',
            'transaction_date' => 'required|date'
        ]);

        $transaction = Transaction::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'amount' => $request->amount,
            'type' => $request->type,
            'description' => $request->description,
            'transaction_date' => $request->transaction_date
        ]);

        return response()->json([
            'message' => 'Transaction berhasil ditambahkan',
            'data' => $transaction
        ], 201);
    }

    // GET SINGLE TRANSACTION
    public function show(Request $request, $id)
    {
        $transaction = Transaction::where('user_id', $request->user()->id)
            ->find($id);

        if (!$transaction) {
            return response()->json([
                'message' => 'Transaction tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'data' => $transaction
        ]);
    }

    // UPDATE TRANSACTION
    public function update(Request $request, $id)
    {
        $transaction = Transaction::where('user_id', $request->user()->id)
            ->find($id);

        if (!$transaction) {
            return response()->json([
                'message' => 'Transaction tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'title' => 'required',
            'amount' => 'required|numeric',
            'type' => 'required|in:income,expense',
            'transaction_date' => 'required|date'
        ]);

        $transaction->update([
            'title' => $request->title,
            'amount' => $request->amount,
            'type' => $request->type,
            'description' => $request->description,
            'transaction_date' => $request->transaction_date
        ]);

        return response()->json([
            'message' => 'Transaction berhasil diupdate',
            'data' => $transaction
        ]);
    }

    // DELETE TRANSACTION
    public function destroy(Request $request, $id)
    {
        $transaction = Transaction::where('user_id', $request->user()->id)
            ->find($id);

        if (!$transaction) {
            return response()->json([
                'message' => 'Transaction tidak ditemukan'
            ], 404);
        }

        $transaction->delete();

        return response()->json([
            'message' => 'Transaction berhasil dihapus'
        ]);
    }
}