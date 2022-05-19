<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task; 

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function index()
    {
        // $tasks = [];
        // if (\Auth::check()) {
            
        //     $user = \Auth::user();
        //     // ユーザの投稿の一覧を作成日時の降順で取得
        //     // （後のChapterで他ユーザの投稿も取得するように変更しますが、現時点ではこのユーザの投稿のみ取得します）
        //     $tasks = $user->tasklist()->orderBy('created_at', 'desc')->paginate(10);
        // }
        // // Welcomeビューでそれらを表示
        // return view('tasks.index', ["tasks" => $tasks]);
        
        $tasks = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks = $user->tasklist()->orderBy('created_at', 'desc')->paginate(10);
            return view('tasks.index', ["tasks" => $tasks]);
        }else{
            $tasks = \Auth::user();
            return view('welcome' , ["tasks => $tasks"]);
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
        
        return view('tasks.create' , [
            'task' => $task
            ]);
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
            'status' => 'required|max:10',
            'content' => 'required|max:255',
        ]);
        
        $task = new Task;
        $task->status = $request->status;
        $task->content = $request->content;
        $task->user_id = $request->user_id;
        $task->save();
        
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
        $task = Task::findOrFail($id);
        
        if(\Auth::id() == $task->user_id){
            
            return view('tasks.show', [
                'task' => $task,
            ]);
            
        }else{
            return redirect()->back();
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
        $task = Task::findOrFail($id);
        
        if(\Auth::id() == $task->user_id){
            return view('tasks.edit', [
                'task' => $task,
            ]);
        }else{
            return redirect()->back();
        }
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
            'status' => 'required|max:10',
            'content' => 'required|max:255',
        ]);
        
        $task = Task::findOrFail($id);
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();
        
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
        $task = Task::findOrFail($id);
        
        if(\Auth::id() == $task->user_id){
            $task->delete();
            return redirect('/');
        }else{
            return redirect()->back();
        }
        
    }
}
