@extends('layouts.app')
@section('page-title', 'Terms')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div>
            <h4 class="page-title text-left">Terms Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Terms /a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Terms and Condition view</a></li>

            </ol>
        </div>
        @include('notify::components.notify')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Terms and Condition </h6>
            </div>
            <div class="card-body">
                <form action="{{route('admin.terms.update',$terms->id)}}" method="POST">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" value="{{$terms->title}}"  class="form-control" id="youtube"
                            aria-describedby="textHelp">
                    </div>
                    @error('title')
                        {{$message}}
                    @enderror
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control"  name="description" id="description" rows="3">{{$terms->description}}</textarea>
                    </div>
                    @error('description')
                        {{$message}}
                    @enderror

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
@push('scriptaddon')
CKEDITOR.replace('description');

@endpush
