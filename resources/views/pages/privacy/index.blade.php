@extends('layouts.app')
@section('page-title', 'Privacy')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div>
            <h4 class="page-title text-left">Privacy Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Privacy</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Privacy list</a></li>

            </ol>
        </div>
        @include('notify::components.notify')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Privacy</h6>
            </div>
            <div class="card-body">
                <form action="{{route('admin.privacy.update',$privacy->id)}}" method="POST">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" value="{{$privacy->title}}"  class="form-control" id="youtube"
                            aria-describedby="textHelp">
                    </div>
                    @error('title')
                        {{$message}}
                    @enderror
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control"  name="description" id="description" rows="3">{{$privacy->description}}</textarea>
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
    ClassicEditor
    .create( document.querySelector( '#description' ) )
    .catch( error => {
    console.error( error );
    } );

@endpush
