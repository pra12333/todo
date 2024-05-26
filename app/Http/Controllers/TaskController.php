<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        if (empty($request->input('task'))) {
            return redirect('/todos')->with('error', 'Task field is empty');
        }else{
            $task = new Task();
            $task->user = Auth::user()->email;
            $task->task = $request->input('task');
            $task->status = 'pending'; // Default to pending
    
            $task->save();
    
            return redirect('/todos')->with('success', 'Task added successfully');
        }
    }

    public function update(Request $request, $id)
    {

        $task = Task::findOrFail($id);

        $task->status = $request->has('status') ? 'completed' : 'pending';
        $task->save();

        return redirect('/todos');
    }

    public function destroy($id)
    {
        // Find and delete the task
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect('/todos')->with('success', 'Task deleted successfully');
    }
}
