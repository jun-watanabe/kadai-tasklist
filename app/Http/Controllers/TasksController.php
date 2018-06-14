<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Task;    // add

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];

            return view('tasks.index', $data);
        }else {
            return view('welcome');
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        
        $task = new Task;
         if (\Auth::check()) {

        return view('tasks.create', [
            'task' => $task,
        ]);}
        
        else {
            return redirect('/');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (\Auth::check()) {
        $this->validate($request, [
            'status' => 'required|max:10',   // add
            'content' => 'required|max:191',
        ]);
        $user = \Auth::user();

        $task = new Task;
        $task->status = $request->status;    // add
        $task->content = $request->content;
        $task->user_id = $user->id;        
        $task->save();
             
         }
        
            return redirect('/');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        if (\Auth::user()->id === $task->user_id) {

            
            
            return view('tasks.show', [
            'task' => $task,
        ]);
        }
        
        
        else {
             return redirect('/');
            
        }
        



    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        if (\Auth::user()->id === $task->user_id) {

        return view('tasks.edit', [
            'task' => $task,
        ]);
        }
        

             return redirect('/');
            
       
   
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
        $task = Task::find($id);
        if (\Auth::user()->id === $task->user_id) {
            
        $this->validate($request, [
            'status' => 'required|max:191',   // add
            'content' => 'required|max:191',
        ]);


        
        $task->status = $request->status;    // add
        $task->content = $request->content;
        $task->save();
        
            
        }
        
        
             return redirect('/');        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $task = Task::find($id);
        if (\Auth::user()->id === $task->user_id) {
        $task->delete();
    }
        
        
        
        return redirect('/');
    
    }
}