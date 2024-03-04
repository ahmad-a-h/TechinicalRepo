@extends('Layout.Home')

@section('content')
    <div style=" display: flex; ">
    <div class="main" style="display: flex;margin: 5%;flex-direction: row;width: 75%;flex-wrap: wrap;">
        @if ($tasks->count() > 0)
            @foreach ($tasks as $task)
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 m-1">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $task->title }}</h5>
                    </a>
                    <p class="mb-3 text-sm text-gray-500 dark:text-gray-300">Due Date: {{ $task->Due_Date ? date('Y-m-d', strtotime($task->Due_Date)) : 'Not Set' }}</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $task->description }}</p>
                    <form action="/Tasks/{{ $task->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            Delete
                            <i class="fa fa-trash ms-2"></i>
                        </button>
                    </form>
                </div>
            @endforeach
            
        @else
            <p>No tasks found.</p>
        @endif
    </div>
    <form action="/SortTasks" method="GET">
        @csrf
        <button type="submit" class="inline-flex items-center px-3 py-2 mt-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Sort Tasks
            <i class="fa fa-filter ms-2"></i>
        </button>
    </form>
    </div>
@endsection
