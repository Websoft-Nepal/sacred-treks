@extends('layouts.app')
@section('page-title', 'Testimonials')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div>
            <h4 class="page-title text-left">Testimonials Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Testimonial</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Testimonial view</a></li>

            </ol>
        </div>
        {{-- </div> --}}
        <div class="p-1">
            <a href="{{ route('admin.testimonial.index') }}" class="btn btn-primary btn-sm">View</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">View Testimonial</h6>
            </div>
            <div class="card-body">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" value="{{$testimonial->name}}" class="form-control" id="name"
                            aria-describedby="textHelp">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Review</label>
                        <input type="text" name="review" value="{{ $testimonial->review}}" class="form-control" id="review"
                            aria-describedby="textHelp">
                    </div>
                    <div class="my-3">
                        <label for="image" class="form-label">Current Image</label>
                        <div>
                            <a href="{{ asset('storage/uploads/testimonials/' . $testimonial->image) }}" target="_blank"
                                rel="noopener noreferrer">
                                <img src="{{ asset('storage/uploads/testimonials/' . $testimonial->image) }}" class="img-fluid"
                                    width="200px" alt="Trekking image" srcset="">
                            </a>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <div class="p-3" style="border: 2px solid #d1d3e2; border-radius: 0.35rem">{!! $testimonial->description !!}

                    </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
