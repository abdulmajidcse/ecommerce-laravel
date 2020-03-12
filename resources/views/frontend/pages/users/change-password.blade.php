@extends('frontend.pages.users.master')

@section('title')
	{{ 'Change password' }}
@endsection

@section('userDashboardContent')

  <!-- user dashboard main content -->
  <div class="row">
	    <div class="col-12">
	    	<div class="card">
                <div class="card-header text-muted">Change password</div>
                <div class="card-body">
			        <form method="POST" action="{{ url('/user/change-password-store') }}">
			            @csrf

			            <div class="form-group row">
                            <label for="old_password" class="col-md-4 col-form-label text-md-right">{{ __('Old password') }}</label>
                            <div class="col-md-6">
                            	<input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" required>
	                            @error('old_password')
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
	                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('New password') }}</label>
                            <div class="col-md-6">
                            	<input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required>
	                            @error('new_password')
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
	                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="confirm_password" class="col-md-4 col-form-label text-md-right">{{ __('Confirm password') }}</label>
                            <div class="col-md-6">
                            	<input id="confirm_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="confirm_password" required>
                            	@error('confirm_password')
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
	                            @enderror
                            </div>
                        </div>

			            <div class="form-group row mb-0">
			            	<div class="col-md-6 offset-md-4">
			                	<button type="submit" class="btn btn-outline-dark">Change</button>
			                </div>
			            </div>
			        </form>
			    </div>
			</div>
	    </div>
	</div>
  <!-- end of user dashboard main content -->

@endsection