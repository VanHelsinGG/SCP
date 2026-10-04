<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userIndex()
    {
        return view('admin.users.index');
    }

    public function admIndex()
    {
        return view('admin.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:sec,atdr,aux',
            'profile_picture' => 'nullable|image|max:2048',
            'CPF' => 'required|string|max:14|unique:users',
            'phone' => 'nullable|string|max:15',
            'RG' => 'nullable|string|max:12',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'status' => 'active',
            'profile_picture' => $request->profile_picture,
            'CPF' => $request->CPF,
            'phone' => $request->phone,
            'RG' => $request->RG,
        ]);

        return redirect()->route('admin.index')->with('success', 'User created successfully.');
    }
}
