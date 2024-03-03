<?php
namespace App\Http\Repos;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Support\Collection;


class TaskRepository implements TaskRepositoryInterface
{
    public function GetTaskByUserId(int $Userid)
    {
        // Retrieve tasks associated with the specified user
        return Task::where('user_id', $Userid)->get();
    }

    public function GetTasksByCategoryId(int $userId, int $categoryId)
    {
        // Retrieve tasks associated with the specified user and category
        return Task::where('user_id', $userId)
                    ->where('category_id', $categoryId)
                    ->get();
    }

    public function SortTasksByDueDate(int $userId)
    {
        // Sort tasks by due date for the specified user and category
        return Task::where('user_id', $userId)
                    ->orderBy('due_date')
                    ->get();
    }

    public function Task_Create(int $userId, Task $task)
    {
        // Create a new task associated with the specified user
        $task->user_id = $userId;
        return $task->save();
    }

    public function Task_Update(int $userId, Task $task)
    {
        // Update the task associated with the specified user
        return $task->update(['user_id' => $userId]);
    }

    public function Task_Delete(int $userId, int $taskId)
    {
        // Delete the task associated with the specified user and ID
        return Task::where('user_id', $userId)
                    ->where('id', $taskId)
                    ->delete();
    }
}
