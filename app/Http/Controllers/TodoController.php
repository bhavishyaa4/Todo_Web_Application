<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Applicant;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TodoController extends Controller
{
    use AuthorizesRequests;
    // public function index(){
    //     $todos = auth()->guard('applicant')->user()->todos;
    //     return view ('todos.index', compact('todos'));
    // }
    public function index(){
        $applicant = auth()->guard('applicant')->user();
        
        // Check if the applicant is authenticated
        if (!$applicant) {
            return redirect()->route('applicant.login');
        }
    
        $todos = $applicant->todos;
    
        return view('todos.index', compact('todos'));
    }
    

    public function create(){
        return view ('todos.create');
    }

    // public function store(Request $req){
    //     $req->validate([
    //         'title' => 'required|string',
    //         'description' => 'required|string',
    //     ]);

    //     auth()->user()->todos()->create([
    //         'title' => $req->title,
    //         'description' => $req->description,
    //     ]);
        
    //     return redirect()->route('applicant.todos.index')->with('success', 'To-Do created successfully');
    // }
    public function store(Request $req){
        $req->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);
    
        $applicant = auth()->guard('applicant')->user();
    
        if (!$applicant) {
            return redirect()->route('applicant.login')->withErrors(['error' => 'You must be logged in to create a to-do.']);
        }
    
        $applicant->todos()->create([
            'title' => $req->title,
            'description' => $req->description,
        ]);
        
        return redirect()->route('applicant.todos.index')->with('success', 'To-Do created successfully');
    }

    public function edit(Todo $todo){
        $this->authorize('update', $todo);
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $req, Todo $todo){
        $this->authorize('update', $todo);
        $req->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $todo->update([
            'title' => $req->title,
            'description' => $req->description,
        ]);

        return redirect()->route('applicant.todos.index')->with('success', 'To-Do updated successfully.');
    }

    public function destroy(Todo $todo){
        $this->authorize('delete', $todo);
        $todo->delete();
        return redirect()->route('applicant.todos.index')->with('success', 'To-Do deleted successfully');
    }

    public function complete(Todo $todo)
{
    $this->authorize('update', $todo); // Ensure only the user who owns the to-do can mark it complete

    $todo->update(['is_completed' => true]); // Update the 'is_completed' field

    return redirect()->route('applicant.todos.index')->with('success', 'To-Do marked as completed.');
}

public function removeCompleted(Todo $todo)
    {
        $this->authorize('delete', $todo);

        if ($todo->is_completed) {
            $todo->delete();
            return redirect()->route('applicant.todos.index')->with('success', 'Completed to-do removed successfully.');
        }

        return redirect()->route('applicant.todos.index')->withErrors(['error' => 'Only completed tasks can be removed.']);
    }
public function show()
        {
            return view('profile', ['user' => auth()->user()]);
        }

public function logout(Request $request)
{
    Auth::guard('applicant')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('applicant.login');
}

}
