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
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Trekking Edit</a></li>

            </ol>
        </div>
        {{-- </div> --}}
        <div class="p-1">
            <a href="{{ route('admin.trekking.index') }}" class="btn btn-primary btn-sm">View</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Trekking</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.trekking.update', $trekking->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $trekking->title }}"
                            id="title" aria-describedby="textHelp">
                        @error('title')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{$trekking->slug}}" id="slug" aria-describedby="textHelp">
                        </div>
                        @error('slug')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    @if ($trekking->image != null)
                        <div class="my-3">
                            <label for="image" class="form-label">Current Image</label>
                            <div>
                                <a href="{{ asset( $trekking->image) }}" target="_blank"
                                    rel="noopener noreferrer">
                                    <img src="{{ asset( $trekking->image) }}" class="img-fluid"
                                        width="400px" alt="blog image" srcset="">
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                        @error('image')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    @if ($trekking->featureimg1 != null)
                        <div class="my-3">
                            <label for="image" class="form-label">Current Feature Image 1</label>
                            <div>
                                <a href="{{ asset( $trekking->featureimg1) }}" target="_blank"
                                    rel="noopener noreferrer">
                                    <img src="{{ asset( $trekking->featureimg1) }}" class="img-fluid"
                                        width="400px" alt="blog image" srcset="">
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

                    @if ($trekking->featureimg2 != null)
                        <div class="my-3">
                            <label for="featureimg2" class="form-label">Current Feature Image 2</label>
                            <div>
                                <a href="{{ asset( $trekking->featureimg2) }}" target="_blank"
                                    rel="noopener noreferrer">
                                    <img src="{{ asset( $trekking->featureimg2) }}" class="img-fluid"
                                        width="400px" alt="blog featureimg2" srcset="">
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

                    <div class="mb-3">
                        <label for="duration" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                            Duration</label>
                        <input type="text" name="duration" class="form-control" value="{{ $trekking->duration }}"
                            id="duration" aria-describedby="textHelp" placeholder="5 days">
                    </div>
                    @error('duration')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="status" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                            Status</label>
                        <div class="custom-control custom-switch form-control" style="min-height: 55px;">
                            <input type="checkbox" class="custom-control-input" name="status" id="status" @checked($trekking->status)>
                            <label class="custom-control-label" for="status">Status</label>
                            <small id="statulHelp" class="form-text text-muted">This will decide whether to show it or not.
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
                        <input type="text" name="cost" class="form-control" value="{{ $trekking->cost }}"
                            id="cost" placeholder="50.00" aria-describedby="textHelp">
                    </div>
                    @error('cost')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <div class="form-group">
                            <label for="location"><span class="text-danger h3"><sup>*</sup></span> Location</label>
                            <select class="form-control" name="location_id" id="transportation">
                                @foreach ($locations as $location)
                                    <option value="{{$location->id}}" @selected($location->id == $trekking->location_id)>{{$location->location}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @error('location_id')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3">{{ $trekking->description }}</textarea>
                        @error('description')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="costDescription" class="form-label">Cost Include Description</label>
                        <textarea class="form-control" name="costDescription" id="costDescription" rows="3">{{$trekkingCost->description }}</textarea>
                    </div>
                    @error('costDescription')
                        {{$message}}
                    @enderror
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.trekking.itinerary.index',$trekking->id) }}" class="mx-3 btn btn-primary btn-sm">View Itinerary</a>

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
    ClassicEditor
    .create( document.querySelector( '#costDescription' ) )
    .catch( error => {
    console.error( error );
    } );
@endpush
