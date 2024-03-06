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
                            <tr>
                                <td>1</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>
                                    <img width="50px"
                                        src="https://media.istockphoto.com/id/1672317574/photo/ama-dablam-mountain-peak.webp?b=1&s=170667a&w=0&k=20&c=Ea8yDEHpUemrRuMZUKGPDBE11YTWVksIupMN8FkEBf8="
                                        alt="">
                                </td>
                                <td>
                                    <!-- Button view modal -->
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#viewTrekking_">
                                        view
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="viewTrekking_" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">View Description</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">


                                                    <div class="mb-3">
                                                        <label for="message" class="form-label">Description</label>
                                                        <textarea class="form-control" id="message" rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Button edit modal -->
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#editTrekking_">
                                        edit
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="editTrekking_" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit trekking</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="title" class="form-label">Title</label>
                                                            <input type="text" class="form-control" name="title"
                                                                id="title">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="slug" class="form-label">Slug</label>
                                                            <input type="text" class="form-control" name="slug"
                                                                id="slug">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="image" class="form-label">Image</label>
                                                            <input type="file" class="form-control" name="image"
                                                                id="image">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="description"
                                                                class="form-label">Description</label>
                                                            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                </div>
                {{-- delete button------- --}}
                <form action="" method="post" class="d-inline">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('are you want to delete')">delete</button>
                </form>
                </td>
                </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>

    </div>
    <!-- /.container-fluid -->
@endsection
