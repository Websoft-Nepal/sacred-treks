@extends('layouts.app')
@section('page-title', 'Trekking')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div>
            <h4 class="page-title text-left">Trekking Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Trekking</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Trekking Edit</a></li>

            </ol>
        </div>
        {{-- </div> --}}
        <div class="p-1">
            <a href="{{ route('admin.trekking.index') }}" class="btn btn-primary btn-sm">View</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Trekking</h6>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title"  value="{{$trekking->title}}" class="form-control" id="title" value="{{$trekking->title}}"
                            aria-describedby="textHelp">
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug"  value="{{$trekking->slug}}" class="form-control" id="slug" aria-describedby="textHelp">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                        <div class="my-3">
                            <label for="image" class="form-label">Current Image</label>
                            <div>
                                <a href="{{ asset('storage/uploads/trekking/' . $trekking->image) }}" target="_blank"
                                    rel="noopener noreferrer">
                                    <img src="{{ asset('storage/uploads/trekking/' . $trekking->image) }}" class="img-fluid"
                                        width="400px" alt="Trekking image" srcset="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
