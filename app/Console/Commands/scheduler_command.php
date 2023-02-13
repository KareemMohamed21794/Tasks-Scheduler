<?php

namespace App\Console\Commands;
use App\Models\Task;
use App\Models\TaskHistory;
use Exception;
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
     * @return void
     */
    public function handle(): void
    {
        $taskId = $this->argument('task_id');
        $task = Task::find($taskId);
        $data['task'] = $task;
        $response = Http::get($task->task_url);
        $data['status'] = $response->status();

        try {

            if($response->status() != '200'){
                Mail::send('email.test', $data, function ($message)use($data,$task) {
                    $message->subject('Task Mail');
                    $message->to('testmailk17@gmail.com');
                });
            }

            TaskHistory::create([
                'task_id' => $taskId,
                'response' => $response->status(),
                'body' => $response->body(),
                'date' => date('Y-m-d H:i:s')
            ]);

        } catch (Exception $e) {

            print_r('Sorry Something Error');die;

        }
    }

}
