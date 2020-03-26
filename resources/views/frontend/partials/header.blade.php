<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'E-commerce')</title>

    @include('frontend.partials.styles')

    <link rel="shortcut icon" href="{{ URL::to(App\Settings::get()->first()->logo) }}" type="image/png" />

</head>
<body>
    <div class="container-fluid">

        <div class="row min-vh-100">
            <div class="col-12">
                <header class="row">
                    <!-- Top Nav -->
                    <div class="col-12 bg-dark py-2 d-md-block d-none">
                        <div class="row">
                            <div class="col-auto mr-auto">
                                <ul class="top-nav">
                                    @php
                                        $settings = App\Settings::get()->first();
                                    @endphp
                                    @if (!empty($settings))
                                        <li>
                                            <a href="tel:+88{{ $settings->phone }}"><i class="fa fa-phone-square mr-2"></i>+88{{ $settings->phone }}</a>
                                        </li>
                                        <li>
                                            <a href="mailto:{{ $settings->email }}"><i class="fa fa-envelope mr-2"></i>{{ $settings->email }}</a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="tel:+8801XXXXXXXXX"><i class="fa fa-phone-square mr-2"></i>+8801XXXXXXXXX</a>
                                        </li>
                                        <li>
                                            <a href="mailto:example@gmail.com"><i class="fa fa-envelope mr-2"></i>example@gmail.com</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="col-auto">
                                <!--Authentication links-->
                                @guest
                                    <ul class="top-nav">
                                        @if (Route::has('register'))
                                            <li>
                                                <a href="{{ route('register') }}"><i class="fas fa-user-edit mr-2"></i>Register</a>
                                            </li>
                                        @endif
                                        
                                        <li>
                                            <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt mr-2"></i>Login</a>
                                        </li>
                                    </ul>
                                @else
                                    <ul class="navbar nav top-nav">
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                <i class="fas fa-user"></i>
                                                {{ Auth::user()->first_name . " " . Auth::user()->last_name }} <span class="caret"></span>
                                            </a>
                
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" style="color: black !important;" href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>

                                                <a class="dropdown-item" style="color: black !important;" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                    <i class="fas fa-sign-in-alt mr-2"></i>{{ __('Logout') }}
                                                </a>
                
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    </ul>
                                @endguest <!--end of Authentication links-->
                            </div>
                        </div>
                    </div>
                    <!-- Top Nav -->

                    <!-- Header -->
                    <div class="col-12 bg-white pt-4">
                        <div class="row">
                            <div class="col-lg-auto">
                                <div class="site-logo text-center text-lg-left">
                                    <a href="{{ url('/') }}">
                                        @php
                                            $settings = App\Settings::get()->first();
                                        @endphp
                                        @if (!empty($settings))
                                            <img src="{{ URL::to($settings->logo) }}" style="width: 40px;" class="rounded-circle" alt="">
                                            {{ ' ' . $settings->name }}
                                        @else
                                            <i class="fas fa-home"></i> E-commerce
                                        @endif
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-5 mx-auto mt-4 mt-lg-0">
                                <form action="{{ url('/search-product') }}" method="GET">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="search" name="search" class="form-control border-dark" placeholder="Search products..." >
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-dark"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-auto text-center text-lg-left header-item-holder">
                                <a href="{{ url('/carts') }}" class="header-item">
                                    <i class="fas fa-shopping-bag mr-2"></i><span id="header-qty" class="mr-3 cart-items">{{ App\Cart::totalItems() }}
                                    </span>
                                </a>
                            </div>
                        </div>

                        @include('frontend.partials.navbar')

                    </div>
                    <!-- Header -->

                </header>
            </div>