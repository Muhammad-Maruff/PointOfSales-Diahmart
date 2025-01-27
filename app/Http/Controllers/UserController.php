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
                'isactive' => 'boolean'
            ], [
                'name.required' => 'Nama harus diisi',
                'email.unique' => 'Email sudah digunakan',
                'username.unique' => 'Username already digunakan',
                'password.min' => 'Password harus lebih dari 5 karakter',
                'phone_number.required' => 'Nomor telepon harus diisi',
                'address.required' => 'Alamat harus diisi',
                'role_id.required' => 'Role harus dipilih',
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
                'isactive' => 'required|in:0,1' // This ensures only 0 or 1 values
            ]);
    
            // Convert checkbox value to 0 or 1
            $validated['isactive'] = $request->isactive ? 1 : 0;
            
            $user->update($validated);
    
            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil diperbarui',
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'username' => $user->username,
                    'role_id' => $user->role_id,
                    'isactive' => $user->isactive
                ]
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
