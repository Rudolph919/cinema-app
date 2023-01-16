<?php

namespace App\Http\Controllers;

use App\Http\Requests\CinemaCompanyRequest;
use App\Models\CinemaCompany;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CinemaCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $cinemaCompany = CinemaCompany::first();

        $data = [
            'cinemaCompany' => $cinemaCompany
        ];

        return view('cinema-company.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('cinema-company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CinemaCompanyRequest $request
     * @return RedirectResponse
     */
    public function store(CinemaCompanyRequest $request)
    {
        $newCinemaCompany = new CinemaCompany();
        $newCinemaCompany->name = $request['cinema-company'];

        try {
            $db_result = DB::transaction(function () use ($newCinemaCompany) {
                $newCinemaCompany->save();
            });
        } catch (\Throwable $th) {
            Log::error($th);
            $this->banner('There was an error creating the Cinema Company. Please try again. If the problem persists please contact the system admin', 'danger');
            return back()->withInput();
        }

        $this->banner('Cinema Company has been captured successfully');
        return redirect()->route('cinema-company.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param CinemaCompany $cinemaCompany
     * @return Application|Factory|View
     */
    public function edit(CinemaCompany $cinemaCompany)
    {
        $data = [
            'cinemaCompany' => $cinemaCompany
        ];

        return view('cinema-company.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CinemaCompanyRequest $request
     * @param CinemaCompany $cinemaCompany
     * @return RedirectResponse
     */
    public function update(CinemaCompanyRequest $request, CinemaCompany $cinemaCompany)
    {
        $cinemaCompany->name = $request['cinema-company'];

        try {
            $db_result = DB::transaction(function () use ($cinemaCompany) {
                $cinemaCompany->save();
            });
        } catch (\Throwable $th) {
            Log::error($th);
            $this->banner('There was an error updating the Cinema Company. Please try again. If the problem persists please contact the system admin', 'danger');
            return back()->withInput();
        }

        $this->banner('Cinema Company has been updated successfully');
        return redirect()->route('cinema-company.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CinemaCompany $cinemaCompany
     * @return RedirectResponse
     */
    public function destroy(CinemaCompany $cinemaCompany)
    {
        $cinemaCompany->delete();
        $this->banner('Cinema Company deleted successfully!');
        return redirect()->route('cinema-company.index');
    }
}
