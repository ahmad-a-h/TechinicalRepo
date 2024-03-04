<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('path/to/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <!-- <title>Document</title> -->
</head>
<body>
    
    <nav>
    <ul>
        <li>
            <a href="{{ route('Tasks')}}">Tasks</a>
        </li>
        <li>
            <a href="{{ route('CreateTask')}}">Create Tasks</a>
        </li>
        <li>
            <a href="{{ route('CategorizedTasks')}}">Categorized Tasks</a>
        </li>
    </ul>
    </nav>
    @yield('content')
</body>
</html> 