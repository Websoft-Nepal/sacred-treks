@extends('layouts.app')
@section('page-title', 'Profile')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div>
            <h4 class="page-title text-left">Profile Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Profile</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Profile Manage</a></li>

            </ol>
        </div>
        @include('notify::components.notify')
        {{-- </div> --}}


        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Profile Details</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.update-profile', auth()->user()->id) }}">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" value="{{auth()->user()->name}}" class="form-control" id="name"
                            aria-describedby="textHelp">
                    </div>
                    @error('name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" value="{{auth()->user()->email}}" class="form-control" id="email"
                            aria-describedby="textHelp">
                    </div>
                    @error('email')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">
                            Update Profile
                        </button>

                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Profile Details</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.update-password', auth()->user()->id) }}">
                    <div class="mb-3">
                        <label for="name" class="form-label">Password</label>
                        <input type="text" name="password" class="form-control" id="name"
                            aria-describedby="textHelp">
                    </div>
                    @error('password')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="text" name="password_confirmation" class="form-control" id="password_confirmation"
                            aria-describedby="textHelp">
                    </div>
                    @error('password_confirmation')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">
                            Update Password
                        </button>

                    </div>
                </form>
            </div>
        </div>



    </div>
    <!-- /.container-fluid -->
@endsection
