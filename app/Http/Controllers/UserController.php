<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Get all users with their roles
     * Only accessible to admin users
     */
    public function getAllUsers()
    {
        // Check if user is admin
        $authUser = Auth::user();
        Log::info('getAllUsers called by:', ['user' => $authUser?->email, 'role' => $authUser?->role]);

        if (!Auth::check() || !$this->isAdmin($authUser)) {
            Log::warning('Unauthorized getAllUsers access attempt', ['user' => $authUser?->email, 'role' => $authUser?->role]);
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        try {
            $users = User::select('id', 'name', 'email', 'role', 'status', 'email_verified_at')->get();
            Log::info('getAllUsers returning ' . count($users) . ' users');
            return response()->json($users);
        } catch (\Exception $e) {
            Log::error('getAllUsers error:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Error fetching users', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update user role
     * Only accessible to admin users
     */
    public function updateUserRole(Request $request)
    {
        // Check if user is admin
        if (!Auth::check() || !$this->isAdmin(Auth::user())) {
            Log::warning('Unauthorized updateUserRole access attempt', ['user' => Auth::user()?->email]);
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        try {
            $request->validate([
                'id' => 'required|integer',
                'role' => 'required|in:admin,guru_bk,siswa,wali_murid'
            ]);

            $user = User::findOrFail($request->id);
            $oldStatus = $user->status;
            $user->role = $request->role;

            // Jika user sebelumnya pending (role atau status), ubah status menjadi active
            if (($oldStatus === 'pending' || $user->role === 'pending') && $request->role !== 'pending') {
                $user->status = 'active';
            }

            $user->save();
            Log::info('User role updated', ['user_id' => $user->id, 'new_role' => $user->role]);

            return response()->json(['message' => 'User role updated successfully', 'user' => $user]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('updateUserRole error:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Error updating user role', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Check if user is admin
     * Only 'admin' role is allowed
     */
    private function isAdmin($user)
    {
        return $user && $user->role === 'admin';
    }
}
