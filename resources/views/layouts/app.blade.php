<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    {{-- <div id="app"> --}}
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
            {{-- <div class="container"> --}}
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/admin') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('z-logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            登出
                                        </a>

                                        <form id="logout-form" action="{{ route('z-logout') }}" method="post" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                    </ul>
                </div>
            {{-- </div> --}}
        </nav>

        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/members">會員管理</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/orders">訂單管理</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="/admin/news">退貨管理</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/order">分類管理</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/order">商品管理</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/order">庫存管理</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/order">優惠管理</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/order">客服管理</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/order">權限管理</a>
                            </li>
                        </ul>
                    </div>
                </nav>
    
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>

    {{-- </div> --}}

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
