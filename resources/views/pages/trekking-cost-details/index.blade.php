@extends('layouts.app')
@section('page-title', 'Trekking cost details')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div>
            <h4 class="page-title text-left">Trekking cost details</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('admin.trekking.index') }}">Trekking</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Trekking cost details</a></li>

            </ol>
        </div>
        @include('notify::components.notify')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @if ($trekkingCost !== null)
                    <h6 class="m-0 font-weight-bold text-primary">Trekking cost details create</h6>
                @else
                    <h6 class="m-0 font-weight-bold text-primary">Trekking cost details</h6>
                @endif
            </div>
            <div class="card-body">

                @if ($trekkingCost === null)
                    <form action = "{{ route('admin.trekking.cost.store') }}" method="POST">
                        <input type="text" name="trekking_id" value="{{ $trekking_id }}" hidden class="form-control"
                            id="youtube" aria-describedby="textHelp">
                        @error('trekking_id')
                            <div class="text-danger">{{$message}}</div>

                        @enderror
                    @else
                        <form action="{{ route('admin.trekking.cost.update', $trekkingCost->id ?? 1) }}" method="POST">
                            @method('put')
                            <input type="text" name="trekking_id" value="{{ $trekkingCost->trekking_id ?? 1 }}" hidden
                                class="form-control" id="youtube" aria-describedby="textHelp">
                @endif
                @csrf

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3">{{ $trekkingCost->description ?? "" }}</textarea>
                </div>

                @if ($trekkingCost === null)
                    <button type="submit" class="btn btn-primary">Create</button>
                @else
                    <button type="submit" class="btn btn-primary">Update</button>
                @endif
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
@push('scriptaddon')
CKEDITOR.replace('description');
@endpush
