<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\assignReviewer; // Replace 'AssignReviewer' with your actual model class

class DeletePastDueAssignReviewer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete-past-due:assignments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete assignments where the due date is in the past.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currentDate = Carbon::today();
        
        AssignReviewer::whereDate('due', '<', $currentDate)->delete();
        
        $this->info('Past due assignments have been deleted.');
    }
}
