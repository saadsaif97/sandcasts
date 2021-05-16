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

    public function singleSeries(Series $series)
    {
        return view('front.series.index')->with('series',$series);
    }

    public function watchSeries(Series $series)
    {
        return view('front.series.watch')->with('series',$series);
    }
}
