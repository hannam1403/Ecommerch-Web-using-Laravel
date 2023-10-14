@extends('layouts.app')

@section('content')
<form method="POST" action="/change-password/{{ Session::get('my_user_id')}}" enctype="multipart/form-data">
  @csrf
  @method('PUT')
    <div class="container d-flex flex-column">
      <div class="row align-items-center justify-content-center
          min-vh-100">
        <div class="col-12 col-md-8 col-lg-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <div class="mb-4">
                <center><h5>Change your password</h5></center>
                <p class="mb-2">Enter your old password and the new password to change
                </p>
              </div>
              <form>
                <div class="mb-3">
                  <label for="current_password" class="form-label">Old Password</label>
                  <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autocomplete="current-password">
                    @error('current_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <br>
                    <label for="new_password" class="form-label">New Password</label>
                  <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required autocomplete="new-password">
                  @error('new_password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                    <br>
                    <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                  <input id="new_password_confirmation" type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" required autocomplete="new-password">
                  @error('new_password_confirmation')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="mb-3 d-grid">
                  <button type="submit" class="btn btn-primary">
                    Change Your Password
                  </button>
                </div>
                {{-- <span>Don't have an account? <a href="sign-in.html">sign in</a></span> --}}
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</form>
    @endsection