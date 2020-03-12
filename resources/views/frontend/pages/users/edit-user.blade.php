@extends('frontend.pages.users.master')

@section('title')
	{{ 'Edit profile' }}
@endsection

@section('userDashboardContent')

  <!-- user dashboard main content -->
  <div class="row">
	    <div class="col-12">
	    	<div class="card">
                <div class="card-header text-muted">Update profile</div>
                <div class="card-body">
			        <form method="POST" action="{{ url('/user/update') }}">
			            @csrf

			            <div class="form-group row">
			                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First name') }}</label>
			                <div class="col-md-6">
				                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->first_name }}" required autocomplete="first_name" autofocus>

				                @error('first_name')
				                    <span class="invalid-feedback" role="alert">
				                        <strong>{{ $message }}</strong>
				                    </span>
				                @enderror
			                </div>
			            </div>

			            <div class="form-group row">
			                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last name') }}</label>
			                <div class="col-md-6">
			                	<input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->last_name }}" required autocomplete="last_name" autofocus>

				                @error('last_name')
				                    <span class="invalid-feedback" role="alert">
				                        <strong>{{ $message }}</strong>
				                    </span>
				                @enderror
			                </div>
			            </div>

			            <div class="form-group row">
			                <label for="email" class="col-md-4 col-form-label text-md-right"> {{__('E-Mail Address') }}</label>
			                <div class="col-md-6">
			                	<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

				                @error('email')
				                    <span class="invalid-feedback" role="alert">
				                        <strong>{{ $message }}</strong>
				                    </span>
				                @enderror
			                </div>
			            </div>

			            <div class="form-group row">
			                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone number') }}</label>
			                <div class="col-md-6">
			                	<input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" required autocomplete="phone">

				                @error('phone')
				                    <span class="invalid-feedback" role="alert">
				                        <strong>{{ $message }}</strong>
				                    </span>
				                @enderror
			                </div>
			            </div>

			            <div class="form-group row">
			                <label for="division_id" class="col-md-4 col-form-label text-md-right">{{ __('Division') }}</label>
			                <div class="col-md-6">
			                	<select id="division_id" class="form-control @error('division_id') is-invalid @enderror division_id" name="division_id">
				                    @foreach($divisions as $division)
				                        <option value="{{ $division->id }}" @if($user->division_id==$division->id) {{ 'selected' }} @endif>{{ $division->name }}</option>
				                    @endforeach
				                </select>

				                @error('division_id')
				                    <span class="invalid-feedback" role="alert">
				                        <strong>{{ $message }}</strong>
				                    </span>
				                @enderror
			                </div>
			            </div>

			            <div class="form-group row">
			                <label for="district_id" class="col-md-4 col-form-label text-md-right">{{ __('District') }}</label>
			                <div class="col-md-6">
			                	 <span class="districtByDivision">
				                    <select id="temporary_select" class="form-control @error('district_id') is-invalid @enderror" name="district_id">
				                        @foreach (App\District::where('division_id', $user->division_id)->orderBy('name', 'asc')->get() as $district)
				                        	<option value="{{ $district->id }}" @if($user->district_id==$district->id) {{ 'selected' }} @endif>{{ $district->name }}</option>
				                        @endforeach
				                    </select>
				                    @error('district_id')
				                        <span class="invalid-feedback" role="alert">
				                            <strong>{{ $message }}</strong>
				                        </span>
				                    @enderror
				                </span>
			                </div>
			            </div>

			            <div class="form-group row">
			                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Street adrress') }}</label>
			                <div class="col-md-6">
			                	<input id="street_address" type="text" class="form-control @error('street_address') is-invalid @enderror" name="street_address" value="{{ $user->street_address }}" required autocomplete="street_address" autofocus>
				                @error('street_address')
				                    <span class="invalid-feedback" role="alert">
				                        <strong>{{ $message }}</strong>
				                    </span>
				                @enderror
			                </div>
			            </div>

			            <div class="form-group row mb-0">
			            	<div class="col-md-6 offset-md-4">
			                	<button type="submit" class="btn btn-outline-dark">Update</button>
			                </div>
			            </div>
			        </form>
			    </div>
			</div>
	    </div>
	</div>
  <!-- end of user dashboard main content -->

@endsection