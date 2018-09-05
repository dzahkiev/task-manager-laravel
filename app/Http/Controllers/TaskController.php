<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
     public function __construct()
	{
		$this->middleware('auth');
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
		$tasks = $request->user()->tasks()->get();

		return view('task', [
			'task' => $tasks,
		]);
	}

	public function destroy(Request $request, \App\Task $task)
	{
		$task->delete();

		return redirect('/tasks');
	}
}
