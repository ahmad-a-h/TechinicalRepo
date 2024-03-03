
@extends('Layout.Home')

@section('content')
    <div class='main' style="display:flex;justify-content: space-between;margin: 10%;">
    @if ($tasks->count() > 0)
    <div>
    @foreach ($tasks as $task)
        <div style="display:flex;width:50%;align-items:center;flex-direction: column;">
            <div >
                <div style="display:flex;align-items: center;">
                    <h3>{{ $task->title }}</h3>
                    <input type="date" id="date" name="date" value="{{ $task->Due_Date ? date('Y-m-d', strtotime($task->Due_Date)) : '' }}" 
                    disabled="true" style="height:fit-content;margin-left:3%">
                </div>
                <label for="category_id">Category </label>
                <select name="category_id" id="category_id">
                    @if($task->category_id)
                        <option value="{{ $task->category_id }}">{{ $task->category->CategoryName }}</option>
                    @endif
                    @foreach($categories as $category)
                        @if($task->category_id != $category->id)
                            <option value="{{ $category->id }}">{{ $category->CategoryName }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            
            <div>{{ $task->description }}</div>
            <i class="fa fa-edit"></i>

            <form action="/Tasks/{{$task->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">
                    <i class="fa fa-trash"></i>
                </button>
            </form>
        </div>    

    @endforeach
    </div>
    <form action="/SortTasks" method="GET">
        @csrf
        <button type="submit">
            <i class="fa fa-filter" style="font-size:24px"></i>
        </button>
    </form>
    
    @else
    <p>No tasks found.</p>
    @endif
@endsection