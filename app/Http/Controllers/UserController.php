<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    function show(User $user, string $kind)
    {
        $dinos = UserController::getDinoKind(strtolower($kind), $user);

        return view('user', [
            'kind' => $kind,
            'user' => $user,
            'dinos' => $dinos->paginate(24)
        ]);
    }

    static function getDinoKind(string $kind, User $user)
    {
        switch ($kind) {
            case 'all':
                return $user->dinos();
            case 'favourite':
            case 'favorite':
                return $user->favouriteOwnedDinos();
            case 'trash':
                return $user->trashOwnedDinos();
            case 'favourited':
            case 'favorited':
                return $user->favouritedDinos();
            case 'shunned':
            case 'disliked':
                return $user->shunnedDinos();
            case 'coveted':
            case 'liked':
                return $user->covetedDinos();
            default:
                return abort(404);
        }
    }
}
