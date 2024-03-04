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
    public function GetSingleTaskById(int $TaskId)
    {
        // Retrieve tasks associated with the specified user
        return Task::find($TaskId);
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

    public function Task_Update(int $userId, Task $task,$id)
    {
        try {
            // Attempt to find the task by ID
            $existingTask = Task::findOrFail($id);
            
            // Fill the existing task with data from the provided task
            $existingTask->fill($task->toArray());
    
            // Optionally, update other properties of the task
            // $existingTask->user_id = $userId;
    
            // Save the updated task record to the database
            $existingTask->save();
    
            // Return a success response
            return response()->json(['message' => 'Task updated successfully']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Task with the given ID not found
            return response()->json(['error' => 'Task not found'], 404);
        } catch (\Exception $e) {
            // Handle other potential exceptions
            return response()->json(['error' => 'An error occurred while updating the task'], 500);
        }
    }

    public function Task_Delete(int $userId, int $taskId)
    {
        // Delete the task associated with the specified user and ID
        return Task::where('user_id', $userId)
                    ->where('id', $taskId)
                    ->delete();
    }
}
