<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> To-Do Admin | Home Page </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
  /* background-color: rgba(255, 255, 255, 0.1);  */
  background-color: grey;
  color: #fff; 
  text-decoration:none; 
}
.nav-item {
  margin-bottom: 15px;
}
.nav-item .nav-link.active {
  background-color:rgb(139, 63, 187); 
  font-weight: bold;
}
.bg-purple-light {
  box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.1);
}
  </style>
  <body>
  <div class="text-center py-3 bg-dark">
      <h3 class="text-white">To-Do Application</h3>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2 bg-purple-light p-4">
          <h3 class="text-white text-center">
            <a href="{{ route('admin.dashboard') }}" class=" text-white text-decoration-none">Admin Dashboard</a>
          </h3>
          <ul class="nav flex-column">
          <li class="nav-item mb-3">
                <a href="{{ route('admin.users') }}" class="nav-link mt-2">View Users</a>
              </li>
              <!-- <li class="nav-item mb-3">
                <a href="#" class="nav-link">View User Todo List</a>
              </li> -->
              <li class="nav-item mb-3">
                <a href="{{ route('admin.profile') }}" class="nav-link">Admin Profile</a>
              </li>
              <li class="nav-item mb-3">
                <form action="{{route('admin.logout')}}" method="post" style="display:inline-block;">
                  @csrf
                  <button type="submit" class="nav-link btn btn-link" onclick="return confirm('Are you sure you want to logout?')">Logout</button>
                </form>
              </li>
          </ul>
        </div>
        <div class="col-md-9">
          <h1 class="mt-4"> Welcome Admin, {{auth()->user()->name}}</h1>
          <div class="row mt-4">
            <div class="col-md-3 mb-2">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title"> Total Users</h5>
                  <h1 class="card-text">{{ $totalUsers}}</h1>
                </div>
              </div>
            </div>
            <div class="col-md-3 mb-2">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title"> Total Todos</h5>
                  <h1 class="card-text">{{ $totals}}</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>