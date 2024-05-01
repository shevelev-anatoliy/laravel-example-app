<?php

namespace App\Http\Controllers;

use App\Models\Slide;

class HomeController extends Controller
{
    public function index() {
        return view('home.index')->with([
            'slides' => Slide::query()->get(),
        ]);
    }
}
