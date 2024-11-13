<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $tasks = Task::whereUserId(auth()->user()->id)
            ->when(isset($request->status), function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->when(isset($request->priority), function ($q) use ($request) {
                $q->where('priority', $request->priority);
            })
            ->when(isset($request->term), function ($q) use ($request) {
                $q->where('title', 'like', "%$request->term%");
            })
            ->get();

        return view('home', compact('tasks'));
    }
}
