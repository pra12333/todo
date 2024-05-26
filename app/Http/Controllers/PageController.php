<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        return view('index'); // Render resources/views/index.blade.php (formerly index.html)
    }

    public function login()
    {
        return view('login'); // Render resources/views/login.blade.php (formerly login.html)
    }

    public function todos()
    {
        $tasks = Task::where('user', Auth::user()->email)->get();
        return view('todos', compact('tasks')); // Render resources/views/todos.blade.php (formerly todos.html)
    }
}

