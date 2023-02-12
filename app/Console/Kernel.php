<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Task;
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        
        # get all data from tasks
        $arrTasks = Task::where('status','1')->orderBy('id')->get();
       
        foreach ($arrTasks as $key => $Task) {
            $scheduler_command = $schedule->command('scheduler_command',[$Task->id]);
            if($Task->task_scheduler == 'everyMinute'){
                $scheduler_command->everyMinute();
            }elseif($Task->task_scheduler == 'everyFiveMinutes'){
                $scheduler_command->everyFiveMinutes();
            }elseif($Task->task_scheduler == 'everyTenMinutes'){
                $scheduler_command->everyTenMinutes();
            }elseif($Task->task_scheduler == 'everyFifteenMinutes'){
                $scheduler_command->everyFifteenMinutes();
            }elseif($Task->task_scheduler == 'everyThirtyMinutes'){
                $scheduler_command->everyThirtyMinutes();
            }elseif($Task->task_scheduler == 'hourly'){
                $scheduler_command->hourly();
            }elseif($Task->task_scheduler == 'hourlyAt'){
                $scheduler_command->hourlyAt($Task->minute);
            }elseif($Task->task_scheduler == 'daily'){
                $scheduler_command->daily();
            }elseif($Task->task_scheduler == 'dailyAt'){
                 $scheduler_command->dailyAt($Task->hour);
            }
           
        }
        
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
