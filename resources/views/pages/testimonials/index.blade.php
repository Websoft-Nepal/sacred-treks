@extends('layouts.app')
@section('page-title', 'Testimonial')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div>
            <h4 class="page-title text-left">Testimonial Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Testimonial</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Testimonial list</a></li>

            </ol>
        </div>
        @include('notify::components.notify')
        {{-- </div> --}}
        <div class="p-1">

            <a href="{{ route('admin.testimonial.create') }}" class="btn btn-primary btn-sm">Create</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Testimonial</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($testimonials as $testimonial)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $testimonial->name }}</td>
                                    <td>
                                        <a href="{{ asset($testimonial->image) }}" target="_blank"
                                            rel="noopener noreferrer">
                                            <img src="{{ asset($testimonial->image) }}" width="60px"
                                                alt="Testimonial image" srcset="">
                                        </a>
                                    </td>

                                    <td>
                                        <span
                                            class="badge  {{ $testimonial->status === 'inactive' ? 'bg-danger' : 'bg-success' }} text-white">{{ $testimonial->status }}</span>
                                    </td>
                                    <td>
                                        <!-- Button view modal -->
                                        <a href="{{ route('admin.testimonial.edit', $testimonial->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{ route('admin.testimonial.show', $testimonial->id) }}"
                                            class="btn btn-success btn-sm">View</a>
                                        {{-- delete button------- --}}
                                        <form action="{{ route('admin.testimonial.destroy', $testimonial->id) }}"
                                            method="post" class="d-inline">
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
