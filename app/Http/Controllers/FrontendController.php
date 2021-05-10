<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('front.index')->with('series',Series::all());
    }
}
