@extends('layouts.app')
@section('page-title', 'Social Media')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div>
            <h4 class="page-title text-left">Social Media Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Social Media</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Social Media list</a></li>

            </ol>
        </div>
        @include('notify::components.notify')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Social Media</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Title</th>
                                <th>Value</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($socials as $social)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $social->title }}</td>
                                    <td>{{ $social->value }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#exampleModalCenter_">
                                            edit
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter_" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">View Message</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('admin.social.update',$social->id)}}" method="post"></form>
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="value" class="form-label">Value</label>
                                                            <input type="text" name="value" class="form-control" id="value"
                                                                aria-describedby="textHelp">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-secondary">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
