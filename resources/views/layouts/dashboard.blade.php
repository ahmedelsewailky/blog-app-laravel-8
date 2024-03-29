<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | @yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('dashboard') }}/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesone -->
    <link href="{{ asset('dashboard') }}/fonts/fontawesome/css/all.min.css" rel="stylesheet">

    <!-- Style Sheet -->
    <link href="{{ asset('dashboard') }}/css/style.css" rel="stylesheet">

    <!-- Custome style sheet for spesific page -->
    @yield('custom_css')
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-default">
        <div class="container">

            <!-- Brand -->
            <a class="navbar-brand" href="#">AdminStrap</a>

            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- LTR: left menu -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('post.index') }}">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">Users</a>
                    </li>
                </ul>

                <!-- LTR: right menu -->
                <ul class="navbar-nav">


                    <!-- Notifications menu -->
                    <li class="nav-item dropdown">
                        <!-- span counter + envelope icon -->
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            @if (count(auth()->user()->unreadNotifications) > 0)
                            <span class="notif-count">{{ count(Auth()->user()->unreadNotifications) }}</span>
                            @endif
                            <i class="fas fa-envelope"></i>
                        </a>

                        <!-- Notification menu -->
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <!-- menu head -->
                            <li class="dropdown-menu-header">
                                <span>Notifications</span>
                                <a href="{{ url('/panel/notifications') }}" @if (count(auth()->user()->unreadNotifications) == 0)  class="d-none" @endif>Mark all as read</a>
                            </li>

                            <!-- custome for un read notifications -->
                            @foreach (auth()->user()->notifications->take(5) as $notify)
                            <li>
                                <div class="d-flex dropdown-item" @if ($notify->read_at === NULL) style="background-color: #eeebeb" @endif>
                                    <div class="flex-shrink-0">
                                        <img src="@if (!File::exists(public_path($notify->data['image']))) https://shahidafridifoundation.org/wp-content/uploads/2020/06/no-preview.jpg @else {{$notify->data['image']}} @endif" alt="..." width="60" height="60">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <span class="fw-bold">{{ Str::ucfirst($notify->notifiable->name) }}</span>
                                        <span>{{ $notify->data['description'] }}</span> <br>
                                        <a
                                            href="{{ url('/panel/mark', $notify->data['id']) }}">{{ Str::limit($notify->data['title'], 35) }}</a>
                                        <p class="meta-date mb-0" style="font-size: 13px">
                                            <span
                                                class="text-danger"><em>{{ $notify->created_at->diffForHumans() }}</em></span>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            @endforeach

                            <!-- menu footer -->
                            <li class="dropdown-menu-footer">
                                <a href="{{ url('/panel/notifications') }}">Reviews all notifications</a>
                            </li>
                        </ul>
                    </li>


                    <!-- Welcome message -->
                    <li class="nav-item"><a class="nav-link" href="#">Welcome,
                            {{ Str::ucfirst(Auth::user()->name) }}</a></li>


                    <!-- Logout buttons -->
                    <li class="nav-item">
                        <a class="nav-link" class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Header -->
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard <small>Manage Your
                            Site</small></h1>
                </div>
                <div class="col-md-2">
                    <div class="dropdown create">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Create Content
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a type="button" data-toggle="modal" data-target="#addPage">Add Page</a></li>
                            <li><a href="#">Add Post</a></li>
                            <li><a href="#">Add User</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <!-- Breadcrumbs -->
    <section id="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                @yield('breadcrumbs')
            </ol>
        </div>
    </section>


    <section id="main">
        <div class="container">
            <div class="row">

                <!-- Sidebar -->
                <div class="col-md-3">

                    <div class="list-group mb-3">
                        <a href="index.html" class="list-group-item active main-color-bg">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
                        </a>
                        <a href="pages.html" class="list-group-item">
                            <span class="fas fa-edit"></span>
                            Pages <span class="badge bg-secondary float-end">0</span>
                        </a>
                        @can('post-list')
                        <a href="{{ route('post.index') }}" class="list-group-item">
                            <span class="fas fa-pencil-alt"></span>
                            Posts
                            <span class="badge bg-secondary float-end">{{ App\Models\Post::all()->count() }}</span>
                        </a>
                        @endcan


                        @can('user-list')
                        <a href="{{ route('users.index') }}" class="list-group-item">
                            <span class="fas fa-user"></span> Users <span
                                class="badge bg-secondary float-end">{{ App\Models\User::all()->count() }}</span></a>
                        @endcan


                        @can('category-list')
                        <a href="{{ route('categories.index') }}" class="list-group-item">
                            <span class="fas fa-th-large"></span> Categories <span
                                class="badge bg-secondary float-end">{{ App\Models\Category::all()->count() }}</span></a>
                        @endcan


                        @can('tag-list')
                        <a href="{{ route('tags.index') }}" class="list-group-item">
                            <span class="fas fa-tags"></span> Tags <span
                                class="badge bg-secondary float-end">{{ App\Models\Tag::all()->count() }}</span></a>
                        @endcan


                        @can('role-list')
                        <a href="{{ route('roles.index') }}" class="list-group-item">
                            <span class="fas fa-user-shield"></span> Roles <span
                                class="badge bg-secondary float-end">{{ Spatie\Permission\Models\Role::all()->count() }}</span></a>
                        @endcan


                        @can('permission-list')
                        <a href="{{ route('permissions.index') }}" class="list-group-item">
                            <span class="fas fa-exclamation-circle"></span> Permissions <span
                                class="badge bg-secondary float-end">{{ Spatie\Permission\Models\Permission::all()->count() }}</span></a>
                        @endcan


                        {{-- @can('permission-list') --}}
                        <a href="{{ url('/panel/subscribers') }}" class="list-group-item">
                            <span class="fas fa-users"></span> Subscribers <span
                                class="badge bg-secondary float-end">{{ App\Models\Subscribers::all()->count() }}</span></a>
                        {{-- @endcan --}}
                    </div>

                    <div class="card mb-3 bg-light">
                        <div class="card-body">
                            <div class="well py-3">
                                <h4>Disk Space Used</h4>
                                <div class="progress mb-3">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                                        aria-valuemax="100" style="width: 60%;">
                                        60%
                                    </div>
                                </div>
                                <h4>Bandwidth Used </h4>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0"
                                        aria-valuemax="100" style="width: 40%;">
                                        40%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="visit-web text-center">
                        <a href="{{ route('website') }}" target="_blank" class="btn btn-sm btn-primary">Visit
                            Website</a>
                    </div>
                </div>

                <!-- Index Page Content -->
                <div class="col-md-9">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>

    <footer id="footer">
        <p>{{ $setting->site_copyright }}</p>
    </footer>

    <!-- Modals -->
    @yield('modals')

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('dashboard/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/fonts/fontawesome/js/all.min.js') }}"></script>
    @yield('custom-script')
</body>

</html>
