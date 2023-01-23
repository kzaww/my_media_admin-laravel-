<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('admin/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/bootstrap/css/bootstrap.min.css') }}">
    {{-- box icon cdn --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar_header">

        </div>

        <nav class="sidebar_body">
            <ul class="nav_link list-unstyled">
                <li class="link_item {{ (request()->is('profile'))? 'active' : ''; }}" onclick="this.childNodes[1].click()">
                    <a href="{{ route('admin#dashboard') }}">
                        <span>Profile</span>
                    </a>
                </li>
                {{-- <li class="link_item">
                    <a href="javascript:{}">
                        <span>Admin List</span>
                    </a>
                </li> --}}
                <li class="link_item {{ (request()->is('category*'))? 'active' : ''; }}" onclick="this.childNodes[1].click()">
                    <a href="{{ route('admin#categoryList') }}">
                        <span>Category</span>
                    </a>
                </li>
                <li class="link_item {{ (request()->is('post*'))? 'active' : ''; }}" onclick="this.childNodes[1].click()">
                    <a href="{{ route('admin#postList') }}">
                        <span>Post</span>
                    </a>
                </li>
                <li class="link_item {{ (request()->is('trendPost*'))? 'active' : ''; }}" onclick="this.childNodes[1].click()">
                    <a href="{{ route('admin#trendPost') }}">
                        <span>Trend Post</span>
                    </a>
                </li>
                <li class="link_item log_out" onclick="this.childNodes[1].submit()">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <a href="javascript:{}" onclick="this.parentNodes.submit()">
                            <span>Logout</span>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>

    </div>
    <div class="main_content">
        <div class="header">

        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
<script src="{{ asset('admin/bootstrap/js/bootstrap.min.js') }}"></script>

@yield('script')

</html>
