@extends('frontend.layouts.app')

@section('title')
    {{ 'User dashboard' }}
@endsection

@section('content')

  <div class="col-12">
    <!-- Main Content -->
    <main class="row">

      <!-- user dashboard -->
      <div class="col-12">
        <div class="row">
          <div class="col-12 py-3">
            <!-- user dashboard information -->
            <div class="row">
              <!-- leftbar -->
              <div class="col-lg-3 col-md-4 my-3 p-0">
                <div class="card">
                  <img src="https://image.freepik.com/free-photo/image-human-brain_99433-298.jpg" class="card-img-top img-fluid" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</h5>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="{{ url('/user/edit') }}" class="btn btn-outline-dark">Edit profile</a></li>
                    <li class="list-group-item"><a href="{{ url('/user/change-password') }}" class="btn btn-outline-dark">Change password</a></li>
                  </ul>
                </div>
              </div> <!-- end of leftbar -->
              <!-- rightbar -->
              <div class="col-lg-9 col-md-8 my-3">

                @yield('userDashboardContent')
                
              </div> <!-- end of rightbar -->
            </div> <!-- end of user dashboard information -->
          </div>
        </div>
      </div>
      <!-- user dashboard -->

    </main>
    <!-- Main Content -->
  </div> 

@endsection
