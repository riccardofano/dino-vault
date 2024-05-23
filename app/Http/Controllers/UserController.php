<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    const SORTS = ['worth', 'hotness'];
    const FILTERS = ['favourite', 'trash', 'all'];

    function show(Request $request, User $user)
    {
        $dinos = $user->dinos();
        return view('user', ['user' => $user, 'dinos' => $dinos->paginate(24)]);
    }
}
