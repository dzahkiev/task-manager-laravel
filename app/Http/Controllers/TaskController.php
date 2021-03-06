<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    public function __construct(TaskRepository $tasks)
	{
		$this->middleware('auth');
		$this->tasks = $tasks;
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

	public function index(Request $request)
	{
		return view('task', [
			'task' => $this->tasks->forUser($request->user()),
		]);
	}

	public function destroy(Request $request, Task $task)
	{
		$this->authorize('destroy', $task);
		$task->delete();

		return redirect('/tasks');
	}
}
