@extends('layouts.app')
@section('page-title', 'Team / Trash')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div>
            <h4 class="page-title text-left">Team Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Team</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Trash list</a></li>

            </ol>
        </div>
        @include('notify::components.notify')
        {{-- </div> --}}
        <div class="p-1">

            <a href="{{ route('admin.teams.index') }}" class="btn btn-primary btn-sm">View</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Team</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teams as $team)

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$team->name}}</td>
                                <td>{{$team->position}}</td>
                                <td>
                                    <span class="badge text-white {{ $team->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $team->status == 1 ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ asset( $team->image) }}"
                                        target="_blank" rel="noopener noreferrer">
                                        <img src="{{ asset( $team->image) }}"
                                            width="60px" alt="tour image" srcset="">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.teams.restore', $team->id) }}"
                                        class="btn btn-primary btn-sm">Restore</a>

                                    {{-- delete button------- --}}
                                    <form action="{{route('admin.teams.forcedelete',$team->id)}}" method="post" class="d-inline">
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
