@extends('layouts.mainLayout')
@section('title', 'User Management')

@section('content')
<div class="container-xl">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Users Management
                    </h2>
                    <div class="text-muted mt-1">{{ $users->count() }} users</div>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <input type="search" class="form-control d-inline-block w-9 me-3" data-search-user placeholder="Search user…">
                        <button type="button" class="btn btn-new-data" id="btn-new-user">
                            <i class="ti ti-circle-plus icon"></i>
                           Tambah
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Users grid -->
    <div class="row row-cards mt-3">
        @foreach($users as $user)
        <div class="col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body p-4 text-center">
                    <span class="avatar avatar-xl mb-3 rounded" style="background-image: url(https://eu.ui-avatars.com/api/?name={{ urlencode($user->nama) }})"></span>
                    <h3 class="m-0 mb-1">{{ $user->name }}</h3>
                    <div class="text-muted">{{ $user->role->roles }}</div>
                    <div class="mt-3">
                        <span class="badge {{ $user->isactive ? 'bg-green-lt' : 'bg-red-lt' }}">
                            {{ $user->isactive ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </div>
                </div>
                <div class="d-flex">
                    <a href="#" class="card-btn" data-bs-toggle="modal" data-bs-target="#modal-edit-user"
                       onclick="UserManager.editUser({{ $user->id }})">
                        <i class="ti ti-edit icon"></i>
                        
                    </a>
                    <a href="#" class="card-btn text-danger" onclick="UserManager.deleteUser({{ $user->id }})">
                        <i class="ti ti-trash icon"></i>
                        
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@include('users.form')
@endsection
