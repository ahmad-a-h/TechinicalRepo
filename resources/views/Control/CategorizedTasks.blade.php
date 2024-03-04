@extends('Layout.Home')

@section('content')
    <div style="display: flex;">
    <div class="main" style="display: flex;margin: 1%;flex-direction: row;width: 75%;flex-wrap: wrap;">
        @if ($categories->count() > 0)
            @foreach($categories as $category)
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 m-1">
                    <h2 class="mb-4 text-2xl font-bold">{{ $category->CategoryName }}</h2>
                    @foreach ($category->tasks as $task)
                        <div>
                            <h3 class="mb-2 text-lg font-semibold">{{ $task->title }}</h3>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-300">Due Date: {{ $task->Due_Date ? date('Y-m-d', strtotime($task->Due_Date)) : 'Not Set' }}</p>
                            <p class="mb-2 text-sm text-gray-700 dark:text-gray-400">{{ $task->description }}</p>
                            <form action="{{ route('EditTask', ['id' => $task->id]) }}" method="get" class="inline-block">
                                <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Edit
                                    <i class="fa fa-edit ms-2"></i>
                                </button>
                            </form>
                            <form action="/CategorizedTasks/{{ $task->id }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-500 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                    Delete
                                    <i class="fa fa-trash ms-2"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @else
            <p>No tasks found.</p>
        @endif
    </div>
    <form action="{{ route('GoToCreateCategory') }}" method="get" class="mt-4">
        <div class="inline-flex items-center">
            <div class="mr-2">Add Category</div>
            <button type="submit" class="inline-flex items-center px-2 py-1 text-sm font-medium text-white bg-green-500 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </form>
    </div>
    
@endsection
