@extends('frontend.pages.users.master')

@section('userDashboardContent')

  <!-- user dashboard main content -->
  <div class="jumbotron">
    <h1 class="display-4">Welcome to Dashboard!</h1>
    <p class="lead">This is a dashboard for user only. You can change everything your profile to here.</p>
    <hr class="my-4">
    <p>If you purchase any product, save this by your name.</p>
    <a class="btn btn-dark btn-lg" href="{{ url('/') }}" role="button">Go to Shop</a>
  </div> <!-- end of user dashboard main content -->

@endsection