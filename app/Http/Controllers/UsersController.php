<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use mysql_xdevapi\Exception;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show','create','store']]);
        $this->middleware('guest', ['only' => ['create']]);
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function create(): Factory|View|Application
    {
        return view('users.create');
    }

    public function show(User $user): Factory|View|Application
    {
        return view('users.show', compact('user'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        session()->flash('success', 'Signup was successful! Welcome!');
        return redirect()->route('users.show', $user);
    }

    public function edit(User $user): Factory|View|Application
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $this->authorize('update', $user);
        $this->validate($request, [
            'name' => 'required|unique:users|max:255',
            'password' => 'nullable|min:6|confirmed'
        ]);
        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        session()->flash('success', 'Information update successful!');
        return redirect()->route('users.show', $user);
    }
}
