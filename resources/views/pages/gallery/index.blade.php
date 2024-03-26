@extends('layouts.app')
@section('page-title', 'Gallery')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div>
            <h4 class="page-title text-left">Gallery</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Gallery</a></li>

            </ol>
        </div>
        @include('notify::components.notify')
        {{-- </div> --}}
        <div class="p-1">

            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createModal"
                data-whatever="@mdo">Create</button>

            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Add Image</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action = "{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="image" class="col-form-label">Image:</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                </div>
                            </div>
                            @error('image')
                                {{$message}}
                            @enderror
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="category" class="col-form-label">Category:</label>
                                    <input type="text" class="form-control" name="category" id="category">
                                </div>
                            </div>
                            @error('category')
                                {{$message}}
                            @enderror
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="Submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Gallery</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($galleries as $gallery)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ asset('storage/uploads/gallery/' . $gallery->image) }}"
                                            target="_blank" rel="noopener noreferrer">
                                            <img src="{{ asset('storage/uploads/gallery/' . $gallery->image) }}"
                                                width="60px" alt="Trekking image" srcset="">
                                        </a>
                                    </td>
                                    <td>{{ $gallery->category }}</td>
                                    <td>
                                        {{-- Edit button modal  --}}
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                            data-target="#editModal{{ $gallery->id }}" data-whatever="@mdo">Edit</button>

                                        {{-- Modal  --}}
                                        <div class="modal fade" id="editModal{{ $gallery->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Add gallery</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{ route('admin.gallery.update',$gallery->id) }}">
                                                        <div class="modal-body">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="image" class="col-form-label">Image:</label>
                                                                    <input type="file" class="form-control" name="image" id="image">
                                                                </div>
                                                            </div>
                                                            @error('image')
                                                                {{$message}}
                                                            @enderror
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="category" class="col-form-label">Category:</label>
                                                                    <input type="text" class="form-control" name="category" value="{{$gallery->category}}" id="category">
                                                                </div>
                                                            </div>
                                                            @error('category')
                                                                {{$message}}
                                                            @enderror
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="Submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- delete button------- --}}
                                        <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('are you want to delete')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
