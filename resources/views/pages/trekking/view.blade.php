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
            <a href="{{ route('admin.trekking.index') }}" class="btn btn-primary btn-sm">View index</a>
            <a name="" id="" class="btn btn-sm btn-primary" href="{{route("admin.trekking.itinerary.index",$trekking->id)}}" role="button">Itinerary</a>
            <a name="" id="" class="btn btn-sm btn-primary" href="{{route("admin.trekking.cost.index",$trekking->id)}}" role="button">Cost details</a>

        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">View Trekking</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $trekking->title }}" id="title"
                        aria-describedby="textHelp">
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" value="{{ $trekking->slug }}" id="slug"
                        aria-describedby="textHelp">
                </div>

                @if ($trekking->image != null)
                    <div class="my-3">
                        <label for="image" class="form-label">Image</label>
                        <div>
                            <a href="{{ asset($trekking->image) }}" target="_blank" rel="noopener noreferrer">
                                <img src="{{ asset($trekking->image) }}" class="img-fluid" width="400px"
                                    alt="trekking image" srcset="">
                            </a>
                        </div>
                    </div>
                @endif

                @if ($trekking->featureimg1 != null)
                    <div class="my-3">
                        <label for="image" class="form-label">Current Feature Image 1</label>
                        <div>
                            <a href="{{ asset($trekking->featureimg1) }}" target="_blank" rel="noopener noreferrer">
                                <img src="{{ asset($trekking->featureimg1) }}" class="img-fluid" width="400px"
                                    alt="blog image" srcset="">
                            </a>
                        </div>
                    </div>
                @endif


                @if ($trekking->featureimg2 != null)
                    <div class="my-3">
                        <label for="featureimg2" class="form-label">Current Feature Image 2</label>
                        <div>
                            <a href="{{ asset($trekking->featureimg2) }}" target="_blank" rel="noopener noreferrer">
                                <img src="{{ asset($trekking->featureimg2) }}" class="img-fluid" width="400px"
                                    alt="blog featureimg2" srcset="">
                            </a>
                        </div>
                    </div>
                @endif

                <div class="mb-3">
                    <label for="duration" class="form-label">
                        Duration</label>
                    <input type="text" name="duration" class="form-control" value="{{ $trekking->duration }}"
                        id="duration" aria-describedby="textHelp" placeholder="5 days">
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">
                        Status</label>
                    <div class="custom-control custom-switch form-control" style="min-height: 55px;">
                        <input type="checkbox" class="custom-control-input" id="status" @checked($trekking->status)>
                        <label class="custom-control-label" for="status">Status</label>
                        <small id="statulHelp" class="form-text text-muted">This will decide whether to show it or not.
                            (active or not)</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="cost" class="form-label">
                        Cost</label>
                    <input type="text" name="cost" class="form-control" value="{{ $trekking->cost }}" id="cost"
                        placeholder="50.00" aria-describedby="textHelp">
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label for="location"> Location</label>
                        <div class="form-control">{{ $trekking->location->location }}</div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <div class="p-3" style="border: 2px solid #d1d3e2; border-radius: 0.35rem">{!! $trekking->description !!}
                    </div>
                </div>

                <div class="mb-3">
                    <label for="costDescription" class="form-label">Cost Include Description</label>
                    <div class="p-3" style="border: 2px solid #d1d3e2; border-radius: 0.35rem">{!! $trekkingCost->description !!}
                </div>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
