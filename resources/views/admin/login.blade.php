<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
      .form-section {
        background-color: #f8f9fa; 
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      }
    </style>
  </head>
  <body>
    <div class="text-center py-3 bg-dark">
      <h3 class="text-white">To-Do Application</h3>
    </div>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-4 form-section">
        @if (Session::has('success'))
            <div class="col-md-12 mt-4 text-center"> 
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            </div>
            @endif
          <h2 class="text-center mb-4">Admin Login</h2>
          <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label" style="font-weight:bold">Email</label>
              <input type="email" class="form-control" id="email" name="email" autocomplete="off" value="{{old('email')}}">
              @error('email')
              <div class="text-danger">{{$message}}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="password" class="form-label" style="font-weight:bold">Password</label>
              <input type="password" class="form-control" id="password" name="password"  autocomplete="off">
              @error('password')
              <div class="text-danger">{{$message}}</div>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
          </form>
          <p class="mt-3 text-center">Don't have an account? <a href="{{route('admin.register')}}">Register here</a></p>
        </div>
      </div>
    </div>
  </body>
</html>
