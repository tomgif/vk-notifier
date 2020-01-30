<?php

namespace App\Observers;

use App\Jobs\ProcessSchedule;
use App\Schedule;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Carbon;

class ScheduleObserver
{
    use DispatchesJobs;

    public function pushJob(Schedule $schedule)
    {
        $job = new ProcessSchedule($schedule);
        $job->onQueue('schedules')
            ->delay(Carbon::parse($schedule->when));
        return $this->dispatch($job);
    }

    /**
     * Handle the schedule "created" event.
     *
     * @param \App\Schedule $schedule
     * @return void
     */
    public function creating(Schedule $schedule)
    {
        $schedule->job_id = $this->pushJob($schedule);
    }

    /**
     * Handle the schedule "updated" event.
     *
     * @param \App\Schedule $schedule
     * @return void
     */
    public function updating(Schedule $schedule)
    {
        $schedule->job()->delete();
        $this->creating($schedule);
    }

    /**
     * Handle the schedule "deleted" event.
     *
     * @param \App\Schedule $schedule
     * @return void
     */
    public function deleting(Schedule $schedule)
    {
        $schedule->job()->delete();
    }
}
