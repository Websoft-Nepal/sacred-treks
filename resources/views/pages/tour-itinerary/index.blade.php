@extends('layouts.app')
@section('page-title', 'Tour Itinerary')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div>
            <h4 class="page-title text-left">Tour Itinerary</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('admin.tour.index')}}">Tour</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Itinerary</a></li>

            </ol>
        </div>
        @include('notify::components.notify')
        {{-- </div> --}}
        <div class="p-1">

            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createModal"
                data-whatever="@mdo">Create</button>

            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Add Itinerary</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action = "{{ route('admin.tour.itinerary.store') }}">
                            @csrf
                            <div class="modal-body">

                                    <input type="text" class="form-control" name="tour_id" hidden value="{{$tour_id}}" id="recipient-name">

                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Day:</label>
                                    <input type="text" class="form-control" name="day" id="recipient-day">
                                </div>
                                @error('day')
                                    <div class="text-danger">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Title:</label>
                                    <input type="text" class="form-control" name="title" id="recipient-title">
                                </div>
                                @error('title')
                                    <div class="text-danger">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Answer:</label>
                                    <input type="text" class="form-control" name="answer" id="recipient-answer">
                                </div>
                                @error('answer')
                                    <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="Submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tour Itinerary</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Day</th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tourItineraries as $tourItinerary)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tourItinerary->day }}</td>
                                    <td>{{ $tourItinerary->title }}</td>
                                    <td>
                                        {{-- Edit button modal  --}}
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                            data-target="#editModal{{ $tourItinerary->id }}" data-whatever="@mdo">Edit</button>

                                        {{-- Modal  --}}
                                        <div class="modal fade" id="editModal{{ $tourItinerary->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit tourItinerary</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{ route('admin.tour.itinerary.update',$tourItinerary->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <input type="text" class="form-control" name="tour_id" hidden value="{{$tourItinerary->tour->id}}" id="recipient-name">

                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Day:</label>
                                                                <input type="text" class="form-control" name="day" value="{{$tourItinerary->day}}" id="recipient-day">
                                                            </div>
                                                            @error('day')
                                                                <div class="text-danger">{{$message}}</div>
                                                            @enderror
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Title:</label>
                                                                <input type="text" class="form-control" name="title" value="{{$tourItinerary->title}}" id="recipient-title">
                                                            </div>
                                                            @error('title')
                                                                <div class="text-danger">{{$message}}</div>
                                                            @enderror
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Answer:</label>
                                                                <input type="text" class="form-control" name="answer" value="{{$tourItinerary->answer}}" id="recipient-answer">
                                                            </div>
                                                            @error('answer')
                                                                <div class="text-danger">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="Submit" class="btn btn-primary">Add</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- delete button------- --}}
                                        <form action="{{ route('admin.tour.itinerary.destroy', $tourItinerary->id) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('are you want to delete')">delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
