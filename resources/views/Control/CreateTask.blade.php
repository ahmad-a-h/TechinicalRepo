@extends('Layout.Home')

@section('content')
    <div class="main" style="display:flex;justify-content:center;align-items:center;height:100vh;">
        <form class="w-full max-w-lg bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4" action="{{ route('CreateTask')}}" method="post">
            @csrf
            <h2 class="text-2xl mb-6 font-bold">Create Task</h2>
            <div class="mb-6">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                <input type="text" id="title" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter title" required>
            </div>
            <div class="mb-6">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                <input type="text" id="description" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter description" required>
            </div>
            <div class="mb-6">
                <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Due Date:</label>
                <input type="date" id="date" name="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-6">
                <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Select Category:</label>
                <select name="category_id" id="category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value=""></option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->CategoryName }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit</button>
        </form>
    </div>
@endsection
