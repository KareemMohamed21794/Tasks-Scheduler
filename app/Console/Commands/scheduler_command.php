<?php

namespace App\Console\Commands;
use App\Models\Task;
use App\Models\TaskHistory;
use Illuminate\Console\Command;
use Mail;
use App\Mail\TaskMail;
class scheduler_command extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scheduler_command {task_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $taskId = $this->argument('task_id');
        $task = Task::find($taskId);
        $data['task'] = $task;
        try {
           // Mail::to("testmailk17@gmail.com")->send(new TaskMail($taskId));
            Mail::send('email.test', $data, function ($message)use($data,$task) {
                $message->subject('Task Mail');
                // $message->from('testmailk17@gmail.com', 'Compert Me');
                $message->to('testmailk17@gmail.com');
            });
            /////////Add Task History/////////////
            $objTaskHistory = new TaskHistory();
            $objTaskHistory->task_id = $taskId;
            $objTaskHistory->response = '200';
            $objTaskHistory->date = date('Y-m-d H:i:s');
            $objTaskHistory->save();
            print_r('Great Check Your Mail');die;
        } catch (Exception $e) {
            /////////Add Task History/////////////
            $objTaskHistory = new TaskHistory();
            $objTaskHistory->task_id = $taskId;
            $objTaskHistory->response = '500';
            $objTaskHistory->date = date('Y-m-d H:i:s');
            $objTaskHistory->save();
            print_r('Sorry Something Error');die;
              
        }
    }

}
