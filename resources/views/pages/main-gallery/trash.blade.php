@extends('layouts.app')
@section('page-title', 'Main Gallery / Trash')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div>
            <h4 class="page-title text-left">Main Gallery Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Main Galleryr</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Trash list</a></li>

            </ol>
        </div>
        @include('notify::components.notify')
        {{-- </div> --}}
        <div class="p-1">

            <a href="{{ route('admin.maingallery.index') }}" class="btn btn-primary btn-sm">View</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Main Gallery</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($galleries as $gallery)

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$gallery->title}}</td>
                                <td>
                                    <a href="{{ asset( $gallery->image) }}"
                                        target="_blank" rel="noopener noreferrer">
                                        <img src="{{ asset( $gallery->image) }}"
                                            width="60px" alt="tour image" srcset="">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.maingallery.restore', $gallery->id) }}"
                                        class="btn btn-primary btn-sm">Restore</a>

                                    {{-- delete button------- --}}
                                    <form action="{{route('admin.maingallery.forcedelete',$gallery->id)}}" method="post" class="d-inline">
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

    </div>
    <!-- /.container-fluid -->
@endsection
