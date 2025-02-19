<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class StatusesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'content' => 'required|max:1000'
        ]);
        Auth::user()->statuses()->create([
            'content'=>$request['content']
        ]);

        session()->flash('success', 'Published successfully!');
        return redirect()->back();
    }
}
