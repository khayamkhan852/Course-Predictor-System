@extends('layouts.app')
@section('title', 'Edit User')

@section('content')
    <x-breadcrum name="users" parent="1" parent-name="Settings" page-name="Edit User" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15">
                    <div class="pb-10">
                        <form class="form w-100" action="{{ route('settings.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-10">
                                <div class="col-12">
                                    <x-image-preloaded name="user_avatar" url="{{ $user->getFirstMediaUrl('users') ?: asset('theme/assets/media/avatars/300-6.jpg') }}" />
                                </div>
                            </div>
                            @error('user_avatar')
                                <x-error>{{ $message }}</x-error>
                            @enderror

                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="name" class="required">Name</x-label>
                                    <x-input id="name" name="name" value="{{ old('email') ?: $user->name }}"
                                             placeholder="Name" autofocus required />
                                    @error('name')
                                    <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="email" class="required">Email</x-label>
                                    <x-input id="email" type="email" name="email"
                                             value="{{ old('email') ?: $user->email }}" required placeholder="Email" readonly />
                                    @error('email')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-10">
                                    <x-label for="role" class="required">User Role</x-label>
                                    <x-select-two name="role" id="role" required>
                                        <option value=""></option>
                                        @if($user->id === 1)
                                            <option value="1" selected>Admin</option>
                                        @else
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ (old('role') && in_array($role->id, old('role'))) || (empty(old('role')) && in_array($role->id, $user->roles->pluck('id')->toArray()))  ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </x-select-two>
                                    @error('role')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>
                            <x-button class="btn-primary">Update {{ $user->name }}</x-button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection





