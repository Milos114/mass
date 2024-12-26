<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionStoreRequest;
use App\Http\Requests\PermissionUpdateRequest;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function index(): View
    {
        return view('permissions.index', [
            'permissions' => Permission::simplePaginate(10),
        ]);
    }

    public function create(): View
    {
        return view('permissions.create');
    }

    public function store(PermissionStoreRequest $request): RedirectResponse
    {
        Permission::create($request->all());

        session()->flash('success', 'Permission created successfully.');

        return redirect()->route('permissions.index');
    }

    public function edit(Permission $permission): View
    {
        return view('permissions.edit', [
            'permission' => $permission,
            'users' => User::select('id', 'email')->get(),
        ]);
    }

    public function update(PermissionUpdateRequest $request, Permission $permission): RedirectResponse
    {
        DB::transaction(function () use ($request, $permission) {
            $permission->update($request->all());
            $permission->users()->sync($request->get('users'));
        });

        session()->flash('success', 'Permission updated successfully.');

        return redirect()->route('permissions.index');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();

        session()->flash('success', 'Permission deleted successfully.');

        return redirect()->route('permissions.index');
    }
}
