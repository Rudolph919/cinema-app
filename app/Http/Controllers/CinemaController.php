<?php

namespace App\Http\Controllers;

use App\Http\Requests\CinemaRequest;
use App\Http\Requests\StoreCinemaRequest;
use App\Http\Requests\UpdateCinemaRequest;
use App\Models\Cinema;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $cinemas = Cinema::all();

        $data = [
            'cinemas' => $cinemas
        ];

        return view('cinema.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('cinema.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CinemaRequest $request
     * @return RedirectResponse
     */
    public function store(CinemaRequest $request)
    {
        $newCinema = new Cinema();
        $newCinema->name = $request['cinema_name'];
        $newCinema->location = $request['cinema_location'];

        try {
            $db_result = DB::transaction(function () use ($newCinema) {
                $newCinema->save();
            });
        } catch (\Throwable $th) {
            Log::error($th);
            $this->banner('There was an error creating the Cinema. Please try again. If the problem persists please contact the system admin', 'danger');
            return back()->withInput();
        }

        $this->banner('Cinema has been captured successfully');
        return redirect()->route('cinema.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Cinema $cinema
     * @return \Illuminate\Http\Response
     */
    public function edit(Cinema $cinema)
    {
        $data = [
            'cinema' => $cinema
        ];

        return view('cinema.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CinemaRequest $request
     * @param Cinema $cinema
     * @return RedirectResponse
     */
    public function update(CinemaRequest $request, Cinema $cinema)
    {
        $cinema->name = $request['cinema_name'];
        $cinema->location = $request['cinema_location'];

        try {
            $db_result = DB::transaction(function () use ($cinema) {
                $cinema->save();
            });
        } catch (\Throwable $th) {
            Log::error($th);
            $this->banner('There was an error updating the Cinema details. Please try again. If the problem persists please contact the system admin', 'danger');
            return back()->withInput();
        }

        $this->banner('Cinema details has been updated successfully');
        return redirect()->route('cinema.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Cinema $cinema
     * @return RedirectResponse
     */
    public function destroy(Cinema $cinema)
    {
        $cinema->delete();
        $this->banner('Cinema deleted successfully!');
        return redirect()->route('cinema.index');
    }
}
