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
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Blog Edit</a></li>

            </ol>
        </div>
        {{-- </div> --}}
        <div class="p-1">
            <a href="{{ route('admin.blog.index') }}" class="btn btn-primary btn-sm">View</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Blog</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" value="{{ $blog->title }}" class="form-control" id="title"
                            aria-describedby="textHelp">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                        @if ($blog->image != null)
                            <div class="my-3">
                                <label for="image" class="form-label">Current Image</label>
                                <div>
                                    <a href="{{ asset('storage/uploads/blog/' . $blog->image) }}" target="_blank"
                                        rel="noopener noreferrer">
                                        <img src="{{ asset('storage/uploads/blog/' . $blog->image) }}" class="img-fluid"
                                            width="200px" alt="blog image" srcset="">
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" value="{{ $blog->slug }}" name="slug"
                            id="slug">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">
                            Status</label>
                        <div class="custom-control custom-switch form-control" style="min-height: 55px;">
                            <input type="checkbox" class="custom-control-input" name="status" id="status"  @checked($blog->status)>
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
                        <label for="editor" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="editor" rows="3">{{ $blog->description }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Edit</button>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
@push('scriptaddon')
    ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .catch( error => {
    console.error( error );
    } );
@endpush
