@extends('layouts.dashboard')
@section('title', 'Create role')
@section('breadcrumbs')
<li class="breadcrumb-item"><i class="fas fa-home"></i> <a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('roles.index') }}"> Roles</a></li>
<li class="breadcrumb-item active" aria-current="page"> Create new role</li>
@endsection
@section('content')
<!-- Website Overview -->
<div class="card role-create-form">
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="card-header main-color-bg">
            Create new role
        </div>
        <div class="card-body">
            <div class="form-group mb-4">
                <label for="name" class="form-label">Role name</label>
                <input id="name" class="form-control" type="text" name="name" placeholder="Role name">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
            </div>

            <div class="form-group mb-4">
                <label for="permissions" class="form-label">Permissions</label>
                <div class="row">
                    @foreach ($permissions as $per)
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" name="permission[]" type="checkbox" value="{{ $per->id }}"
                                id="permission-{{ $per->id }}">
                            <label class="form-check-label" for="permission-{{ $per->id }}" style="cursor: pointer">
                                {{ Str::ucfirst($per->name) }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                    @error('permission')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
        </div>
    </form>
</div>
@endsection
