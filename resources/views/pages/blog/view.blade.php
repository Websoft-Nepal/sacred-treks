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
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Blog View</a></li>

            </ol>
        </div>
        {{-- </div> --}}
        <div class="p-1">
            <a href="{{ route('admin.blog.index') }}" class="btn btn-primary btn-sm">View</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">View Blog</h6>
            </div>
            <div class="card-body">
                
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text"  value="{{$blog->title}}" class="form-control" id="title"
                            aria-describedby="textHelp">
                    </div>
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
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" value="{{$blog->slug}}"  id="slug">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control"  id="description" rows="3">{{$blog->description}}</textarea>
                    </div>
                   

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
