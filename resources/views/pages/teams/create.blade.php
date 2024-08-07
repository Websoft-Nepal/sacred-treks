@extends('layouts.app')
@section('page-title', 'Teams')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div>
            <h4 class="page-title text-left">Teams Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Teams</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Teams Create</a></li>

            </ol>
        </div>
        {{-- </div> --}}
        <div class="p-1">
            <a href="{{ route('admin.teams.index') }}" class="btn btn-primary btn-sm">View</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add Teams</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label"><span class="text-danger">*</span>Name</label>
                        <input type="text" name="name" class="form-control" id="name"
                            aria-describedby="textHelp" value="{{old('name')}}">
                        @error('name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label"><span class="text-danger">*</span>Position</label>
                        <input type="text" name="position" class="form-control" id="position"
                            aria-describedby="textHelp" value="{{old('position')}}">
                        @error('position')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label"><span class="text-danger">*</span>Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                        @error('image')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class=" mb-3">
                        <label class="form-label" for="inputGroupSelect01">Status</label>
                        <select class="form-select form-control" name="status" id="inputGroupSelect01">
                            <option selected>Choose...</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    @error('status')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                    <button type="submit" class="btn btn-primary">Create</button>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
