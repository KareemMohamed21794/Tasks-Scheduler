<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\TaskHistory;
use Illuminate\Http\Request;

class TaskHistoriesController extends Controller
{
    public function TaskHistory($task_id)
    {
       $arrTaskHistory = TaskHistory::where('task_id',$task_id)->orderBy('id')->get();

       return view('task_history.index',compact('arrTaskHistory'));
    }
}
