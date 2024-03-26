@extends('layouts.app')
@section('page-title', 'Blog Page')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div>
            <h4 class="page-title text-left">Blog Page Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Blog Page list</a></li>

            </ol>
        </div>
        @include('notify::components.notify')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Blog Page</h6>
            </div>
            <div class="card-body">
                <form action="{{route('admin.page.blog.update',$blog->id)}}" method="POST">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" value="{{$blog->title}}"  class="form-control" id="youtube"
                            aria-describedby="textHelp">
                    </div>
                    @error('title')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="subtitle" class="form-label">subtitle</label>
                        <textarea class="form-control"  name="subtitle" id="subtitle" rows="3">{{$blog->subtitle}}</textarea>
                    </div>
                    @error('subtitle')
                        <div class="text-danger">{{$message}}</div>
                    @enderror

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
