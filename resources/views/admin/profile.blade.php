<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>To-Do Admin | Profile Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  </head>
  <style>
    .bg-purple-light {
        background-color: #000000; 
        min-height: 100vh; 
        padding-top: 10px; 
    }
    .bg-purple-light h3 {
        color: white;
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 20px;
    }
    .nav-link {
        color: white;
        font-size: 16px;
        font-weight: 500;
        text-decoration: none;
        padding: 10px 7px;
        border-radius: 4px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .nav-link:hover {
        background-color: grey;
        color: #fff; 
        text-decoration: none;
    }
    .nav-item {
        margin-bottom: 15px;
    }
    .nav-item .nav-link.active {
        background-color:rgb(139, 63, 187); 
        font-weight: bold;
    }
    .sidebar {
        min-height: 100vh;
        box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.1);
    }
  </style>
  <body>
    <div class="text-center py-3 bg-dark">
      <h3 class="text-white">To-Do Application</h3>
    </div>

    <div class="container-fluid">
      <div class="row">

        <div class="col-md-2 bg-purple-light p-4 sidebar">
          <h3 class="text-white text-center">
            <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none">Admin Dashboard</a>
          </h3>
          <ul class="nav flex-column">
            <li class="nav-item mb-3">
              <a href="{{ route('admin.users') }}" class="nav-link mt-2">View Users</a>
            </li>
            <li class="nav-item mb-3">
              <a href="{{ route('admin.profile') }}" class="nav-link active">Admin Profile</a>
            </li>
            <li class="nav-item mb-3">
              <form action="{{ route('admin.logout') }}" method="POST" style="display:inline-block;">
                @csrf
                <button type="submit" class="nav-link btn btn-link" onclick="return confirm('Are you sure you want to logout?')">Logout</button>
              </form>
            </li>
          </ul>
        </div>

        <div class="col-md-9 d-flex justify-content-center align-items-center vh-90">
          <div class="col-md-6 bg-light p-5 rounded shadow">
            <h1 class="text-center mb-3">Admin Profile</h1>

            @if(session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('admin.profile.update') }}" method="post">
              @csrf
              <div class="mb-3">
                <label for="name" class="form-label" style="font-weight:bold">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', auth()->guard('admin')->user()->name) }}">
                @error('name')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="email" class="form-label" style="font-weight:bold">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', auth()->guard('admin')->user()->email) }}">
                @error('email')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="username" class="form-label" style="font-weight:bold">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username', auth()->guard('admin')->user()->username) }}">
                @error('username')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="password" class="form-label" style="font-weight:bold">Password</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>

              <div class="mb-3">
                <label for="password_confirmation" class="form-label" style="font-weight:bold">Confirm New Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
              </div>

              <button type="submit" class="btn btn-primary w-100">Update Profile</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
  </body>
</html>
