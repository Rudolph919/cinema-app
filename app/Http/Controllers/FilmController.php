<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmRequest;
use App\Http\Requests\StoreFilmRequest;
use App\Http\Requests\UpdateFilmRequest;
use App\Models\Film;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::all();

        $data = [
            'films' => $films
        ];

        return view('film.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('film.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FilmRequest $request
     * @return Response
     */
    public function store(FilmRequest $request)
    {
        $newFilm = new Film();
        $newFilm->name = $request['film_name'];

        try {
            $db_result = DB::transaction(function () use ($newFilm) {
                $newFilm->save();
            });
        } catch (\Throwable $th) {
            Log::error($th);
            $this->banner('There was an error creating the Film. Please try again. If the problem persists please contact the system admin', 'danger');
            return back()->withInput();
        }

        $this->banner('Film has been captured successfully');
        return redirect()->route('film.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param Film $film
     * @return Application|Factory|View
     */
    public function edit(Film $film)
    {
        $data = [
            'film' => $film
        ];

        return view('film.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FilmRequest $request
     * @param Film $film
     * @return Response
     */
    public function update(FilmRequest $request, Film $film)
    {
        $film->name = $request['film_name'];

        try {
            $db_result = DB::transaction(function () use ($film) {
                $film->save();
            });
        } catch (\Throwable $th) {
            Log::error($th);
            $this->banner('There was an error updating the Film details. Please try again. If the problem persists please contact the system admin', 'danger');
            return back()->withInput();
        }

        $this->banner('Film details has been updated successfully');
        return redirect()->route('film.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Film $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        $film->delete();
        $this->banner('Film deleted successfully!');
        return redirect()->route('film.index');
    }
}
