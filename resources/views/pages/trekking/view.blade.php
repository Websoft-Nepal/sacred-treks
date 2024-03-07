@extends('layouts.app')
@section('page-title', 'Trekking')
@section('main-section')
      <!-- Begin Page Content -->
      <div class="container-fluid">
        <div>
            <h4 class="page-title text-left">Trekking Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Trekking</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Trekking View</a></li>

            </ol>
        </div>
        {{-- </div> --}}
        <div class="p-1">
            <a href="{{route('admin.trekking.index')}}" class="btn btn-primary btn-sm">View</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">View Trekking</h6>
            </div>
            <div class="card-body">
            
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text"  class="form-control" id="title" aria-describedby="textHelp">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control"  id="image">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control"  id="description" rows="3"></textarea>
                </div>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection