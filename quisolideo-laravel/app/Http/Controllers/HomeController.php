<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;

class HomeController extends Controller
{
    public function index()
    {
        // Show 3 featured trainings (latest)
        $featured = Training::orderBy('created_at', 'desc')->limit(3)->get();
        return view('home', compact('featured'));
    }
}
