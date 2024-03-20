@php
    use Carbon\Carbon;
@endphp
@extends('layouts.app')
@section('page-title', 'Trekking Booking')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div>
            <h4 class="page-title text-left">Trekking Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Trekking</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Trekking Booking list</a></li>

            </ol>
        </div>
        @include('notify::components.notify')
        {{-- </div> --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Trekking Bookings</h6>
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
                            @foreach ($trekkingBookings as $trekkingBooking)

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$trekkingBooking->firstName}} {{$trekkingBooking->lastName}}</td>
                                <td>
                                    <span class="badge text-white {{ $trekkingBooking->status == "verify" ? 'bg-success' : 'bg-danger' }}">
                                        {{ $trekkingBooking->status }}
                                    </span>
                                </td>
                                <td>
                                    {{$trekkingBooking->email}}
                                </td>
                                <td>
                                    {{ Carbon::parse($trekkingBooking->created_at)->diffForHumans() }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.trekking.booking.show', $trekkingBooking->id) }}"
                                        class="btn btn-success btn-sm">View</a>

                                    {{-- update button  --}}
                                    <form action="{{route('admin.trekking.booking.update',$trekkingBooking->id)}}" method="post" class="d-inline">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-sm" onclick="return confirm('Are you sure')">Verify</button>
                                    </form>

                                    {{-- delete button------- --}}
                                    <form action="{{route('admin.trekking.booking.destroy',$trekkingBooking->id)}}" method="post" class="d-inline">
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
