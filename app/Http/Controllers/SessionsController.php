<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',['only'=>['create']]);
    }

    public function create(): Factory|View|Application
    {
        return view('sessions.create');
    }
    public function store(Request $request): Redirector|RedirectResponse
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !$user->is_active) {
            return redirect()->back()->with('error', 'Your account has not activated yet.');
        }

        if (!Auth::attempt($credentials, $request->has('remember'))) {
            session()->flash('danger', 'Invalid credentials');
            return redirect()->back()->withInput();
        }
        session()->flash('success', 'Welcome back!');
        $fallback = route('users.show', Auth::user());
        return redirect()->intended($fallback);
    }
    public function destroy(): Redirector|RedirectResponse
    {
        Auth::logout();
        session()->flash('success', 'You have been logged out');
        return redirect('login');
    }
}
