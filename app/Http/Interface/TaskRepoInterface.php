<?php
namespace App\Interfaces;
use App\Models\Task;
use Illuminate\Support\Collection;

interface TaskRepositoryInterface
{
    public function GetTaskByUserId(int $Userid);
    public function GetTasksByCategoryId(int $Userid,int $CategoryId);
    public function SortTasksByDueDate(int $Userid);
    public function Task_Create(int $UserId,Task $task);
    public function Task_Update(int $UserId,Task $task);
    public function Task_Delete(int $UserId,int $taskId);
    // Add other method definitions as needed...
}