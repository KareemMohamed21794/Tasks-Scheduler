<?php

namespace App\Console\Commands;
use App\Models\Task;
use App\Models\TaskHistory;
use Illuminate\Console\Command;
use Mail;
use App\Mail\TaskMail;
use Http;
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
        $response = Http::get($task->task_url);
        $data['status'] = $response->status();
        
        try {

            if($response->status() == '200'){
                /////////Add Task History/////////////
                $objTaskHistory = new TaskHistory();
                $objTaskHistory->task_id = $taskId;
                $objTaskHistory->response = $response->status();
                $objTaskHistory->body = $response->body();
                $objTaskHistory->date = date('Y-m-d H:i:s');
                $objTaskHistory->save();
                print_r('Success Status');die;
            }else{
              
                Mail::send('email.test', $data, function ($message)use($data,$task) {
                    $message->subject('Task Mail');
                    $message->to('testmailk17@gmail.com');
                });

                /////////Add Task History/////////////
                $objTaskHistory = new TaskHistory();
                $objTaskHistory->task_id = $taskId;
                $objTaskHistory->response = $response->status();
                $objTaskHistory->body = $response->body();
                $objTaskHistory->date = date('Y-m-d H:i:s');
                $objTaskHistory->save();
                print_r('Error Status');die;
            }
            
            
        } catch (Exception $e) {

            print_r('Sorry Something Error');die;
              
        }
    }

}
