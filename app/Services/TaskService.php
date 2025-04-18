<?php

namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService
{
protected $taskRepository;
public function __construct(TaskRepository $taskRepository)
{
    $this->taskRepository = $taskRepository;
}
public function getAllTasks(){
    return $this->taskRepository->all();
}
public function getTaskById($id){
    return $this->taskRepository->find($id);
}
public function createTask($data){
    return $this->taskRepository->create($data);
}
public function updateTask($id,$data){
    return $this->taskRepository->update($data,$id);
}
public function deleteTask($id){
    return $this->taskRepository->delete($id);
}
}
