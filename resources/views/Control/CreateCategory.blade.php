@extends('Layout.Home')

@section('content')
    <div class="main" style="display:flex;justify-content:center;align-items:center;height:100vh;">
        <form class="w-full max-w-lg bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4" action="{{ route('CreateCategory')}}" method="post">
            @csrf
            <h2 class="text-2xl mb-6 font-bold">Create Category</h2>
            <div class="mb-6">
                <label for="CategoryName" class="block text-gray-700 text-sm font-bold mb-2">Category Name:</label>
                <input type="text" id="CategoryName" name="CategoryName" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter category name" required>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit</button>
        </form>
    </div>
@endsection
