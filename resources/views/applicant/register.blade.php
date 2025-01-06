<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Registration</title>
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
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-4 form-section">
                <h2 class="my-2 mb-4 text-center" >User Registration</h2>
                <form action="{{ route('applicant.register') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label" style="font-weight:bold">Name</label>
                        <input type="text" class="form-control" id="name" name="name" autocomplete="off" value="{{old('name')}}">
                        @error('name')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label" style="font-weight:bold">Email</label>
                        <input type="email" class="form-control" id="email" name="email"autocomplete="off" value="{{old('email')}}">
                        @error('email')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label" style="font-weight:bold">Username</label>
                        <input type="text" class="form-control" id="text" name="username"autocomplete="off" value="{{old('username')}}">
                        @error('username')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label" style="font-weight:bold">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @error('password')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                      <label for="password_confirmation" class="form-label" style="font-weight:bold">Confirm Password</label>
                       <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                      </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
                <p class="mt-3 text-center">Already have an account? <a href="{{route('applicant.login')}}">Login here</a></p>
            </div>
        </div>
    </div>
  </body>
</html>
