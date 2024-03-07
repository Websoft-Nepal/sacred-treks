@extends('layouts.app')
@section('page-title', 'Trekking')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div>
            <h4 class="page-title text-left">Trekking Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Trekking</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Trekking list</a></li>

            </ol>
        </div>
        {{-- </div> --}}
        <div class="p-1">

            <a href="{{ route('admin.trekking.create') }}" class="btn btn-primary btn-sm">Create</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Trekking</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Title</th>
                                <th>slug</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trekkings as $trekking)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $trekking->title }}</td>
                                    <td>{{ $trekking->slug }}</td>
                                    <td>
                                        <a href="{{ asset('storage/uploads/trekking/' . $trekking->image) }}"
                                            target="_blank" rel="noopener noreferrer">
                                            <img src="{{ asset('storage/uploads/trekking/' . $trekking->image) }}"
                                                width="60px" alt="Trekking image" srcset="">
                                        </a>
                                    </td>
                                    <td>

                                        <a href="{{ route('admin.trekking.edit', $trekking->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{ route('admin.trekking.show', $trekking->id) }}"
                                            class="btn btn-success btn-sm">View</a>


                                        {{-- delete button------- --}}
                                        <form action="{{ route('admin.trekking.destroy', $trekking->id) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('are you want to delete')">delete</button>
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
