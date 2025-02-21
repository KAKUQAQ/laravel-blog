<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class FollowersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(User $user): RedirectResponse
    {
        $this->authorize('follow', $user);

        if(!Auth::user()->isFollowing($user->id)) {
            Auth::user()->follow($user->id);
        }
        return redirect()->route('users.show', $user->id);
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('follow', $user);
        if (Auth::user()->isFollowing($user->id)) {
            Auth::user()->unfollow($user->id);
        }
        return redirect()->route('users.show', $user->id);
    }
}
