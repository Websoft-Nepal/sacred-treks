@extends('layouts.app')
@section('page-title', 'Tour')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div>
            <h4 class="page-title text-left">Tour Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Tour</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Tour View</a></li>

            </ol>
        </div>
        {{-- </div> --}}
        <div class="p-1">
            <a href="{{ route('admin.tour.index') }}" class="btn btn-primary btn-sm">View index</a>
            <a href="{{ route('admin.tour.itinerary.index',$tour->id) }}" class="btn btn-primary btn-sm">Itinerary</a>
            <a href="{{ route('admin.tour.cost.index',$tour->id) }}" class="btn btn-primary btn-sm">Cost details</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">View Tour</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="title" class="form-label">
                        Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $tour->title }}" id="title"
                        aria-describedby="textHelp">
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" value="{{ $tour->slug }}" id="slug"
                        aria-describedby="textHelp">
                </div>

                @if ($tour->image != null)
                    <div class="my-3">
                        <label for="image" class="form-label">Image</label>
                        <div>
                            <a href="{{ asset( $tour->image) }}" target="_blank"
                                rel="noopener noreferrer">
                                <img src="{{ asset( $tour->image) }}" class="img-fluid"
                                    width="400px" alt="tour image" srcset="">
                            </a>
                        </div>
                    </div>
                @endif

                @if ($tour->featureimg1 != null)
                    <div class="my-3">
                        <label for="image" class="form-label">Current Feature Image 1</label>
                        <div>
                            <a href="{{ asset($tour->featureimg1) }}" target="_blank" rel="noopener noreferrer">
                                <img src="{{ asset($tour->featureimg1) }}" class="img-fluid" width="400px"
                                    alt="blog image" srcset="">
                            </a>
                        </div>
                    </div>
                @endif


                @if ($tour->featureimg2 != null)
                    <div class="my-3">
                        <label for="featureimg2" class="form-label">Current Feature Image 2</label>
                        <div>
                            <a href="{{ asset($tour->featureimg2) }}" target="_blank" rel="noopener noreferrer">
                                <img src="{{ asset($tour->featureimg2) }}" class="img-fluid" width="400px"
                                    alt="blog featureimg2" srcset="">
                            </a>
                        </div>
                    </div>
                @endif

                @if ($tour->map != null)
                    <div class="my-3">
                        <label for="image" class="form-label">Map image</label>
                        <div>
                            <a href="{{ asset( $tour->image) }}" target="_blank"
                                rel="noopener noreferrer">
                                <img src="{{ asset( $tour->image) }}" class="img-fluid"
                                    width="400px" alt="tour image" srcset="">
                            </a>
                        </div>
                    </div>
                @endif

                <div class="mb-3">
                    <label for="duration" class="form-label">
                        Duration</label>
                    <input type="text" name="duration" class="form-control" value="{{ $tour->duration }}" id="duration"
                        aria-describedby="textHelp" placeholder="5 days">
                </div>

                <div class="mb-3">
                    <label for="start" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                        Start</label>
                    <input type="text" name="start" class="form-control" value="{{ $tour->start }}"
                        id="start" aria-describedby="textHelp" >
                </div>
                <div class="mb-3">
                    <label for="finish" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                        Finish</label>
                    <input type="text" name="finish" class="form-control" value="{{ $tour->finish }}"
                        id="finish" aria-describedby="textHelp" >
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                        Type</label>
                    <input type="text" name="type" class="form-control" value="{{ $tour->type }}"
                        id="type" aria-describedby="textHelp" >
                </div>
                <div class="mb-3">
                    <label for="grade" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                        Grade</label>
                    <input type="text" name="grade" class="form-control" value="{{ $tour->grade }}"
                        id="grade" aria-describedby="textHelp" >
                </div>

                <div class="mb-3">
                    <label for="max_altitude" class="form-label"><span class="text-danger h3"></span>
                        Max Altitude</label>
                    <input type="text" name="max_altitude" class="form-control" value="{{ $tour->max_altitude }}"
                        id="max_altitude" aria-describedby="textHelp" >
                </div>
                <div class="mb-3">
                    <label for="group_size" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                        Group Size</label>
                    <input type="text" name="group_size" class="form-control" value="{{ $tour->group_size }}"
                        id="group_size" aria-describedby="textHelp" >
                </div>

                <div class="mb-3">
                    <label for="place" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                        Place</label>
                    <input type="text" name="place" class="form-control" value="{{ $tour->place }}"
                        id="place" aria-describedby="textHelp">
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">
                        Status</label>
                    <div class="custom-control custom-switch form-control" style="min-height: 55px;">
                        <input type="checkbox" class="custom-control-input" id="status" @checked($tour->status)>
                        <label class="custom-control-label" for="status">Status</label>
                        <small id="statulHelp" class="form-text text-muted">This will decide whether to show it or not.
                            (active or not)</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="cost" class="form-label">
                        Cost</label>
                    <input type="text" name="cost" class="form-control" value="{{ $tour->cost }}" id="cost"
                        placeholder="50.00" aria-describedby="textHelp">
                </div>

                <div class="mb-3">
                    <label for="boundary" class="form-label">
                        Boundary</label>
                    <!-- Default checked national -->
                    <div class="form-control" style="min-height: 60px;">
                        <div class="custom-control custom-radio">
                            <input type="radio" value="national" class="custom-control-input" id="defaultChecked"
                                name="boundary" @checked($tour->boundary == 'national')>
                            <label class="custom-control-label" for="defaultChecked">National</label>
                        </div>

                        <!-- International -->
                        <div class="custom-control custom-radio">
                            <input type="radio" value="international" class="custom-control-input" id="defaultUnchecked"
                                name="boundary" @checked($tour->boundary == 'international')>
                            <label class="custom-control-label" for="defaultUnchecked">International</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label for="transportation" class="form-label"> Transportation
                            Medium</label>
                        <input type="text"class="form-control" value="{{$tour->transportation->name}}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <div class="p-3" style="border: 2px solid #d1d3e2; border-radius: 0.35rem">{!! $tour->description !!}</div>
                </div>

                <div class="mb-3">
                    <label for="costDescription" class="form-label">Cost Include Description</label>
                    <div class="p-3" style="border: 2px solid #d1d3e2; border-radius: 0.35rem">{!! $tourCost->description !!}
                </div>


            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
