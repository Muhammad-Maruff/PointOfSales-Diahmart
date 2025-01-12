<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        $roles = Role::all();
        return view('users.index', compact('users', 'roles'));
    }

    public function edit(User $user)
    {
        return response()->json($user);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'username' => 'required|string|unique:users|max:255',
                'password' => 'required|string|min:5',
                'role_id' => 'required|exists:roles,id',
                'isactive' => 'boolean'
            ], [
                'name.required' => 'Name is required',
                'email.unique' => 'Email already exists',
                'username.unique' => 'Username already exists',
                'password.min' => 'Password must be at least 6 characters'
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Error',
                    'errors' => $validator->errors()
                ], 422);
            }
    
            $data = $validator->validated();
            $data['password'] = Hash::make($data['password']);
            $data['isactive'] = $request->has('isactive');
    
            User::create($data);
    
            return response()->json([
                'status' => true,
                'message' => 'User created successfully!'
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'username' => 'required|unique:users,username,'.$user->id,
            'role_id' => 'required|exists:roles,id',
            'isactive' => 'boolean'
        ]);

        $validated['isactive'] = $request->has('isactive');
        
        $user->update($validated);
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
