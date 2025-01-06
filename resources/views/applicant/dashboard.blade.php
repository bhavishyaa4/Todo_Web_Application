<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>To-Do | Home Page</title>
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
            <button type="submit" class="nav-link btn btn-link" onclick="return confirm('Are you sure you want to logout?')">Logout</button>
          </form>
        </li>
  </ul>
</div>
        <div class="col-md-9">
          <h1 class="mt-4">Welcome, {{ auth()->user()->name }}</h1>
          <!-- <p class="lead">Your To-Do Dashboard</p> -->

          <div class="row mt-4">
            <div class="col-md-4 mb-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title ">Total To-Dos</h5>
                  <h1 class="card-text">{{ $todos->count() }}</h1>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Completed</h5>
                  <h1 class="card-text">{{ $todos->where('is_completed', true)->count() }}<h1>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Pending</h5>
                  <h1 class="card-text">{{ $todos->where('is_completed', false)->count() }}</h1>
                </div>
              </div>
            </div>
          </div>

          <h2>Your To-Dos</h2>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($todos as $todo)
              <tr>
                <td>{{ $todo->title }}</td>
                <td>{{ $todo->description }}</td>
                <td>
                  @if($todo->is_completed)
                    <span class="badge bg-success" style="display: inline-block; line-height: 22px;text-align: center;">Completed</span>
                  @else
                    <span class="badge bg-warning" style="display: inline-block; line-height: 22px;text-align: center;">Pending</span>
                  @endif
                </td>
                <td>
                  @if(!$todo->is_completed)
                    <form action="{{ route('applicant.todos.complete', $todo) }}" method="post" style="display:inline-block;">
                      @csrf
                      @method('PATCH')
                      <button type="submit" class="btn btn-sm btn-success"style="font-weight: bold" >Mark as Complete</button>
                    </form>
                    <a href="{{ route('applicant.todos.edit', $todo) }}" style="font-weight: bold" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('applicant.todos.destroy', $todo) }}" method="post" style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" style="font-weight: bold" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                  @else
                  <form action="{{ route('applicant.todos.removeCompleted', $todo) }}" method="post" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" style="font-weight: bold" onclick="return confirm('Are you sure you want to remove this completed task?')">Remove</button>
                  </form>
                    <span class="badge bg-success" style="display: inline-block; line-height: 22px;text-align: center;">Completed</span>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
  </body>
</html>
