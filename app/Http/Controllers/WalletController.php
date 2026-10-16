<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * Récupérer tous les wallets.
     */
    public function index()
    {
        $wallets = Wallet::all();

        return response()->json([
            'success' => true,
            'data' => $wallets
        ], 200);
    }

    /**
     * Créer un wallet.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'currency' => 'nullable|string|size:3',
        ]);

        $wallet = Wallet::create([
            'user_id' => $validated['user_id'],
            'balance' => 0,
            'currency' => $validated['currency'] ?? 'CDF',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Wallet créé avec succès',
            'data' => $wallet
        ], 201);
    }


    public function show(string $id)
    {
        $wallet = Wallet::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $wallet
        ], 200);
    }
    public function update(Request $request, string $id)
    {
        $wallet = Wallet::findOrFail($id);

        $validated = $request->validate([
            'balance' => 'nullable|numeric',
            'currency' => 'nullable|string|size:3',
        ]);

        if (isset($validated['balance'])) {
            $wallet->balance = $validated['balance'];
        }

        if (isset($validated['currency'])) {
            $wallet->currency = $validated['currency'];
        }

        $wallet->save();

        return response()->json([
            'success' => true,
            'message' => 'Wallet mis à jour avec succès',
            'data' => $wallet
        ], 200);
    }
}
