<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Series;
use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('front.index')->with('series',Series::all());
    }

    public function singleSeries(Series $series)
    {
        $user = auth()->user();

        if ($user->hasStartedSeries($series)) {
            return redirect(route('series.watch', ['series' => $series, 'lesson' => $user->getNextLessonToWatch($series)]));
        }

        return redirect(route('series.watch', ['series' => $series, 'lesson' => $series->lessons->first()]));
    }

    public function watchSeries(Series $series, Lesson $lesson)
    {
        return view('front.series.watch')
                ->with('series',$series)
                ->with('lesson',$lesson);
    }

    public function completeLesson(Lesson $lesson)
    {
        auth()->user()->completeLesson($lesson);
        return response()->json([
            'status' => 'ok'
        ]);
    }

    public function profile(User $user)
    {
        return view('front.series.profile')
                ->with('user', $user)
                ->with('series', $user->getStartedSeries());
    }
}
