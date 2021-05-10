<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSeriesRequest;
use App\Http\Requests\UpdateSeriesRequest;
use App\Models\Series;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SeriesContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.series.all')->with("series",Series::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.series.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSeriesRequest $request)
    {
        return $request->storeImageAndCreateSeries();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Series $series)
    {
        return view('admin.series.index')->with('series',$series);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Series $series)
    {
        return view('admin.series.edit')->with('series',$series);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSeriesRequest $request, Series $series)
    {

        if ($request->hasFile('image')) {
            Storage::delete($series->image_url);

            $series->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'image_url' => $request->storeSeriesImage(),
                'description' => $request->description,
            ]);
        }else{
            $series->update($request->validated());
        }


        session()->flash('success','Series updated successfully');

        return redirect(route('series.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Series $series)
    {
        $series->delete();

        session()->flash('success','Series Deleted Successfully');

        return back();
    }
}
