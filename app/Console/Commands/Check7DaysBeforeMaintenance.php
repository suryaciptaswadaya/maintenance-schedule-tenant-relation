<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Check7DaysBeforeMaintenance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maintenance-schedule:7days-before';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check maintenance schedule 7 days before';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
