<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowTimeRequest;
use App\Models\ShowTime;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ShowTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $showTimes = ShowTime::all();

        $data = [
            'show_times' => $showTimes
        ];

        return view('show-time.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('show-time.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ShowTimeRequest $request
     * @return RedirectResponse
     */
    public function store(ShowTimeRequest $request)
    {
        $newShowTime = new ShowTime();
        $newShowTime->show_time_text = $request['show_time_text'];
        $newShowTime->show_time_value = $request['show_time_value'];

        try {
            $db_result = DB::transaction(function () use ($newShowTime) {
                $newShowTime->save();
            });
        } catch (Throwable $th) {
            Log::error($th);
            $this->banner('There was an error creating the Show Time. Please try again. If the problem persists please contact the system admin', 'danger');
            return back()->withInput();
        }

        $this->banner('Show Time has been captured successfully');
        return redirect()->route('show-time.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param ShowTime $showTime
     * @return Application|Factory|View
     */
    public function edit(ShowTime $showTime)
    {
        $data = [
            'show_time' => $showTime
        ];

        return view('show-time.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ShowTimeRequest $request
     * @param ShowTime $showTime
     * @return RedirectResponse
     */
    public function update(ShowTimeRequest $request, ShowTime $showTime)
    {
        $showTime->show_time_text = $request['show_time_text'];
        $showTime->show_time_value = $request['show_time_value'];

        try {
            $db_result = DB::transaction(function () use ($showTime) {
                $showTime->save();
            });
        } catch (Throwable $th) {
            Log::error($th);
            $this->banner('There was an error updating the Show Time details. Please try again. If the problem persists please contact the system admin', 'danger');
            return back()->withInput();
        }

        $this->banner('Show Time details has been updated successfully');
        return redirect()->route('show-time.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ShowTime $showTime
     * @return RedirectResponse
     */
    public function destroy(ShowTime $showTime)
    {
        $showTime->delete();
        $this->banner('Show Time deleted successfully!');
        return redirect()->route('show-time.index');
    }
}
