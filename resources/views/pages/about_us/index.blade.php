@extends('layouts.app')
@section('page-title', 'About Us')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div>
            <h4 class="page-title text-left">About Us Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">About Us</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">About Us list</a></li>

            </ol>
        </div>
        @include('notify::components.notify')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">About Us</h6>
            </div>
            <div class="card-body">
                <form action="{{route('admin.about.update',$about->id)}}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" value="{{$about->title}}"  class="form-control" id="youtube"
                            aria-describedby="textHelp">
                        @error('title')
                            {{$message}}
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="caption" class="form-label">caption</label>
                        <input type="text" name="caption" value="{{ $about->caption }}" class="form-control"
                            id="facebook" aria-describedby="textHelp">
                    </div>
                    @error('caption')
                        {{ $message }}
                    @enderror

                    @if ($about->image != null)
                        <div class="my-3">
                            <label for="image" class="form-label">Current Image</label>
                            <div>
                                <a href="{{ asset($about->image) }}" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ asset($about->image) }}" class="img-fluid" width="400px"
                                        alt="owner image" srcset="">
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>
                    @error('image')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control"  name="description" id="description" rows="3">{{$about->description}}</textarea>
                        @error('description')
                            {{$message}}
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
@push('scriptaddon')
    CKEDITOR.replace('description');
@endpush
