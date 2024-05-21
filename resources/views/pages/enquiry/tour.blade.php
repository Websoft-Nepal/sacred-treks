@php
    use Carbon\Carbon;
@endphp
@extends('layouts.app')
@section('page-title', 'Tour Enquiry')
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
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Tour Enquiry list</a></li>

            </ol>
        </div>
        @include('notify::components.notify')
        {{-- </div> --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tour Enquiries</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Name</th>
                                <th>Tour Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>No. of travellers</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($enquiries as $enq)

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$enq->name}}</td>
                                <td>{{$enq->tripPackage}}</td>
                                <td>{{$enq->email}}</td>
                                <td>
                                    {{$enq->phoneNumber}}
                                </td>
                                {{-- <td>
                                    {{ Carbon::parse($enq->created_at)->diffForHumans() }}
                                </td> --}}
                                <td>{{$enq->startDate}}</td>
                                <td>{{$enq->endDate}}</td>
                                <td>{{$enq->travellersNo}}</td>
                                <td>
                                    {{-- <a href="{{ route('admin.tour.Enquiry.show', $enq->id) }}"
                                        class="btn btn-success btn-sm">View</a> --}}

                                    {{-- delete button------- --}}
                                    <form action="{{route('admin.enquiry.tour.destroy',$enq->id)}}" method="post" class="d-inline">
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
