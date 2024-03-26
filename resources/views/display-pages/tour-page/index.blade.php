@extends('layouts.app')
@section('page-title', 'Tour Page')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div>
            <h4 class="page-title text-left">Tour Page Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Tour Page list</a></li>

            </ol>
        </div>
        @include('notify::components.notify')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tour Page</h6>
            </div>
            <div class="card-body">
                <form action="{{route('admin.page.tour.update',$tour->id)}}" method="POST">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="itinerary_quotes" class="form-label">Itinerary Quotes</label>
                        <textarea class="form-control"  name="itinerary_quotes" id="itinerary_quotes" rows="3">{{$tour->itinerary_quotes}}</textarea>
                    </div>
                    @error('itinerary_quotes')
                        <div class="text-danger">{{$message}}</div>
                    @enderror

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
