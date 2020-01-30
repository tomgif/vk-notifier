<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleStoreRequest;
use App\Schedule;
use Illuminate\Support\Facades\Auth;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $schedules = Schedule::orderBy('when', 'asc')->paginate(5);

        return view('admin.schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ScheduleStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ScheduleStoreRequest $request)
    {
        $schedule = new Schedule;
        $schedule->name = $request->name;
        $schedule->message = $request->message;
        $schedule->when = $request->when;
        $schedule->user_id = Auth::user()->id;
        $schedule->save();

        return redirect()->route('admin.schedules.index')
                ->with('success', __('schedules.create.success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Schedule $schedule
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Schedule $schedule)
    {
        return view('admin.schedules.edit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ScheduleStoreRequest $request
     * @param \App\Schedule $schedule
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ScheduleStoreRequest $request, Schedule $schedule)
    {
        $schedule->name = $request->name;
        $schedule->message = $request->message;
        $schedule->when = $request->when;

        if ($schedule->isDirty()) {
            $schedule->save();
        }

        return redirect()->route('admin.schedules.index')
            ->with('info', __('schedules.edit.info'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Schedule $schedule
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('admin.schedules.index')
            ->with('info', __('schedules.destroy.info'));
    }
}
