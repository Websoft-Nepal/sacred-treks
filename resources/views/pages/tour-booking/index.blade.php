@php
    use Carbon\Carbon;
@endphp
@extends('layouts.app')
@section('page-title', 'Tour Booking')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div>
            <h4 class="page-title text-left">Tour Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Tour</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Tour Booking list</a></li>

            </ol>
        </div>
        @include('notify::components.notify')
        {{-- </div> --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tour Bookings</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tourBookings as $tourBooking)

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$tourBooking->firstName}} {{$tourBooking->lastName}}</td>
                                <td>
                                    <span class="badge text-white {{ $tourBooking->status == "verify" ? 'bg-success' : 'bg-danger' }}">
                                        {{ $tourBooking->status }}
                                    </span>
                                </td>
                                <td>
                                    {{$tourBooking->email}}
                                </td>
                                <td>
                                    {{ Carbon::parse($tourBooking->created_at)->diffForHumans() }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.tour.booking.show', $tourBooking->id) }}"
                                        class="btn btn-success btn-sm">View</a>

                                    {{-- update button  --}}
                                    <form action="{{route('admin.tour.booking.update',$tourBooking->id)}}" method="post" class="d-inline">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-sm" onclick="return confirm('Are you sure')">Verify</button>
                                    </form>

                                    {{-- delete button------- --}}
                                    <form action="{{route('admin.tour.booking.destroy',$tourBooking->id)}}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('are you want to delete')">Delete</button>
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

    </div>
    <!-- /.container-fluid -->
@endsection
