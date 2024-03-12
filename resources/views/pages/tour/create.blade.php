@extends('layouts.app')
@section('page-boundary', 'Tour')
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
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Tour Create</a></li>

            </ol>
        </div>
        {{-- </div> --}}
        <div class="p-1">
            <a href="{{ route('admin.tour.index') }}" class="btn btn-primary btn-sm">View</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add Tour</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.tour.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                            Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" id="title"
                            aria-describedby="textHelp">
                    </div>
                    @error('title')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
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
                        <input type="text" name="duration" class="form-control" value="{{ old('duration') }}"
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
                            <input type="checkbox" class="custom-control-input" name="status" id="status" checked>
                            <label class="custom-control-label" for="status">Status</label>
                            <small id="statulHelp" class="form-text text-muted">This will decide whether to show it or not. (active or not)</small>
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
                        <input type="text" name="cost" class="form-control" value="{{ old('cost') }}"
                            id="cost" placeholder="50.00" aria-describedby="textHelp">
                    </div>
                    @error('cost')
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
                                    name="boundary" checked>
                                <label class="custom-control-label" for="defaultChecked">National</label>
                            </div>

                            <!-- International -->
                            <div class="custom-control custom-radio">
                                <input type="radio" value="international" class="custom-control-input"
                                    id="defaultUnchecked" name="boundary">
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
                                    <option value="{{$transport->id}}">{{$transport->name}}</option>
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
                        <textarea class="form-control" name="description" id="editor" rows="3"></textarea>
                    </div>
                    @error('description')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
@push('scriptaddon')
    ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .catch( error => {
    console.error( error );
    } );
@endpush
