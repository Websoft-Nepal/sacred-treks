@extends('layouts.app')
@section('page-title', 'Trekking Page')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div>
            <h4 class="page-title text-left">Trekking Page Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Trekking Page list</a></li>

            </ol>
        </div>
        @include('notify::components.notify')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Trekking Page</h6>
            </div>
            <div class="card-body">
                <form action="{{route('admin.page.trekking.update',$trekking->id)}}" method="POST">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="itinerary_quotes" class="form-label">Itinerary Quotes</label>
                        <textarea class="form-control"  name="itinerary_quotes" id="itinerary_quotes" rows="3">{{$trekking->itinerary_quotes}}</textarea>
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
