<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title', 'E-commerce - Admin')</title>

    @include('admin.partials.styles')

    <link rel="shortcut icon" href="{{ URL::to(App\Settings::get()->first()->logo) }}" type="image/png" />
    

</head>

<body>

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('admin.partials.sitebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('admin.partials.topbar')