<?php
namespace App\Repositories;

use App\Models\Task;
use Illuminate\Support\Collection;

class TaskRepository implements TaskRepositoryInterface
{
    public function GetTaskByUserId(int $userId): Collection
    {
        // Retrieve tasks associated with the specified user
        return Task::where('user_id', $userId)->get();
    }

    public function GetTasksByCategoryId(int $userId, int $categoryId): Collection
    {
        // Retrieve tasks associated with the specified user and category
        return Task::where('user_id', $userId)
                    ->where('category_id', $categoryId)
                    ->get();
    }

    public function SortTasksByDueDate(int $userId, int $categoryId): Collection
    {
        // Sort tasks by due date for the specified user and category
        return Task::where('user_id', $userId)
                    ->where('category_id', $categoryId)
                    ->orderBy('due_date')
                    ->get();
    }

    public function Task_Create(int $userId, Task $task): bool
    {
        // Create a new task associated with the specified user
        $task->user_id = $userId;
        return $task->save();
    }

    public function Task_Update(int $userId, Task $task): bool
    {
        // Update the task associated with the specified user
        return $task->update(['user_id' => $userId]);
    }

    public function Task_Delete(int $userId, int $taskId): bool
    {
        // Delete the task associated with the specified user and ID
        return Task::where('user_id', $userId)
                    ->where('id', $taskId)
                    ->delete();
    }
}
