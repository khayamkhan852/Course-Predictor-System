<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (! auth()->user()->can('user.view')) {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        });
    }


    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $users = User::with('user:id,name', 'media', 'roles:id,name')
            ->orderBy('id', 'DESC')
            ->get();

        return view('settings.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        if (! auth()->user()->can('user.create')) {
            abort(403, 'Unauthorized action.');
        }

        $departments = Department::get(['id', 'name']);
        $roles = Role::where('id', '!=', '1')->get(['id', 'name']);
        return view('settings.users.create', compact('roles', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $request
     * @return RedirectResponse
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        if (! auth()->user()->can('user.create')) {
            abort(403, 'Unauthorized action.');
        }
        $output = false;
        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'department_id' => $request->input('department_id'),
                'user_id' => auth()->id(),
                'password' => Hash::make($request->input('password')),
            ]);
            if ($request->hasFile('user_avatar')) {
                $user->addMediaFromRequest('user_avatar')->toMediaCollection('users');
            }

            $user->assignRole($request->input('role'));

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('success', 'User added!');
            return redirect()->route('settings.users.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('settings.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        $user->load('user:id,name', 'media', 'roles:id,name');
        return view('settings.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        if (! auth()->user()->can('user.update')) {
            abort(403, 'Unauthorized action.');
        }

        $user->load('roles');

        $departments = Department::get(['id', 'name']);
        $roles = Role::where('id', '!=', '1')->get(['id', 'name']);
        return view('settings.users.edit', compact('user', 'roles', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        if (! auth()->user()->can('user.update')) {
            abort(403, 'Unauthorized action.');
        }


        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'department_id' => ['required', 'numeric'],
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($user->id)
            ],
            'user_avatar' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'role' => $user->id !== 1 ? ['required', 'numeric'] : '',
        ]);
        $output = false;
        try {
            DB::beginTransaction();

            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'department_id' => $request->input('department_id'),
            ]);

            if ($request->hasFile('user_avatar')) {
                $user->clearMediaCollection('users');
                $user->addMediaFromRequest('user_avatar')->toMediaCollection('users');
            }

            if ($user->id !== 1 && $request->has('role')) {
                $user->syncRoles($request->input('role'));
            }

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('success', 'User Updated!');
            return redirect()->route('settings.users.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('settings.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        if (! auth()->user()->can('user.delete')) {
            abort(403, 'Unauthorized action.');
        }

        $output = false;
        try {
            DB::beginTransaction();
            foreach ($user->roles as $role) {
                $user->removeRole($role);
            }
            $user->delete();
            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('success', 'User deleted!');
            return redirect()->route('settings.users.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('settings.users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function resetPassword(User $user): View
    {
        if (! auth()->user()->can('user.reset.password')) {
            abort(403, 'Unauthorized action.');
        }
        return view('settings.users.reset-password', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function postResetPassword(Request $request, User $user): RedirectResponse
    {
        if (! auth()->user()->can('user.reset.password')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);
        if (!Hash::check($request->input('current_password'), $user->password)) {
            alert()->warning('failed', 'Current Password did not matched!!');
            return redirect()->back();
        }
        $output = false;
        try {
            DB::beginTransaction();
            $user->update([
                'password' => Hash::make($request->input('password'))
            ]);
            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('success', 'User password updated');
            return redirect()->route('settings.users.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('settings.users.index');
    }
}
