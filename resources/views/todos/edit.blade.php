<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>To-Do | Edit To-Do Page</title>
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
  /* background-color: rgba(255, 255, 255, 0.1);  */
  background-color: grey;
  color: #fff; 
  text-decoration:none; 
}
.nav-item {
  margin-bottom: 15px;
}
.nav-item .nav-link.active {
  background-color: #d1b0e6; 
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
      <h3 class="text-white text-center"><a href="{{ route('applicant.dashboard') }}" class="text-white text-decoration-none">Dashboard</a></h3>
        <ul class="nav flex-column">
          <li class="nav-item mb-3">
            <a href="{{ route('applicant.todos.create') }}" class="nav-link mt-2">Create New To-Do</a>
          </li>
          <li class="nav-item mb-3">
            <a href="{{ route('applicant.todos.index') }}" class="nav-link">View All To-Dos</a>
          </li>
          <li class="nav-item mb-3">
            <a href="{{ route('applicant.profile') }}" class="nav-link">View Profile</a>
          </li>
          <!-- <li class="nav-item mb-3">
            <a href="{{ route('applicant.logout') }}" class="nav-link">Logout</a>
          </li> -->
          <li class="nav-item mb-3">
          <form action="{{ route('applicant.logout') }}" method="POST" style="display:inline-block;">
            @csrf
            <button type="submit" class="nav-link btn btn-link">Logout</button>
          </form>
        </li>
  </ul>
</div>
    <div class="col-md-9">
        <h1 class="mt-4">Edit To-Do</h1>

        <form action="{{ route('applicant.todos.update', $todo) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label mt-2"style="font-weight:bold">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $todo->title }}">
                @error('title')
                  <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label"style="font-weight:bold">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ $todo->description }}</textarea>
            </div>
            @error('description')
            <div class="text-danger">{{$message}}</div>
            @enderror
            <button type="submit" class="btn btn-success"style="display: inline-block; line-height: 22px;text-align:center; font-weight: bold" >Update</button>
            <a href="{{ route('applicant.todos.index') }}" class="btn btn-secondary"style="display: inline-block; line-height: 22px;text-align:center; font-weight: bold" >Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
