<?php

namespace App\Http\Controllers;

use App\Models\Dino;
use App\Models\DinoTransaction;
use Illuminate\Support\Facades\Auth;

class DinoController extends Controller
{
    public function show($id)
    {
        $dino = Dino::with('coveters.user', 'shunners.user', 'owner')->where('id', '=', $id)->firstOrFail();
        return view('dino', ['dino' => $dino]);
    }

    public function covet(int $dino)
    {
        DinoController::replaceCovetOrShun($dino, 'COVET');
        return redirect('/dinos/' . $dino);
    }

    public function shun(int $dino)
    {
        DinoController::replaceCovetOrShun($dino, 'SHUN');
        return redirect('/dinos/' . $dino);
    }

    public function favourite(int $dino)
    {
        /** @var \App\Models\User */
        $user = Auth::user();

        $transaction = $user->favouritedDinos()
            ->where('dino_id', '=', $dino)
            ->pluck('dino_transaction.id');

        if (!$transaction->isEmpty()) {
            DinoTransaction::destroy($transaction);
        } else {
            $user->dinoTransactions()->create([
                'dino_id' => $dino,
                'type' => 'FAVOURITE'
            ]);
        }

        return redirect('/dinos/' . $dino);
    }

    static private function replaceCovetOrShun(int $dino, string $transactionType)
    {
        /** @var \App\Models\User */
        $user = Auth::user();

        $transaction = $user->dinoTransactions()
            ->where('dino_id', '=', $dino)
            ->where(function ($query) {
                $query
                    ->where('type', '=', 'COVET')
                    ->orWhere('type', '=', 'SHUN');
            })
            ->select('id', 'type')
            ->first();

        if ($transaction) {
            if ($transaction->type === $transactionType) {
                return;
            }

            DinoTransaction::destroy($transaction->id);
        }

        $user->dinoTransactions()->create([
            'dino_id' => $dino,
            'type' => $transactionType
        ]);
    }
}
