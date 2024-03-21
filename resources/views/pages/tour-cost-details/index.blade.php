@extends('layouts.app')
@section('page-title', 'Tour cost details')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div>
            <h4 class="page-title text-left">Tour cost details</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Tour cost details</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Tour cost details</a></li>

            </ol>
        </div>
        @include('notify::components.notify')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @if ($tourCost !== null)
                    <h6 class="m-0 font-weight-bold text-primary">Tour cost details create</h6>
                @else
                    <h6 class="m-0 font-weight-bold text-primary">Tour cost details</h6>
                @endif
            </div>
            <div class="card-body">

                @if ($tourCost === null)
                    <form action = "{{ route('admin.tour.cost.store') }}" method="POST">
                        <input type="text" name="tour_id" value="{{ $tour_id }}" hidden class="form-control"
                            id="youtube" aria-describedby="textHelp">
                        @error('tour_id')
                            <div class="text-danger">{{$message}}</div>

                        @enderror
                    @else
                        <form action="{{ route('admin.tour.cost.update', $tourCost->id ?? 1) }}" method="POST">
                            @method('put')
                            <input type="text" name="tour_id" value="{{ $tourCost->tour_id ?? 1 }}" hidden
                                class="form-control" id="youtube" aria-describedby="textHelp">
                @endif
                @csrf

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3">{{ $tourCost->description ?? "" }}</textarea>
                </div>

                @if ($tourCost === null)
                    <button type="submit" class="btn btn-primary">Create</button>
                @else
                    <button type="submit" class="btn btn-primary">Update</button>
                @endif
                </form>
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
