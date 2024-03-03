
@extends('Layout.Home')

@section('content')
    <div class='main' style="display:flex;width:50%;align-items:center;flex-direction: row;margin-left:25%">

    @if ($categories->count() > 0)
    @foreach($categories as $category)

    <div style="margin:5%">
    <h2 style="display:flex">{{$category->CategoryName}}</h2>
    @foreach ($category->tasks as $task)
        <div>
            <div >
                <div style="">
                    <div style="display:flex;align-items: center;">
                        <h3>{{ $task->title }}</h3>
                        <form action="{{ route('EditTask') }}" method="POST">
                            @csrf
                            <input type="hidden" name="task" value="{{ json_encode($task) }}">
                            <button type="submit">
                            <i class="fa fa-edit"></i>
                            </button>
                        </form>
                        <form action="/CategorizedTasks/{{$task->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </div>
                    <input type="date" id="date" name="date" value="{{ $task->Due_Date ? date('Y-m-d', strtotime($task->Due_Date)) : '' }}" 
                    disabled="true" style="height:fit-content;margin-left:3%">
                </div>
            </div>
            
            <div>{{ $task->description }}</div>
        </div>    

    @endforeach    
    </div>
    @endforeach
    @else
    <p>No tasks found.</p>
@endif
@endsection