<?php
namespace App\Repositories;

interface TaskRepositoryInterface
{
    public function GetTaskByUserId(int $Userid):Collection;
    public function GetTasksByCategoryId(int $Userid,int $CategoryId):Collection;
    public function SortTasksByDueDate(int $Userid,int $CategoryId):Collection;
    public function Task_Create(int $UserId,Task $task):bool;
    public function Task_Update(int $UserId,Task $task):bool;
    public function Task_Delete(int $UserId,int $taskId):bool;
    // Add other method definitions as needed...
}