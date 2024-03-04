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
    <nav class="bg-gray-50 dark:bg-gray-700">
        <div class="max-w-screen-xl px-4 py-3 mx-auto">
            <div class="flex items-center">
                <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                    
                @if(auth()->user())
                    <li>
                        <a href="{{ route('Tasks')}}" class="text-gray-900 dark:text-white hover:underline" aria-current="page">Tasks</a>
                    </li>
                    <li>
                        <a href="{{ route('CreateTask')}}" class="text-gray-900 dark:text-white hover:underline">Create a Task</a>
                    </li>
                    <li>
                        <a href="{{ route('CategorizedTasks')}}" class="text-gray-900 dark:text-white hover:underline">Categorized Tasks</a>
                    </li>
                    
                @endif
                <li>
                    <a href="{{ route('register')}}" class="text-gray-900 dark:text-white hover:underline">Register</a>
                </li>
                <li>
                    <a href="{{ route('logout')}}" class="text-gray-900 dark:text-white hover:underline">Logout</a>
                </li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
</body>
</html> 