@extends('layouts.app')
@section('page-title', 'Blog')
@section('main-section')
      <!-- Begin Page Content -->
      <div class="container-fluid">
        <div>
            <h4 class="page-title text-left">Blog Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Blog</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Blog Create</a></li>

            </ol>
        </div>
        {{-- </div> --}}
        <div class="p-1">
            <a href="{{route('admin.blog.index')}}" class="btn btn-primary btn-sm">View</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add Blog</h6>
            </div>
            <div class="card-body">
               <form action="{{route('admin.blog.store')}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" id="title" aria-describedby="textHelp">
                </div>
                @error('title')
                    {{$message}}
                @enderror
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                @error('image')
                    {{$message}}
                @enderror
                <div class="mb-3">
                    <label for="status" class="form-label">
                        Status</label>
                    <div class="custom-control custom-switch form-control" style="min-height: 55px;">
                        <input type="checkbox" class="custom-control-input" name="status" id="status" checked>
                        <label class="custom-control-label" for="status">Status</label>
                        <small id="statulHelp" class="form-text text-muted">This will decide whether to show it or not. (active or not)</small>
                    </div>
                </div>
                @error('status')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                </div>
                @error('description')
                    {{ $message }}
                @enderror
                <button type="submit" class="btn btn-primary">Create</button>

               </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
@push('scriptaddon')
    CKEDITOR.replace('description');
@endpush
