<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class StaticPagesController extends Controller
{
    public function home(): Factory|View|Application
    {
        $feed_items = [];
        if (Auth::check()) {
            $feed_items = Auth::user()->feed()->paginate(10);
        }
        return view('static_pages.home', compact('feed_items'));
    }

    public function about(): Factory|View|Application
    {
        return view('static_pages.about');
    }

    public function help(): Factory|View|Application
    {
        return view('static_pages.help');
    }
}
