<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all(); // Fetch all branches from the database
        $roles = Role::all(); // You should also pass roles to the view, if required
        return view('admin.users.create', compact('branches', 'roles')); // Pass branches and roles to the view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'profile' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Optional profile image
            'role' => 'required',
            'number' => 'required',
            'address' => 'required',
            'branch' => 'required',
            'status' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role;
        $user->number = $request->number;
        $user->address = $request->address;
        $user->branch = $request->branch;
        $user->status = $request->status;
        if ($request->file('profile')) {
            $img = $request->file(key: 'profile');
            $ext = rand() . "." . $img->getClientOriginalName();
            $img->move("user/profile/", $ext);
            $user->profile = $ext;
        }
        $user->save();
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['user'] = User::find($id);
        $data['roles'] = Role::all();
        return view('admin.users.edit', $data);  // Pass the user data
    }
    

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
            'number' => 'required',
            'address' => 'required',
            'branch' => 'required',
            'status' => 'required',
            'profile' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:3072',  // Validation for profile image
        ]);
    
        $user = User::find($id);
    
        // Store the form data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->number = $request->number;
        $user->address = $request->address;
        $user->branch = $request->branch;
        $user->status = $request->status;
    
        // Update password if provided
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
    
        // Update role
        $user->role_id = $request->role;
    
        // Handle the profile image upload if a new image is uploaded
        if ($request->hasFile('profile')) {
            // Delete the old image if it exists
            if ($user->profile && file_exists(public_path('user/profile/' . $user->profile))) {
                unlink(public_path('user/profile/' . $user->profile));  // Remove the old profile image
            }
    
            // Store the new image
            $img = $request->file('profile');
            $imageName = rand() . '.' . $img->getClientOriginalExtension();  // Generate a unique name for the image
            $img->move(public_path('user/profile/'), $imageName);  // Move the image to the profile folder
    
            $user->profile = $imageName;  // Store the image name in the user's profile column
        }
    
        // Save the updated user data
        $user->save();
    
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        // Check if the user has a profile picture and if the file exists
        if ($user->profile) {
            $profile = public_path('user/profile/' . $user->profile);

            // Check if the file exists and then delete it
            if (file_exists($profile)) {
                unlink($profile);  // Delete the file
            }
        }

        // After deleting the file, delete the user from the database
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    /**
     * Logout the user and redirect to the login page.
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();  // Logout the user

        $request->session()->invalidate();  // Invalidate the session
        $request->session()->regenerateToken();  // Regenerate the CSRF token

        return redirect('https://micro-loan-managment.test/login');  // Redirect to login page
    }
}
