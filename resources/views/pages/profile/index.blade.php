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
                        <form action="">
                            <div class="mb-3">
                                <label for="name" class="form-label">Username</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    aria-describedby="textHelp">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" class="form-control" id="email"
                                    aria-describedby="textHelp">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone"
                                    aria-describedby="textHelp">
                            </div>
                        </form>
                    </div>
                </div>
          


    </div>
    <!-- /.container-fluid -->
@endsection
