<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index() {

        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    public function create() {
        return view('roles.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Role::create($request->all());

        return redirect()->route('roles.index')->with('success', 'Roles create successfully');
    }

     public function edit(Role $role) {

        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $role->update($request->all());

        return redirect()->route('roles.index')->with('success', 'Roles updated successfully');
    }

    public function destroy(int $id) {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Roles deleted successfully');
    }

}
