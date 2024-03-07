@extends('layouts.app')
@section('page-title', 'Tour')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div>
            <h4 class="page-title text-left">Tour Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Tour</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Tour list</a></li>

            </ol>
        </div>
        {{-- </div> --}}
        <div class="p-1">

            <a href="{{ route('admin.tour.create') }}" class="btn btn-primary btn-sm">Create</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tour</h6>
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
                            @foreach ($tours as $tour)
                                
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$tour->title}}</td>
                                <td>{{$tour->slug}}</td>
                                <td>
                                    <img width="50px"
                                        src="https://media.istockphoto.com/id/1672317574/photo/ama-dablam-mountain-peak.webp?b=1&s=170667a&w=0&k=20&c=Ea8yDEHpUemrRuMZUKGPDBE11YTWVksIupMN8FkEBf8="
                                        alt="">
                                </td>
                                <td>
                                    <a href="{{ route('admin.blog.edit', $tour->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <a href="{{ route('admin.blog.show', $tour->id) }}"
                                        class="btn btn-success btn-sm">View</a>

                                    {{-- delete button------- --}}
                                    <form action="" method="post" class="d-inline">
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

    </div>
    <!-- /.container-fluid -->
@endsection
