<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\UserStoreRequest;
use App\Models\Branch;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public $branch_id, $is_admin = false;

    public function __construct()
    {
        $this->middleware(function ($request, $next){
            $this->branch_id = request()->session()->get('branch_id');
            if (auth()->user()->hasRole('Admin')) {
                $this->is_admin = true;
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
        $users = User::with('user:id,name', 'media', 'roles:id,name', 'branch:id,name')
            ->when(! $this->is_admin, function ($query) {
                $query->where('branch_id', $this->branch_id);
            })
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.settings.users.index', compact('users'));
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

        $roles = Role::get(['id', 'name']);
        $branches = Branch::where('id', '!=', 1)->get(['id', 'name']);
        return view('admin.settings.users.create', compact('roles', 'branches'));
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
                'branch_id' => $request->input('branch_id'),
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
            return redirect()->route('admin.settings.users.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        if (! auth()->user()->can('user.view')) {
            abort(403, 'Unauthorized action.');
        }

        if ($this->is_admin === false && $user->branch_id !== $this->branch_id) {
            abort(404);
        }

        $user->load('user:id,name', 'media', 'roles:id,name', 'branch:id,name');
        return view('admin.settings.users.show', compact('user'));
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

        if ($this->is_admin === false && $user->branch_id !== $this->branch_id) {
            abort(404);
        }

        $roles = Role::get(['id', 'name']);
        $branches = Branch::where('id', '!=', 1)->get(['id', 'name']);
        return view('admin.settings.users.edit', compact('user', 'roles', 'branches'));
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

        if ($this->is_admin === false && $user->branch_id !== $this->branch_id) {
            abort(404);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required'],
            'branch_id' => ['required'],
            'user_avatar' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
        ]);
        $output = false;
        try {
            DB::beginTransaction();

            $user->update([
                'name' => $request->input('name'),
                'branch_id' => $request->input('branch_id'),
            ]);
            if ($request->hasFile('user_avatar')) {
                $user->clearMediaCollection('users');
                $user->addMediaFromRequest('user_avatar')->toMediaCollection('users');
            }

            $user->syncRoles($request->input('role'));

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('success', 'User Updated!');
            return redirect()->route('admin.settings.users.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.users.index');
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

        if ($this->is_admin === false && $user->branch_id !== $this->branch_id) {
            abort(404);
        }

        $output = false;
        try {
            DB::beginTransaction();
            $user->removeRole($user->roles);
            $user->delete();
            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('success', 'User deleted!');
            return redirect()->route('admin.settings.users.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.users.index');
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

        if ($this->is_admin === false && $user->branch_id !== $this->branch_id) {
            abort(404);
        }

        return view('admin.settings.users.reset-password', compact('user'));
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

        if ($this->is_admin === false && $user->branch_id !== $this->branch_id) {
            abort(404);
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
            return redirect()->route('admin.settings.users.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.users.index');
    }
}
