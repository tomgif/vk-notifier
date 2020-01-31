<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ScheduleMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send queue jobs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        return $this->call('queue:work', [
            '--queue' => 'schedules',
            '--tries' => 1,
            '--stop-when-empty' => null,
        ]);
    }
}
