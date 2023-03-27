<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $roles = Role::all(['id', 'name']);
        return view('admin.settings.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.settings.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param PermissionService $permissionService
     * @return RedirectResponse
     */
    public function store(Request $request, PermissionService $permissionService): RedirectResponse
    {
        $request->validate([
            'role_name' => [
                'required',
                'string',
                'max:191',
                Rule::unique('roles', 'name')
            ]
        ]);
        $output = false;
        try {
            DB::beginTransaction();

            $role = Role::create([
                'name' => $request->input('role_name'),
            ]);

            $permissionService->createPermissionIfNotExists($request->input('permissions'));

            $role->syncPermissions($request->input('permissions'));

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('success', 'User Role With Permission Added');
            return redirect()->route('admin.settings.roles.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id): View
    {
        return view('', compact());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id): View
    {
        $role = Role::with('permissions:id,name')->findOrFail($id);
        $permissions = [];
        foreach ($role->permissions as $permission) {
            $permissions[] = $permission->name;
        }
        return view('admin.settings.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id, PermissionService $permissionService): RedirectResponse
    {
        $role = Role::findOrFail($id);
        $request->validate([
            'role_name' => [
                'required',
                'string',
                'max:191',
                Rule::unique('roles', 'name')->ignore($id)
            ]
        ]);

        $output = false;
        try {
            DB::beginTransaction();

            $role->update(['name' => $request->input('role_name')]);
            $permissionService->createPermissionIfNotExists($request->input('permissions'));
            $role->syncPermissions($request->input('permissions'));
            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('success', 'Role Updated!');
            return redirect()->route('admin.settings.roles.index');

        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.roles.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $role = Role::findOrFail($id);
        $output = false;
        try {
            DB::beginTransaction();
            $role->delete();
            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('success', 'Role deleted!');
            return redirect()->route('admin.settings.roles.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.roles.index');
    }
}
