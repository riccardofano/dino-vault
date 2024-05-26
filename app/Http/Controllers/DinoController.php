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

    public function favourite(Dino $dino)
    {
        /** @var \App\Models\User */
        $user = Auth::user();

        $transaction = $user->favouritedDinos()->where('dino_id', '=', $dino->id)->pluck('dino_transaction.id');

        if ($transaction) {
            DinoTransaction::destroy($transaction);
        } else {
            $user->dinoTransactions()->create([
                'dino_id' => $dino->id,
                'type' => 'FAVOURITE'
            ]);
        }

        return redirect('/dinos/' . $dino->id);
    }
}
