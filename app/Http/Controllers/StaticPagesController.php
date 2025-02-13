<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class StaticPagesController extends Controller
{
    public function home(): Factory|View|Application
    {
        return view('static_pages.home');
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
