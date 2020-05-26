<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Episode;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $episodes = Episode::orderBy('episode_number', 'DESC')->get();
        return view('home')
            ->with('episodes', $episodes);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dash()
    {
        return view('dashboard');
    }
}
