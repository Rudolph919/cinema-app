<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTheatreRequest;
use App\Http\Requests\TheatreRequest;
use App\Http\Requests\UpdateTheatreRequest;
use App\Models\Cinema;
use App\Models\Theatre;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TheatreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $theatres = Theatre::all();

        $data = [
            'theatres' => $theatres
        ];

        return view('theatre.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $cinemas = Cinema::all();

        $data = [
            'cinemas' => $cinemas
        ];

        return view('theatre.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TheatreRequest $request
     * @return RedirectResponse
     */
    public function store(TheatreRequest $request)
    {
        $newTheatre = new Theatre();
        $newTheatre->cinema_id = $request['theatre_cinema'];
        $newTheatre->name = $request['theatre_name'];

        try {
            $db_result = DB::transaction(function () use ($newTheatre) {
                $newTheatre->save();
            });
        } catch (\Throwable $th) {
            Log::error($th);
            $this->banner('There was an error creating the Theatre. Please try again. If the problem persists please contact the system admin', 'danger');
            return back()->withInput();
        }

        $this->banner('Theatre has been captured successfully');
        return redirect()->route('theatre.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Theatre  $theatre
     * @return \Illuminate\Http\Response
     */
    public function edit(Theatre $theatre)
    {
        $cinemas = Cinema::all();

        $data = [
            'theatre' => $theatre,
            'cinemas' => $cinemas
        ];

        return view('theatre.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TheatreRequest $request
     * @param Theatre $theatre
     * @return RedirectResponse
     */
    public function update(TheatreRequest $request, Theatre $theatre)
    {
        $theatre->cinema_id = $request['theatre_cinema'];
        $theatre->name = $request['theatre_name'];

        try {
            $db_result = DB::transaction(function () use ($theatre) {
                $theatre->save();
            });
        } catch (\Throwable $th) {
            Log::error($th);
            $this->banner('There was an error updating the Theatre details. Please try again. If the problem persists please contact the system admin', 'danger');
            return back()->withInput();
        }

        $this->banner('Theatre details has been updated successfully');
        return redirect()->route('theatre.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Theatre  $theatre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Theatre $theatre)
    {
        $theatre->delete();
        $this->banner('Theatre deleted successfully!');
        return redirect()->route('theatre.index');
    }
}
