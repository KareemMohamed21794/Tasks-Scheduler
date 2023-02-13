<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Http;
use Alert;
class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arrTask = Task::all()->sortBy('id');
       // Alert::success('welcome');
        return view('tasks.index',compact('arrTask'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'name' => 'required|string|max:255',
            'task_url' => 'required',
            'task_scheduler' => 'required',
            'minute' => 'max:59|min:0'
        ]);

        $objTask = new Task();
        $objTask->name = $request->input('name');
        $objTask->task_url = $request->input('task_url');
        $objTask->task_scheduler = $request->input('task_scheduler');
        $objTask->minute = $request->input('minute')? $request->input('minute') : 0;
        $objTask->hour = $request->input('hour') ? $request->input('hour') : 0;
        $objTask->day_month = 0;
        $objTask->month = 0;
        $objTask->day_week = 0;

        $objTask->save();

        Alert::success('Task Created Successfully');
        
         return redirect()->route('tasks.index');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $objTask = Task::find($id);
        // $response = Http::get($objTask->task_url);
        // dd($response);

           
        return view('tasks.edit',compact('objTask'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'task_url' => 'required',
            'task_scheduler' => 'required',
            'minute' => 'integer|max:59|min:0'
        ]);

        $objTask =  Task::find($id);
        $objTask->name = $request->input('name');
        $objTask->task_url = $request->input('task_url');
        $objTask->task_scheduler = $request->input('task_scheduler');
        $objTask->minute = $request->input('minute');
        $objTask->hour = $request->input('hour') ? $request->input('hour') : 0;
        $objTask->day_month = 0;
        $objTask->month = 0;
        $objTask->day_week = 0;
        $objTask->save();
        Alert::success('Task  Successfully Edit');
        return redirect()->route('tasks.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        Task::find($id)->delete();
        return json_encode('success delete');
    }


    public function UpdateStatusTask(Request $request)
    {
        Task::where('id', $request->task_id)
       ->update([
           'status' => $request->status,
        ]);

        return json_encode('success');
    }
}
