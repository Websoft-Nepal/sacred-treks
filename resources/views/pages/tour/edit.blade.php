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
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Tour Edit</a></li>

            </ol>
        </div>
        {{-- </div> --}}
        <div class="p-1">
            <a href="{{ route('admin.tour.index') }}" class="btn btn-primary btn-sm">View</a>
            <a href="{{ route('admin.tour.itinerary.index', $tour->id) }}"
                class="mx-2 btn btn-primary btn-sm">Itinerary</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Tour</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.tour.update', $tour->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                            Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $tour->title }}" id="title"
                            aria-describedby="textHelp">
                    </div>
                    @error('title')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="slug" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                                Slug</label>
                            <input type="text" class="form-control" name="slug" value="{{ $tour->slug }}"
                                id="slug" aria-describedby="textHelp">
                        </div>
                        @error('slug')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    @if ($tour->image != null)
                        <div class="my-3">
                            <label for="image" class="form-label">Current Image</label>
                            <div>
                                <a href="{{ asset($tour->image) }}" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ asset($tour->image) }}" class="img-fluid" width="400px" alt="tour image"
                                        srcset="">
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="image" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                            Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>

                    @error('image')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

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

                    <div class="mb-3">
                        <label for="featureimg1" class="form-label">Feature Image 1</label>
                        <input type="file" class="form-control" name="featureimg1" id="featureimg1">
                        @error('featureimg1')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

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

                    <div class="mb-3">
                        <label for="featureimg2" class="form-label">Feature Image 2</label>
                        <input type="file" class="form-control" name="featureimg2" id="featureimg2">
                        @error('featureimg2')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    @if ($tour->map != null)
                        <div class="my-3">
                            <label for="image" class="form-label">Map image</label>
                            <div>
                                <a href="{{ asset($tour->map) }}" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ asset($tour->map) }}" class="img-fluid" width="400px"
                                        alt="tour map" srcset="">
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="map" class="form-label">Map</label>
                        <input type="file" class="form-control" name="map" id="map">
                    </div>

                    @error('map')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="duration" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                            Duration</label>
                        <input type="text" name="duration" class="form-control" value="{{ $tour->duration }}"
                            id="duration" aria-describedby="textHelp" placeholder="5 days">
                    </div>
                    @error('duration')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="start" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                            Start</label>
                        <input type="text" name="start" class="form-control" value="{{ $tour->start }}"
                            id="start" aria-describedby="textHelp" >
                    </div>
                    @error('start')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="mb-3">
                        <label for="finish" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                            Finish</label>
                        <input type="text" name="finish" class="form-control" value="{{ $tour->finish }}"
                            id="finish" aria-describedby="textHelp" >
                    </div>
                    @error('finish')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="mb-3">
                        <label for="type" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                            Type</label>
                        <input type="text" name="type" class="form-control" value="{{ $tour->type }}"
                            id="type" aria-describedby="textHelp" >
                    </div>
                    @error('type')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="mb-3">
                        <label for="grade" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                            Grade</label>
                        <input type="text" name="grade" class="form-control" value="{{ $tour->grade }}"
                            id="grade" aria-describedby="textHelp" >
                    </div>
                    @error('grade')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="max_altitude" class="form-label"><span class="text-danger h3"></span>
                            Max Altitude</label>
                        <input type="text" name="max_altitude" class="form-control" value="{{ $tour->max_altitude }}"
                            id="max_altitude" aria-describedby="textHelp" >
                    </div>
                    @error('max_altitude')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="mb-3">
                        <label for="group_size" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                            Group Size</label>
                        <input type="text" name="group_size" class="form-control" value="{{ $tour->group_size }}"
                            id="group_size" aria-describedby="textHelp" >
                    </div>
                    @error('group_size')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="status" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                            Status</label>
                        <div class="custom-control custom-switch form-control" style="min-height: 55px;">
                            <input type="checkbox" class="custom-control-input" name="status" id="status"
                                @checked($tour->status)>
                            <label class="custom-control-label" for="status">Status</label>
                            <small id="statulHelp" class="form-text text-muted">This will decide whether to show it or
                                not.
                                (active or not)</small>
                        </div>
                    </div>
                    @error('status')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="cost" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                            Cost</label>
                        <input type="text" name="cost" class="form-control" value="{{ $tour->cost }}"
                            id="cost" placeholder="50.00" aria-describedby="textHelp">
                    </div>
                    @error('cost')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="place" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                            Place</label>
                        <input type="text" name="place" class="form-control" value="{{ $tour->place }}"
                            id="place" placeholder="50.00" aria-describedby="textHelp">
                    </div>
                    @error('place')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="boundary" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
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
                                <input type="radio" value="international" class="custom-control-input"
                                    id="defaultUnchecked" name="boundary" @checked($tour->boundary == 'international')>
                                <label class="custom-control-label" for="defaultUnchecked">International</label>
                            </div>
                        </div>
                    </div>
                    @error('boundary')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror


                    <div class="mb-3">
                        <div class="form-group">
                            <label for="transportation"><span class="text-danger h3"><sup>*</sup></span> Transportation
                                Medium</label>
                            <select class="form-control" name="transportation_id" id="transportation">
                                @foreach ($transportations as $transport)
                                    <option value="{{ $transport->id }}" @selected($transport->id == $tour->transportation_id)>
                                        {{ $transport->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @error('transportation_id')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror



                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="editor" rows="3">{{ $tour->description }}</textarea>
                    </div>
                    @error('description')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="costDescription" class="form-label">Cost Include Description</label>
                        <textarea class="form-control" name="costDescription" id="description" rows="3">{{ $tourCost->description }}</textarea>
                    </div>
                    @error('costDescription')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
@push('scriptaddon')
    CKEDITOR.replace('editor');
    CKEDITOR.replace('description');
@endpush
