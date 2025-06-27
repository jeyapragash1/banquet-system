<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        // Get all users and load their roles to display in the table
        $users = User::with('roles')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        // Get all available roles to populate the dropdown
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        // Use the syncRoles method to remove all old roles and apply the new one
        $user->syncRoles($request->role);

        return redirect()->route('users.index')->with('success', 'User role updated successfully.');
    }
}