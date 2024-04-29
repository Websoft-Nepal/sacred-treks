@extends('layouts.app')
@section('page-title', 'Teams')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div>
            <h4 class="page-title text-left">Teams Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Teams</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Teams list</a></li>

            </ol>
        </div>
        @include('notify::components.notify')
        {{-- </div> --}}
        <div class="p-1">

            <a href="{{ route('admin.teams.create') }}" class="btn btn-primary btn-sm">Create</a>
            <a href="{{ route('admin.teams.trash') }}" class="btn btn-danger btn-sm mx-3">View Trash</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Teams</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teams as $team)

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$team->title}}</td>
                                <td>
                                    <span class="badge text-white {{ $team->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $team->status == 1 ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ asset( $team->image) }}"
                                        target="_blank" rel="noopener noreferrer">
                                        <img src="{{ asset( $team->image) }}"
                                            width="60px" alt="team image" srcset="">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.teams.edit', $team->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    {{-- <a href="{{ route('admin.tour.show', $team->id) }}"
                                        class="btn btn-success btn-sm">View</a> --}}

                                    {{-- delete button------- --}}
                                    <form action="{{route('admin.teams.destroy',$team->id)}}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('are you want to delete')">Trash</button>
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
