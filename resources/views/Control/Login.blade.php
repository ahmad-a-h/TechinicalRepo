@extends('Layout.Home')

@section('content')
    <div class='main' style="display:flex;width:50%;align-items:center;flex-direction: column;margin-left:25%">
    <h2>Tasks</h2>
    <form action="{{ route('getTasks')}}" method = "post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
        </div>
        <button type="submit" class="login-button">Login</button>
    </form>
    </div>
@endsection