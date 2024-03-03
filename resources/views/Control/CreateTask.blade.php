@extends('Layout.Home')

@section('content')
    <div class='main' style="display:flex;width:50%;align-items:center;flex-direction: column;margin-left:25%">
    <h2>Create Task</h2>
    <form action="{{ route('CreateTask')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <input type="description" id="description" name="description">
        </div>
        <div class="form-group">
            <label for="date">Due Date:</label>
            <input type="date" id="date" name="date">
        </div>
        <div>
            <label for="category_id">Select Category</label>
        <select name="category_id" id="category_id">
            <option value=""></option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->CategoryName }}</option>
            @endforeach
        </select>
        </div>
        <button type="submit" class="submit-button">Submit</button>
    </form>
    </div>
@endsection