<?php

namespace App\Http\Controllers;

use App\Models\Dino;

class DinoController extends Controller
{
    public function show($id)
    {
        $dino = Dino::with('coveters.user', 'shunners.user', 'owner')->where('id', '=', $id)->firstOrFail();
        return view('dino', ['dino' => $dino]);
    }
}
