<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');
        $this->tasks = $tasks;
    }
    
     public function index(Request $request)
    {
        $tasks = $request->user()->tasks()->get(); 
        return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        
        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');

    }
    
     /**
   * Уничтожение заданной задачи.
   *
   * @param  Request  $request
   * @param  Task  $task
   */
    public function destroy(Request $request, Task $task)
    {
      $this->authorize('destroy', $task);

      $task->delete();

      return redirect('/tasks');
    }
    
}
