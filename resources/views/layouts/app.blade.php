<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Todo List App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        .todo-item {
            transition: all 0.3s ease;
        }

        .completed {
            text-decoration: line-through;
            opacity: 0.7;
        }

        .nav-link.active {
            font-weight: bold;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireStyles
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{-- title --}}
                <h1 class="mb-4">UMP
                    <small class="text-muted
                        fw-light"> - Programmer Test</small>
                </h1>
                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('identitas') ? 'active' : '' }}"
                            href="{{ route('identitas') }}">Identitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('algoritma') ? 'active' : '' }}"
                            href="{{ route('algoritma') }}">Algoritma</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('enkripsi') ? 'active' : '' }}"
                            href="{{ route('enkripsi') }}">Enkripsi/Dekripsi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('todos.jquery') ? 'active' : '' }}"
                            href="{{ route('todos.jquery') }}">Todo (jQuery)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('todos.livewire') ? 'active' : '' }}"
                            href="{{ route('todos.livewire') }}">Todo (Livewire)</a>
                    </li>
                </ul>
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireScripts
    @stack('scripts')
</body>

</html>
