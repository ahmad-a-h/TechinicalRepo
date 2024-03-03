<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\TaskRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class TasksController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected $taskInterface;
    protected $CategoriesInterface;
    public function __construct(TaskRepositoryInterface $taskInterface, CategoryRepositoryInterface $CategoriesInterface){
        $this->taskInterface = $taskInterface;
        $this->CategoriesInterface = $CategoriesInterface;
    }
    public function index()
    {
        // $userId = Auth::id();
        $userId = 1;
        $tasks = $this->taskInterface->GetTaskByUserId($userId);
        $categories = $this->CategoriesInterface->GetCategoriesByUserId($userId);
        return view('Control.tasks', ['tasks'=> $tasks,'categories'=> $categories]);
    }

    public function store(Request $request){
        // $validatedData = $request->validate([
        //     'title' => 'required',
        //     'description' => 'required',
        //     'duedate' => 'required|date',
        // ]);
        
        $this->validate($request,[
            'title'=> 'required',
            'description'=> 'required',
            'date'=> 'required|date',
        ]);
        $userId = 1;
        // = auth()->id();
        // Create a new task object
        $task = new Task();
        $task->user_id = $userId;
        $task->Title = $request ->title;
        $task->Description = $request ->description;
        $task->Due_Date = $request ->date;
        $task->category_id = $request ->category_id;
        // dd($task);
        // Call the TaskInterface method to create a new task
        $res = $this->taskInterface->Task_Create($userId,$task);
        if($res){
            return redirect()->route('Tasks')->with('success','Task created successfully');
        }
    
    } 
    public function create(){
        
        $categories = $this->CategoriesInterface->GetCategoriesByUserId(1);
        return view('Control.CreateTask', ['categories'=> $categories]);
    }
    public function CategorizedTasks()
    {
        
        $userId = 1;
        $categories = $this->CategoriesInterface->GetCategoriesByUserId($userId);
        foreach ($categories as $category) {
            // Fetch tasks for the current category ID
            $tasks = $this->taskInterface->GetTasksByCategoryId($userId,$category->id);
            
            // Append tasks to the category object
            $category->tasks = $tasks;
        }
        return view('Control.CategorizedTasks', ['categories'=> $categories]);
    }
    public function DeleteTask($id){
        $userId = 1;
        $res = $this->taskInterface->Task_Delete($userId,$id);
        if($res){
            return redirect()->route('Tasks');
        }
    }
    public function SortTasks()
    {
        
        $userId = 1;
        $tasks = $this->taskInterface->SortTasksByDueDate($userId);
        $categories = $this->CategoriesInterface->GetCategoriesByUserId($userId);
        return view('Control.tasks', ['tasks'=> $tasks,'categories'=> $categories]);
    }

    public function EditTask(Request $request){
        $taskData = json_decode($request->input('task'));
        // Now $taskData is an object containing all task attributes
        
        // Create a new task object using the task data
        $task = new Task();
        $task->user_id = $taskData->user_id;
        $task->title = $taskData->title;
        $task->description = $taskData->description;
        $task->due_date = $taskData->Due_Date;
        $task->category_id = $taskData->category_id;
        
        dd($task);
    }
}