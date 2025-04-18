<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;
class TaskController
{
protected $taskService;
public function __construct(TaskService $taskService)
{
    $this->taskService = $taskService;
}
public function index(){
    return response()->json($this->taskService->getAllTasks());
}
public function store(Request $request){
    $validated=$request->validate([
        'user_id' => 'required|exists:users,id',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',

    ]);
    $task= $this->taskService->createTask($validated);
    return response()->json(['message'=>'Task Created Successfully',$task],201);
}
public function show($id){
    return response()->json($this->taskService->getTaskById($id));
}
public function update(Request $request,$id){
    $validated=$request->validate([
        'title' => 'sometimes|required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'sometimes|required|string',
    ]);
    $task = $this->taskService->updateTask($id,$validated);
    return response()->json($task,200);
}
    public function destroy($id)
    {
        $this->taskService->deleteTask($id);

        return response()->json(['message' => 'Task deleted successfully']);
    }
}
