@extends('layouts.app')
@section('page-title', 'Admin - Dashboard')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Contact Message</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#exampleModalCenter_">
                                        view
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
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                      <label for="message" class="form-label">Message</label>
                                                      <textarea class="form-control" id="message" rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button"  class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="" method="post" class="d-inline">
                                       @csrf
                                       @method('delete')
                                       <button class="btn btn-danger btn-sm" onclick="return confirm('are you want to delete')" >delete</button>
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
