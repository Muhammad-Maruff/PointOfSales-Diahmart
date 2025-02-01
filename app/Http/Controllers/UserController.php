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
                'phone_number' => 'required',
                'address' => 'required',
                'isactive' => 'boolean',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Error',
                    'errors' => $validator->errors()
                ], 422);
            }
    
            $data = $validator->validated();
            
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/users', $imageName);
                $data['image'] = 'users/' . $imageName;
            }
    
            $data['password'] = Hash::make($data['password']);
            $data['isactive'] = $request->has('isactive');
    
            User::create($data);
    
            return response()->json([
                'status' => true,
                'message' => 'User berhasil dibuat'
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
        try {
            $validated = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$user->id,
                'username' => 'required|unique:users,username,'.$user->id,
                'phone_number' => 'required',
                'address' => 'required',
                'role_id' => 'required|exists:roles,id',
                'isactive' => 'required|in:0,1',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);
    
            if ($request->hasFile('image')) {
                // Hapus image lama jika ada
                if ($user->image && Storage::exists('public/' . $user->image)) {
                    Storage::delete('public/' . $user->image);
                }
                
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/users', $imageName);
                $validated['image'] = 'users/' . $imageName;
            }
    
            $validated['isactive'] = $request->isactive ? 1 : 0;
            $user->update($validated);
    
            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil diperbarui',
                'data' => $user
            ], 200);
    
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    
    
    

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json([
                'status' => true,
                'message' => 'User berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus user'
            ], 500);
        }
    }
    
}
