@extends('layouts.app')
@section('page-title', 'Owner')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div>
            <h4 class="page-title text-left">Owner Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Owner</a></li>

            </ol>
        </div>
        @include('notify::components.notify')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Owner</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.owner.update', $owner->id) }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" value="{{ $owner->name }}" class="form-control"
                            id="youtube" aria-describedby="textHelp">
                    </div>
                    @error('name')
                        {{ $message }}
                    @enderror
                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" name="position" value="{{ $owner->position }}" class="form-control"
                            id="facebook" aria-describedby="textHelp">
                    </div>
                    @error('position')
                        {{ $message }}
                    @enderror

                    @if ($owner->image != null)
                        <div class="my-3">
                            <label for="image" class="form-label">Current Image</label>
                            <div>
                                <a href="{{ asset($owner->image) }}" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ asset($owner->image) }}" class="img-fluid" width="400px"
                                        alt="owner image" srcset="">
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="image" class="form-label">image</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>
                    @error('image')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="editor" rows="3">{{$owner->description}}</textarea>
                    </div>
                    @error('description')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
