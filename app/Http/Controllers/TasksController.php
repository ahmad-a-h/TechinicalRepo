<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\TaskRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Routing\Controller as BaseController;

class TasksController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected $taskInterface;
    protected $CategoriesInterface; 
    protected $auth;
    protected $userId;
    public function __construct(TaskRepositoryInterface $taskInterface, CategoryRepositoryInterface $CategoriesInterface,){
        $this->taskInterface = $taskInterface;
        $this->CategoriesInterface = $CategoriesInterface;
        $this->middleware(function ($request, $next) {
            $this->userId = auth()->user()->id;
            if($this->userId)
            return $next($request);
            else return  redirect()->route('auth.login');
        });

    }
    public function index()
    {
        $tasks = $this->taskInterface->GetTaskByUserId($this->userId);
        $categories = $this->CategoriesInterface->GetCategoriesByUserId($this->userId);
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
        // = auth()->id();
        // Create a new task object
        $task = new Task();
        $task->user_id = $this->userId;
        $task->Title = $request ->title;
        $task->Description = $request ->description;
        $task->Due_Date = $request ->date;
        $task->category_id = $request ->category_id ? $request ->category_id : 1 ;
        // dd($task);
        // Call the TaskInterface method to create a new task
        $res = $this->taskInterface->Task_Create($this->userId,$task);
        if($res){
            return redirect()->route('Tasks')->with('success','Task created successfully');
        }
    
    } 
    public function create(){
        
        $categories = $this->CategoriesInterface->GetCategoriesByUserId($this->userId);
        return view('Control.CreateTask', ['categories'=> $categories]);
    }
    public function CategorizedTasks()
    {
        
        $categories = $this->CategoriesInterface->GetCategoriesByUserId($this->userId);
        foreach ($categories as $category) {
            // Fetch tasks for the current category ID
            $tasks = $this->taskInterface->GetTasksByCategoryId($this->userId,$category->id);
            
            // Append tasks to the category object
            $category->tasks = $tasks;
        }
        return view('Control.CategorizedTasks', ['categories'=> $categories]);
    }
    public function DeleteTask($id){
        $res = $this->taskInterface->Task_Delete($this->userId,$id);
        if($res){
            return redirect()->route('Tasks');
        }
    }
    public function SortTasks()
    {
        
        $tasks = $this->taskInterface->SortTasksByDueDate($this->userId);
        $categories = $this->CategoriesInterface->GetCategoriesByUserId($this->userId);
        return view('Control.tasks', ['tasks'=> $tasks,'categories'=> $categories]);
    }

    // public function EditTask(Request $request){
    //     $taskData = json_decode($request->input('task'), true);
    //     $categories =  $taskData['categories'];
    //     // Now $taskData is an array containing all task attributes
    //     // Create a new task object using the task data
    //     $task = new Task();
    //     $task->user_id = $taskData['task']['user_id'];
    //     $task->title = $taskData['task']['title'];
    //     $task->description = $taskData['task']['description'];
    //     $task->due_date = $taskData['task']['Due_Date'];
    //     $task->category_id = $taskData['task']['category_id'];
    //     // Pass the $task object to the view
    //     return view('Control.EditTask', ['task' => $task, 'categories' => $categories,'id' =>$taskData['task']['id']]);

    // }
    public function EditTask($id){
        $task = $this->taskInterface->GetSingleTaskById($id);
        $categories = $this->CategoriesInterface->GetCategoriesByUserId($this->userId);
        
        return view('Control.EditTask', ['task' => $task, 'categories' => $categories,'id' =>$id]);

    }
    public function saveTask(Request $request,$id)
    {
        // Validate the request data
        // dd($request->input());
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'category_id' => 'required|numeric',
        ]);
        $task = new Task();
        $task->user_id = $this->userId;
        $task->title = $request ->title;
        $task->description = $request ->description;
        $task->due_date = $request ->Due_Date;
        $task->category_id = $request ->category_id;
        $task->Due_Date = $request ->date;
        $res = $this->taskInterface->Task_Update($this->userId, $task,$id);

        if($res->getStatusCode() == 200) {
            return redirect()->route('Tasks')->with('success', 'Task updated successfully');
        }

        // Handle case where task update fails
    }
    public function GoToCreateCategory(){
        return view('Control.CreateCategory');
    }

    public function CreateCategory(Request $request){
        $category = new Category();

        // Fill the category instance with data from the request
        $category->fill($request->input());
        $res = $this->CategoriesInterface->Category_Create($this->userId, $category);
        if($res){
            return redirect()->route('CategorizedTasks');
        }
    }
    public function DeleteCategory($id){
        $res = $this->CategoriesInterface->Category_Delete($this->userId,$id);
        if($res){
            return redirect()->route('CategorizedTasks');
        }
    }
}