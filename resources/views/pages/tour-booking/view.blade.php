@extends('layouts.app')
@section('page-title', 'Tour Booking')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div>
            <h4 class="page-title text-left">Tour Booking</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Tour</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Tour Booking View</a></li>

            </ol>
        </div>
        {{-- </div> --}}
        <div class="p-1">
            <a href="{{ route('admin.tour.booking.index') }}" class="btn btn-primary btn-sm">View</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tour booking details</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="firstName" class="form-label">
                        First Name</label>
                    <input type="text" name="firstName" class="form-control" value="{{ $tourBooking->firstName }}"
                        id="firstName" aria-describedby="textHelp">
                </div>

                <div class="mb-3">
                    <label for="lastName" class="form-label">
                        Last Name</label>
                    <input type="text" name="lastName" class="form-control" value="{{ $tourBooking->lastName }}"
                        id="lastName" aria-describedby="textHelp">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">
                        Email</label>
                    <input type="text" name="email" class="form-control" value="{{ $tourBooking->email }}"
                        id="email" aria-describedby="textHelp">
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">
                        Status</label>
                    <input type="text" name="status" class="form-control" value="{{ $tourBooking->status }}"
                        id="status" aria-describedby="textHelp">
                </div>

                <div class="mb-3">
                    <label for="noOfAdults" class="form-label">No. of Adults</label>
                    <input type="text" class="form-control" value="{{ $tourBooking->noOfAdults }}" id="noOfAdults"
                        aria-describedby="textHelp">
                </div>

                <div class="mb-3">
                    <label for="noOfChildren" class="form-label">
                        No. of Children</label>
                    <input type="text" name="noOfChildren" class="form-control" value="{{ $tourBooking->noOfChildren }}"
                        id="noOfChildren" aria-describedby="textHelp" placeholder="5 days">
                </div>

                <div class="mb-3">
                    <label for="number" class="form-label">
                        Number</label>
                    <input type="text" name="number" class="form-control" value="{{ $tourBooking->number }}"
                        id="number" aria-describedby="textHelp">
                </div>

                <div class="mb-3">
                    <label for="cost" class="form-label">
                        Cost</label>
                    <input type="text" name="cost" class="form-control" value="{{ $tourBooking->cost }}"
                        id="cost" placeholder="50.00" aria-describedby="textHelp">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">
                        Address</label>
                    <input type="text" name="address" class="form-control" value="{{ $tourBooking->address }}"
                        id="cost" aria-describedby="textHelp">
                </div>

                {{-- <div class="mb-3">
                    <label for="boundary" class="form-label">
                        Boundary</label>
                    <!-- Default checked national -->
                    <div class="form-control" style="min-height: 60px;">
                        <div class="custom-control custom-radio">
                            <input type="radio" value="national" class="custom-control-input" id="defaultChecked"
                                name="boundary" @checked($tourBooking->boundary == 'national')>
                            <label class="custom-control-label" for="defaultChecked">National</label>
                        </div>

                        <!-- International -->
                        <div class="custom-control custom-radio">
                            <input type="radio" value="international" class="custom-control-input" id="defaultUnchecked"
                                name="boundary" @checked($tourBooking->boundary == 'international')>
                            <label class="custom-control-label" for="defaultUnchecked">International</label>
                        </div>
                    </div>
                </div> --}}

                <div class="mb-3">
                    <div class="form-group">
                        <label for="tour" class="form-label">Tour</label>
                        <input type="text"class="form-control" value="{{ $tourBooking->tour->title }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <div>{!! $tourBooking->message !!}</div>
                </div>
                @if ($tourBooking->status == 'unverify')
                    <div class="mb-3">
                        <form action="{{ route('admin.tour.booking.update', $tourBooking->id) }}" method="post"
                            class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-primary"
                                onclick="confirm('Are you sure ?')">Verify</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
